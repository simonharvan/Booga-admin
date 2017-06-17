<?php namespace App\Http\Controllers\Admin\Admins;


/**
 * Created by PhpStorm.
 * User: simonharvan
 * Date: 1.4.17
 * Time: 11:28
 */


use App\Http\Controllers\Admin\AdminLogsHelper;
use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\AdminAddRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Models\Admin\Admin;
use App\Models\AdminLog\AdminLog;
use App\Models\Core\AdminLogType;
use Exception;
use Hash;
use Illuminate\Http\Request;
use MongoDB\Driver\Exception\DuplicateKeyException;


class AdminsController extends Controller
{


    public function index()
    {
        if (auth()->user()->superadmin == 0) {
            return redirect()->route('admin.dashboard.index');
        }

        $admins = Admin::with(['media'])->paginate(10);

        $currentPage = $admins->currentPage();
        $totalPages = $admins->lastPage();

        return view('pages.admins.index', [
            'admins' => $admins,
            'currentPage' => $currentPage,
            'total' => $totalPages
        ]);
    }

    public function create()
    {
        if (auth()->user()->superadmin == 0) {
            return redirect()->route('admin.dashboard.index');
        }

        return view('pages.admins.create');
    }

    public function store(AdminAddRequest $request)
    {
        if (auth()->user()->superadmin == 0) {
            return redirect()->route('admin.dashboard.index');
        }

        try {
            $admin = new Admin;
            $admin->name = $request->name;
            $admin->password = Hash::make($request->password);
            $admin->email = $request->email;
            $admin->points = 0;
            if ($request->superadmin == "true") {
                $admin->superadmin = true;
            } else {
                $admin->superadmin = false;
            }
            $admin->save();

            if ($request->hasFile('profile_photo')) {
                $admin->saveMedia($request->file('profile_photo'));
            }

        } catch (Exception $exception) {
            return $exception;
        }
        AdminLogsHelper::log(AdminLogType::ADMIN_CREATED, auth()->user());

        return redirect()->route('admin.admins.index');
    }

    public function edit($id)
    {
        if (auth()->user()->superadmin == 0) {
            return redirect()->route('admin.dashboard.index');
        }

        $admin = Admin::query()->find($id);

        return view('pages.admins.edit', [
            'admin' => $admin
        ]);
    }

    public function update(AdminUpdateRequest $request, $id)
    {
        $auth = auth()->user();
        if ($auth->superadmin == 0 && $auth->id != $id) {
            return redirect()->route('admin.dashboard.index');
        }

        $admin = Admin::query()->find($id);

        $admin->name = $request->name;
        $admin->email = $request->email;
        if ($request->password !== null) {
            $admin->password = Hash::make($request->password);
        }

        if ($request->superadmin == "true") {
            $admin->superadmin = true;
        } else {
            $admin->superadmin = false;
        }

        $admin->save();

        if ($request->hasFile('profile_photo')) {
            $admin->saveMedia($request->file('profile_photo'));
        }

        AdminLogsHelper::log(AdminLogType::ADMIN_UPDATED, auth()->user());
        return redirect()->route('admin.admins.index');

    }

    public function destroy($id)
    {
        if (auth()->user()->superadmin == 0) {
            return redirect()->route('admin.dashboard.index');
        }

        $admin = Admin::query()->find($id);
        $admin->delete();

        AdminLogsHelper::log(AdminLogType::ADMIN_DELETED, auth()->user());
        return redirect()->route('admin.admins.index');
    }
}