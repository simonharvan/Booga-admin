<?php namespace App\Http\Controllers\Admin\Books;

use App\Http\Controllers\Admin\AdminBadges\AdminBadgesController;
use App\Http\Controllers\Admin\AdminLogsHelper;
use App\Http\Controllers\Admin\Controller;
use App\Models\AdminLog\AdminLog;
use App\Models\Book\BookType;
use App\Models\Core\AdminLogType;
use App\Models\Genre\Genre;
use App\Models\IdentifyText\IdentifyTextQuiz;
use App\Models\RealLibrary\RealLibrary;
use DB;
use Exception;
use GuzzleHttp\Client;
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;
use Medlib\Yaz\Facades\Query;
use Medlib\Yaz\Facades\Yaz;
use Medlib\Yaz\Query\YazQuery;
use Medlib\Yaz\Record\YazRecords;
use Storage;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = BookType::with(['identifyTextQuiz', 'identifyCharacterQuiz', 'miniQuiz'])->paginate(10);

        return view('pages.books.index', [
            'books' => $books
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genre = Genre::all(['id', 'name']);
        $libraries = RealLibrary::all(['id', 'name']);

        return view('pages.books.create', [
            'genre' => $genre,
            'libraries' => $libraries,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $bookType = new BookType();
        $bookType->name = $request->name;
        $bookType->author_name = $request->author;
        $bookType->isbn = $request->isbn;
        $bookType->year_published = $request->year_published;
        $bookType->generation_focus_level = $request->focus_level;
        $bookType->energy_for_clearing = $request->energy;
        $bookType->time_for_clearing = $request->time_clearing;
        $bookType->genre_id = $request->genre;
        if (!$request->hasFile('book_cover')) {
            $bookType->image_url = $request->cover_photo_url;
        }
        $bookType->save();

        if ($request->hasFile('book_cover')) {
            $bookType->saveMedia($request->file('book_cover'));
        }

        AdminLogsHelper::log(AdminLogType::BOOK_CREATED, auth()->user(), AdminLogType::BOOK_CREATED . ' ' . $bookType->name);

        return AdminBadgesController::checkForNewBadges('admin.books.edit', '', [
            'id' => $bookType->id,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BookType $book
     * @return \Illuminate\Http\Response
     */
    public function show(BookType $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = BookType::with(['identifyTextQuiz', 'miniQuiz', 'identifyCharacterQuiz'])->findOrFail($id);

        $genre = Genre::all();

        $identifyTextQuiz = $book->identifyTextQuiz;

        $miniQuiz = $book->miniQuiz;

        $identifyCharacterQuiz = $book->identifyCharacterQuiz;

        return view('pages.books.edit', [
            'identifyTextQuiz' => $identifyTextQuiz,
            'identifyCharacterQuiz' => $identifyCharacterQuiz,
            'miniQuiz' => $miniQuiz,
            'book' => $book,
            'genres' => $genre,
        ]);

    }

    /**
     * @param Request $request
     */
    public function search($libraryId, $query)
    {
        $req = new Request([
            "query" => $query,
            "title" => "ti",
            "keywords" => "kw",
            "author" => "au",
            "type" => "books"
        ]);

        $query = Query::simple($req)->get();

        $realLibrary = RealLibrary::findOrFail($libraryId);

        $records = YazQuery::create()
            ->fromUrl($realLibrary->url, $realLibrary->port, $realLibrary->database_name)
            ->where($query)
            ->limit(0, 10)
            ->all(YazRecords::TYPE_XML);

        if (count($records->getRecords()) > 0) {
            $result = [];
            foreach ($records->getRecords() as $record) {
                $result[] = RecordTransformer::transform($record);
            }

            return response()->json(['result' => $result,
            ], 200);
        } else {
            return response("false", 404);
        }
//        $query = "@or @or @attr 1=4 ". $query ." @attr 1=1003 ". $query ." @attr 1=1016 ". $query;
//
//        $connection = yaz_connect("arl1.library.sk:8887/ruz_un_cat");
//        yaz_element($connection, $elementset);
//        yaz_search($connection, 'rpn', $query);
//        yaz_wait();
//        $error = yaz_error($connection);
//        $errorno = yaz_errno($connection);
//
//        $records = [];
//        if ($error == "") {
//            yaz_present($connection);
//            $hits = yaz_hits($connection);
//            for ($i = 0; $i < $hits; ++$i) {
//                $xml = yaz_record($connection, $i, "string");
//                array_push($records, $xml);
//            }
//        }
//
//
//        dd($records);
//
//        if (count($records) > 0) {
//            return response("true", 200);
//        } else {
//            return response("false", 404);
//        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Book $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookType $book)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $book = BookType::with(['identifyTextQuiz', 'miniQuiz', 'identifyCharacterQuiz'])->findOrFail($id);

        $idenText = $book->identifyTextQuiz;
        $idenChar = $book->identifyCharacterQuiz;
        $miniQuiz = $book->miniQuiz;

        DB::beginTransaction();
        $book->delete();

        if (isset($idenText)) {
            $idenText->delete();
        }
        if (isset($miniQuiz)) {
            $miniQuiz->miniQuizQuestions->delete();
            $miniQuiz->delete();
        }

        if (isset($book->identifyCharacterQuiz)) {
            $idenChar->identifyCharacterHints->delete();
            $idenChar->delete();
        }


        DB::commit();

        return redirect()->route('admin.books.index');
    }
}