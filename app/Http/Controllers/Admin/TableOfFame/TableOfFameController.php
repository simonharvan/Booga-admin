<?php
/**
 * Created by PhpStorm.
 * User: simonharvan
 * Date: 1.6.17
 * Time: 19:33
 */

namespace App\Http\Controllers\Admin\TableOfFame;


use App\Models\Admin\Admin;

class TableOfFameController
{
    public function index()
    {

        $admins = Admin::query()->orderBy('points', 'desc')->paginate(10);
        return view('pages.table_of_fame.index', [
            'admins' => $admins,
            'count' => (($admins->currentPage()-1) * 10) + 1,
        ]);
    }

}