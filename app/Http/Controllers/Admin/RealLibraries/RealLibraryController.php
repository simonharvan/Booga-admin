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
use Illuminate\Support\Facades\Log;
use Medlib\Yaz\Facades\Query;
use Medlib\Yaz\Record\YazRecords;
use Request;
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

    public function store(){
        return view('pages.libraries.create');
    }

    public function test(Request $request){
//        $z = yaz_connect("z3950.indexdata.com/gils");
//        yaz_search($z, "rpn", "computer");
//        yaz_wait();
//        Log::info("error number: " . yaz_errno($z) . "\n");
//        Log::info( "hits: " . yaz_hits($z) . "\n");

        Log::info("Logging test");

        dd($request);
        $query = Query::simple($request)->get();

        $record = Yaz::from($request->query('qdb'))
            ->where($query)
            //->limit(1, 10240)
            ->limit(1, 100)
            ->orderBy('au ASC')
            ->all(YazRecords::TYPE_XML);
        dd($record);
//        Log::info("errors: " . yaz_errno($record) . "\n");
//        Log::info( "hits: " . yaz_hits($record) . "\n");
//
//        Log::info("resource is " .is_resource($z));

        yaz_close($z);
        if (is_resource($z)) {
            return new JsonResponse($z, 200, []);
        } else {
            return new JsonResponse($z, 500, []);
        }

    }

    /**
     * @param Request $request
     */
    public function search(Request $request){
        dd($request);
    }
}