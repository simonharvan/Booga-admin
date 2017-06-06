<?php
/**
 * Created by PhpStorm.
 * User: simonharvan
 * Date: 6.6.17
 * Time: 14:16
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Admin\AdminBadges\AdminBadgesController;
use App\Models\AdminLog\AdminLog;
use App\Models\Core\AdminLogType;

class AdminLogsHelper
{
    public static function log($type, $user, $text = '') {
        $adminLog = new AdminLog();
        $adminLog->type = $type;
        if ($text == ''){
            $text = $type . ' ' . $user->email;
        }
        $adminLog->text = $text;
        $adminLog->admin()->associate($user);
        $adminLog->save();

        AdminBadgesController::rewardPoints($type, $user);
    }
}