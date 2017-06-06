<?php
/**
 * Created by PhpStorm.
 * User: simonharvan
 * Date: 31.5.17
 * Time: 15:39
 */

namespace App\Http\Controllers\Admin\Logs;


use App\Http\Controllers\Admin\Controller;
use App\Models\AdminLog\AdminLog;

class LogsController extends Controller
{
    public function index() {

        $adminLogs = AdminLog::with(['admin'])->paginate(10);
        return view('pages.logs.index', [
           'adminLogs' => $adminLogs,
        ]);
    }
}