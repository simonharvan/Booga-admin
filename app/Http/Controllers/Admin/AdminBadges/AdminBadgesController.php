<?php
/**
 * Created by PhpStorm.
 * User: simonharvan
 * Date: 6.6.17
 * Time: 11:59
 */

namespace App\Http\Controllers\Admin\AdminBadges;


use App\Http\Controllers\Admin\Controller;
use App\Models\Admin\Admin;
use App\Models\AdminBadge\AdminBadge;
use App\Models\AdminBadge\AdminBadgeType;
use App\Models\AdminLog\AdminLog;
use App\Models\Core\AdminLogType;

class AdminBadgesController extends Controller
{
    public static function checkForNewBadges($redirect, $page = '', $options = [])
    {
        $user = auth()->user();

        /**
         * Check loggins - id:1
         */
        $badgeTypeId = 1;

        $loggedIn = AdminLog::query()->where('type', '=', AdminLogType::ADMIN_LOGGED)->where('admin_id', '=', $user->id)->count();
        $haveBadge = AdminBadge::query()->where('admin_id', '=', $user->id)->where('admin_badge_type_id', '=', $badgeTypeId)->count();
        if ($loggedIn == 1 && $haveBadge == 0) {
            $badge = new AdminBadge();
            $badge->admin_id = $user->id;
            $badge->admin_badge_type_id = $badgeTypeId;
            $badge->save();

            self::rewardPoints(AdminLogType::BADGE_GAINED, $user, [ 'multi' => 0 ]);

            $badgeType = AdminBadgeType::findOrFail($badgeTypeId);

            $options['adminBadgeType'] = $badgeType;
            $options['redirect'] = $redirect;
            return view('pages.admin_badges.badge', $options);
        }


        /**
         * First book - id: 4
         */
        $badgeTypeId = 4;
        $bookCreated = AdminLog::query()->where('type', '=', AdminLogType::BOOK_CREATED)->where('admin_id', '=', $user->id)->count();
        $haveBadge = AdminBadge::query()->where('admin_id', '=', $user->id)->where('admin_badge_type_id', '=', $badgeTypeId)->count();
        if ($bookCreated == 1 && $haveBadge == 0) {
            $badge = new AdminBadge();
            $badge->admin_id = $user->id;
            $badge->admin_badge_type_id = $badgeTypeId;
            $badge->save();

            self::rewardPoints(AdminLogType::BADGE_GAINED, $user, [ 'multi' => 3 ]);

            $badgeType = AdminBadgeType::findOrFail($badgeTypeId);

            $options['adminBadgeType'] = $badgeType;
            $options['redirect'] = $redirect;
            return view('pages.admin_badges.badge', $options);
        }


        /**
         * First five books - id: 5
         */
        $badgeTypeId = 5;
        $bookCreated = AdminLog::query()->where('type', '=', AdminLogType::BOOK_CREATED)->where('admin_id', '=', $user->id)->count();
        $haveBadge = AdminBadge::query()->where('admin_id', '=', $user->id)->where('admin_badge_type_id', '=', $badgeTypeId)->count();
        if ($bookCreated == 5 && $haveBadge == 0) {
            $badge = new AdminBadge();
            $badge->admin_id = $user->id;
            $badge->admin_badge_type_id = $badgeTypeId;
            $badge->save();

            self::rewardPoints(AdminLogType::BADGE_GAINED, $user, [ 'multi' => 2 ]);

            $badgeType = AdminBadgeType::findOrFail($badgeTypeId);

            $options['adminBadgeType'] = $badgeType;
            $options['redirect'] = $redirect;
            return view('pages.admin_badges.badge', $options);
        }

        /**
         * Lucky seven - 7 books + 7 quizzes of all - id: 7
         */
        $badgeTypeId = 7;
        $haveBadge = AdminBadge::query()->where('admin_id', '=', $user->id)->where('admin_badge_type_id', '=', $badgeTypeId)->count();
        if ($haveBadge == 0) {
            $bookCreated = AdminLog::query()->where('type', '=', AdminLogType::BOOK_CREATED)->where('admin_id', '=', $user->id)->count();
            $miniQuizCreated = AdminLog::query()->where('type', '=', AdminLogType::MINI_QUIZ_CREATED)->where('admin_id', '=', $user->id)->count();
            $idenCharCreated = AdminLog::query()->where('type', '=', AdminLogType::IDENTIFY_CHARACTER_QUIZ_CREATED)->where('admin_id', '=', $user->id)->count();
            $idenTextCreated = AdminLog::query()->where('type', '=', AdminLogType::IDENTIFY_TEXT_QUIZ_CREATED)->where('admin_id', '=', $user->id)->count();
            if ($bookCreated == 7 && $miniQuizCreated == 7 && $idenCharCreated == 7 && $idenTextCreated == 7) {
                $badge = new AdminBadge();
                $badge->admin_id = $user->id;
                $badge->admin_badge_type_id = $badgeTypeId;
                $badge->save();

                self::rewardPoints(AdminLogType::BADGE_GAINED, $user, [ 'multi' => 2 ]);

                $badgeType = AdminBadgeType::findOrFail($badgeTypeId);

                $options['adminBadgeType'] = $badgeType;
                $options['redirect'] = $redirect;
                return view('pages.admin_badges.badge', $options);
            }
        }

        /**
         * First badge - id: 8
         */
        $badgeTypeId = 8;
        $bookCreated = AdminLog::query()->where('type', '=', AdminLogType::BADGE_CREATED)->where('admin_id', '=', $user->id)->count();
        $haveBadge = AdminBadge::query()->where('admin_id', '=', $user->id)->where('admin_badge_type_id', '=', $badgeTypeId)->count();
        if ($bookCreated == 1 && $haveBadge == 0) {
            $badge = new AdminBadge();
            $badge->admin_id = $user->id;
            $badge->admin_badge_type_id = $badgeTypeId;
            $badge->save();

            self::rewardPoints(AdminLogType::BADGE_GAINED, $user, [ 'multi' => 2 ]);

            $badgeType = AdminBadgeType::findOrFail($badgeTypeId);

            $options['adminBadgeType'] = $badgeType;
            $options['redirect'] = $redirect;
            return view('pages.admin_badges.badge', $options);
        }

        /**
         * Black jack (21 points) - id: 9
         */
        $badgeTypeId = 9;
        $points = $user->points;
        $haveBadge = AdminBadge::query()->where('admin_id', '=', $user->id)->where('admin_badge_type_id', '=', $badgeTypeId)->count();
        if ($points >= 21 && $haveBadge == 0) {
            $badge = new AdminBadge();
            $badge->admin_id = $user->id;
            $badge->admin_badge_type_id = $badgeTypeId;
            $badge->save();

            self::rewardPoints(AdminLogType::BADGE_GAINED, $user, [ 'multi' => 1 ]);

            $badgeType = AdminBadgeType::findOrFail($badgeTypeId);

            $options['adminBadgeType'] = $badgeType;
            $options['redirect'] = $redirect;
            return view('pages.admin_badges.badge', $options);
        }

        /**
         * 100 points - id: 10
         */
        $badgeTypeId = 10;
        $points = $user->points;
        $haveBadge = AdminBadge::query()->where('admin_id', '=', $user->id)->where('admin_badge_type_id', '=', $badgeTypeId)->count();
        if ($points >= 100 && $haveBadge == 0) {
            $badge = new AdminBadge();
            $badge->admin_id = $user->id;
            $badge->admin_badge_type_id = $badgeTypeId;
            $badge->save();

            self::rewardPoints(AdminLogType::BADGE_GAINED, $user, [ 'multi' => 3 ]);

            $badgeType = AdminBadgeType::findOrFail($badgeTypeId);

            $options['adminBadgeType'] = $badgeType;
            $options['redirect'] = $redirect;
            return view('pages.admin_badges.badge', $options);
        }

        /**
         * 1000 points - id: 11
         */
        $badgeTypeId = 11;
        $points = $user->points;
        $haveBadge = AdminBadge::query()->where('admin_id', '=', $user->id)->where('admin_badge_type_id', '=', $badgeTypeId)->count();
        if ($points >= 1000 && $haveBadge == 0) {
            $badge = new AdminBadge();
            $badge->admin_id = $user->id;
            $badge->admin_badge_type_id = $badgeTypeId;
            $badge->save();

            self::rewardPoints(AdminLogType::BADGE_GAINED, $user, [ 'multi' => 5 ]);

            $badgeType = AdminBadgeType::findOrFail($badgeTypeId);

            $options['adminBadgeType'] = $badgeType;
            $options['redirect'] = $redirect;
            return view('pages.admin_badges.badge', $options);
        }

        /**
         * 10000 points - id: 12
         */
        $badgeTypeId = 12;
        $points = $user->points;
        $haveBadge = AdminBadge::query()->where('admin_id', '=', $user->id)->where('admin_badge_type_id', '=', $badgeTypeId)->count();
        if ($points >= 10000 && $haveBadge == 0) {
            $badge = new AdminBadge();
            $badge->admin_id = $user->id;
            $badge->admin_badge_type_id = $badgeTypeId;
            $badge->save();

            self::rewardPoints(AdminLogType::BADGE_GAINED, $user, [ 'multi' => 10 ]);

            $badgeType = AdminBadgeType::findOrFail($badgeTypeId);

            $options['adminBadgeType'] = $badgeType;
            $options['redirect'] = $redirect;
            return view('pages.admin_badges.badge', $options);
        }

        if ($page == ''){
            return redirect()->route($redirect, $options);
        }
        return view($page, $options);
    }



    public static function rewardPoints($type, Admin $user, $options = [ 'multi' => 1 ]) {
        switch ($type) {
            case AdminLogType::BOOK_CREATED:
                $user->points = $user->points + 5;
                break;
            case AdminLogType::BOOK_UPDATED:
                $user->points = $user->points + 1;
                break;
            case AdminLogType::BADGE_CREATED:
                $user->points = $user->points + 4;
                break;
            case AdminLogType::MINI_QUIZ_CREATED:
                $user->points = $user->points + 10;
                break;
            case AdminLogType::IDENTIFY_TEXT_QUIZ_CREATED:
                $user->points = $user->points + 9;
                break;
            case AdminLogType::IDENTIFY_CHARACTER_QUIZ_CREATED:
                $user->points = $user->points + 8;
                break;
            case AdminLogType::ADMIN_LOGGED:
                $user->points = $user->points + 1;
                break;
            case AdminLogType::BADGE_GAINED:
                $user->points = $user->points + (15 * $options['multi']);
        }

        $user->save();
    }
}