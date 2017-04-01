<?php namespace App\Http\Controllers\Admin\Admins;


/**
 * Created by PhpStorm.
 * User: simonharvan
 * Date: 1.4.17
 * Time: 11:28
 */

use App\Http\Controllers\Admin\Controller;
use App\Models\Admin\Admin;


class AdminsController extends Controller {




    public function index()
    {
        $admins = Admin::all();

        return view('pages.admins.index', [
            'admins' => $admins
        ]);
    }

    public function edit($id) {

        $admin = Admin::query()->find($id);

        return view('pages.admins.edit', [
            'admin' => $admin
        ]);
    }

    public function update($id) {

        $admin = Admin::query()->find($id);

        return view('pages.admins.edit', [
            'admin' => $admin
        ]);
    }

    public function destroy($id) {

        $admin = Admin::query()->find($id);
        $admin->delete();

        return redirect()->route('admin.admins.index');
    }
}