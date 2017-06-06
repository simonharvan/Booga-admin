<?php
/**
 * Created by PhpStorm.
 * User: simonharvan
 * Date: 22.5.17
 * Time: 14:29
 */

namespace App\Http\Controllers\Admin\Citations;


use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\CitationAddRequest;
use App\Models\Citation\Citation;
use App\Models\Genre\Genre;
use Illuminate\Http\Request;

class CitationsController extends Controller
{


    public function index()
    {
        $citations = Citation::paginate(10);

        return view('pages.citations.index', [
            'citations' => $citations,
        ]);

    }

    public function create()
    {
        $genres = Genre::all();

        return view('pages.citations.create', [
            'genres' => $genres,
        ]);
    }

    public function store(CitationAddRequest $request)
    {

        $citation = new Citation();

        $citation->text = $request->text;
        $citation->author = $request->author;
        $citation->from = $request->from;
        $citation->to = $request->to;
        if ($request->without_genre != "true") {
            $genre = Genre::all()->where('name', 'LIKE', $request->genre)->first();
            $citation->genre_id = $genre->id;
        }
        $citation->save();

        $genres = Genre::all();

        return view('pages.citations.create', [
            'genres' => $genres,
            'success' => true,
        ]);
    }

    public function edit($id){
        $citation = Citation::with('genre')->find($id);

        $genres = Genre::all();

        return view('pages.citations.edit', [
            'citation' => $citation,
            'genres' => $genres,
        ]);
    }

    public function update($id, Request $request){
        $citation = Citation::with('genre')->find($id);

        $citation->text = $request->text;
        $citation->author = $request->author;
        $citation->from = $request->from;
        $citation->to = $request->to;
        if ($request->without_genre != "true") {
            $genre = Genre::all()->where('name', 'LIKE', $request->genre)->first();
            $citation->genre_id = $genre->id;
        }
        $citation->save();

        $citations = Citation::paginate(10);

        return view('pages.citations.index', [
            'citations' => $citations,
        ]);
    }

    public function destroy($id){
        $citation = Citation::find($id);

        $citation->delete();

        return redirect(route('admin.citations.index'));

    }

}