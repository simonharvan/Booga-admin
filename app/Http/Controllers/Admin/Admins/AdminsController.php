<?php namespace App\Http\Controllers\Admin\Admins;


/**
 * Created by PhpStorm.
 * User: simonharvan
 * Date: 1.4.17
 * Time: 11:28
 */


use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\AdminAddRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Models\Admin\Admin;
use App\Models\AdminLog\AdminLog;
use App\Models\Core\AdminLogType;
use Hash;


class AdminsController extends Controller {




    public function index()
    {
        $admins = Admin::query()->paginate(10);
        $currentPage = $admins->currentPage();
        $totalPages = $admins->lastPage();

        return view('pages.admins.index', [
            'admins' => $admins,
            'currentPage' => $currentPage,
            'total' => $totalPages
        ]);
    }

    public function create() {
        return view('pages.admins.create');
    }

    public function add(AdminAddRequest $request) {

        $admin = new Admin;
        $admin->name = $request->name;
        $admin->password = Hash::make($request->password);
        $admin->email = $request->email;
        $admin->points = 0;

        $admin->save();

        $adminLog = new AdminLog;
        $adminLog->type = AdminLogType::ADMIN_CREATED;
        $adminLog->text = AdminLogType::ADMIN_CREATED . $admin->email;
        $adminLog->admin()->associate(auth()->user());
        $adminLog->save();

        return redirect()->route('admin.admins.index');
    }

    public function edit($id) {

        $admin = Admin::query()->find($id);

        return view('pages.admins.edit', [
            'admin' => $admin
        ]);
    }

    public function update(AdminUpdateRequest $request, $id) {

        $admin = Admin::query()->find($id);

        $admin->name = $request->name;
        $admin->email = $request->email;
        if ($request->password !== null){
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        $adminLog = new AdminLog();
        $adminLog->type = AdminLogType::ADMIN_UPDATED;
        $adminLog->text = AdminLogType::ADMIN_UPDATED . $admin->email;
        $adminLog->admin()->associate(auth()->user());
        $adminLog->save();


        return redirect()->route('admin.admins.index');
    }

    public function destroy($id) {

        $admin = Admin::query()->find($id);
        $admin->delete();

        return redirect()->route('admin.admins.index');
    }
}