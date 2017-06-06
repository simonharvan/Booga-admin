<?php
/**
 * Created by PhpStorm.
 * User: simonharvan
 * Date: 2.6.17
 * Time: 16:37
 */

namespace App\Http\Controllers\Admin\Levels;


use App\Http\Controllers\Admin\Controller;
use App\Models\Level\Level;
use Illuminate\Http\Request;

class LevelsController extends Controller
{
    public function index() {
        $levels = Level::query()->orderBy('min_points', 'asc')->paginate(10);

        return view('pages.levels.index', [
            'levels' => $levels,
        ]);

    }

    public function create() {
        $level = Level::query()->orderBy('min_points', 'desc')->first();

        return view('pages.levels.create', [
            'last_level' => $level,
        ]);
    }

    public function store(Request $request){
        $level = new Level();

        $level->name = $request->name;
        $level->min_points = $request->min_points;

        $level->save();

        return redirect()->route('admin.levels.index');
    }

    public function edit($id) {
        $level = Level::findOrFail($id);

        return view('pages.levels.edit',[
                'level' => $level,
            ]);

    }

    public function update(Request $request, $id){
        $level = Level::findOrFail($id);

        $level->name = $request->name;
        $level->min_points = $request->min_points;

        $level->save();

        return redirect()->route('admin.levels.index');
    }

    public function destroy($id){
        $level = Level::findOrFail($id);
        $level->delete();

        return redirect()->route('admin.levels.index');
    }
}