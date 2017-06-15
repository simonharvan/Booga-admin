<?php
/**
 * Created by PhpStorm.
 * User: simonharvan
 * Date: 6.6.17
 * Time: 10:02
 */

namespace App\Http\Controllers\Admin\Profile;


use App\Http\Controllers\Admin\Controller;
use App\Models\Admin\Admin;
use App\Models\AdminBadge\AdminBadge;
use App\Models\AdminBadge\AdminBadgeType;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function edit(){

        $user = auth()->user();


        $adminBadges = DB::table('Admin_badge')->where('admin_id', $user->id)->get();

        $badgeTypes = AdminBadgeType::all();

        return view('pages.profile.edit', [
            'user' => $user,
            'badgeTypes' => $badgeTypes,
            'adminBadges' => $adminBadges
        ]);
    }

    public function detail($id){

        $user = Admin::with(['media'])->findOrFail($id);

        $adminBadges = DB::table('Admin_badge')->where('admin_id', $user->id)->get();

        $badgeTypes = AdminBadgeType::all();

        return view('pages.profile.detail', [
            'user' => $user,
            'badgeTypes' => $badgeTypes,
            'adminBadges' => $adminBadges
        ]);
    }
}