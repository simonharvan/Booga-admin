<?php
/**
 * Created by PhpStorm.
 * User: simonharvan
 * Date: 3.4.17
 * Time: 17:57
 */

namespace App\Http\Controllers\Admin\RealLibraries;


use App\Http\Controllers\Admin\Controller;
use App\Models\RealLibrary\RealLibrary;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Medlib\Yaz\Facades\Query;
use Medlib\Yaz\Query\YazQuery;
use Medlib\Yaz\Record\YazRecords;
use Yaz;


class RealLibraryController extends Controller
{



    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $realLibraries = RealLibrary::query()->paginate(3);

        return view('pages.libraries.index',
            ['libraries' => $realLibraries]
        );
    }


    public function create(){

        return view('pages.libraries.create');
    }

    public function store(Request $request){

        $realLibrary = new RealLibrary();

        $realLibrary->name = $request->name;
        $realLibrary->url = $request->url;
        $realLibrary->database_name = $request->database_name;
        $realLibrary->port = $request->port;
        $realLibrary->street = $request->street;
        $realLibrary->street_number = $request->street_number;
        $realLibrary->city = $request->city;
        $realLibrary->save();

        $realLibraries = RealLibrary::query()->paginate(3);

        return view('pages.libraries.index',
            ['libraries' => $realLibraries]
        );
    }

    public function edit($id) {
        $realLibrary = RealLibrary::findOrFail($id);


        return view('pages.libraries.edit',
            ['library' => $realLibrary]
        );

    }

    public function update(Request $request, $id){
        $realLibrary = RealLibrary::findOrFail($id);

        $realLibrary->name = $request->name;
        $realLibrary->url = $request->url;
        $realLibrary->database_name = $request->database_name;
        $realLibrary->port = $request->port;
        $realLibrary->street = $request->street;
        $realLibrary->street_number = $request->street_number;
        $realLibrary->city = $request->city;
        $realLibrary->save();

        return redirect()->route('admin.libraries.index');
    }

    public function destroy($id){

        $realLibrary = RealLibrary::findOrFail($id);
        $realLibrary->delete();

        return redirect()->route('admin.libraries.index');
    }

    public function test(Request $request){


        $req = new Request([
            "query" => "Bib",
            "title" => "ti",
            "keywords" => "kw",
            "author" => "au",
            "type" => "books"
        ]);

        $query = Query::simple($req)->get();

        $record = Yaz::fromUrl($request->url, $request->port, $request->database, [
            'protocol' => 2,
            'charset' => 'UTF-8',
          ])->where($query)
            ->all(YazRecords::TYPE_XML);
        if (!$record->fails()){
            return response('Library found', 200);
        }else {
            return response('Library not found', 404);
        }
    }


}