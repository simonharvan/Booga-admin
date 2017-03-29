<?php namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Admin\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.dashboard');
    }
}