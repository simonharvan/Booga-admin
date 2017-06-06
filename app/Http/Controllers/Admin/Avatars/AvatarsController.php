<?php namespace App\Http\Controllers\Admin\Avatars;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\AvatarAddRequest;
use App\Models\Avatar\AvatarType;
use Illuminate\Http\Request;


class AvatarsController extends Controller
{
    public function index() {
        $avatars = AvatarType::with('media')->paginate(10);

        return view('pages.avatars.index', [
            'avatars' => $avatars,
        ]);
    }

    public function create() {
        return view('pages.avatars.create');
    }

    public function store(AvatarAddRequest $request) {

        $avatar = new AvatarType();

        $avatar->name = $request->name;
        $avatar->description = $request->description;
        $avatar->save();

        if ($request->hasFile('profile_photo')){
            $avatar->saveMedia($request->file('profile_photo'));
        }
        return redirect()->route('admin.avatars.index');
    }

    public function edit($id) {
        $avatar = AvatarType::with(['media'])->findOrFail($id);

        return view('pages.avatars.edit', [
            'avatar' => $avatar,
        ]);
    }

    public function update(Request $request, $id) {

        $avatar = AvatarType::findOrFail($id);

        $avatar->name = $request->name;
        $avatar->description = $request->description;
        $avatar->save();

        if ($request->hasFile('profile_photo')){
            $avatar->saveMedia($request->file('profile_photo'));
        }

        return redirect()->route('admin.avatars.index');
    }

    public function destroy($id) {
        $avatar = AvatarType::findOrFail($id);

        $avatar->delete();

        return redirect()->route('admin.avatars.index');
    }
}