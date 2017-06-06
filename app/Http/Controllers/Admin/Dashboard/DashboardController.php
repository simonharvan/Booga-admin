<?php namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Admin\AdminBadges\AdminBadgesController;
use App\Http\Controllers\Admin\Controller;
use App\Models\Admin\Admin;
use App\Models\AdminBadge\AdminBadge;
use App\Models\Book\BookType;
use App\Models\IdentifyCharacter\IdentifyCharacterQuiz;
use App\Models\IdentifyText\IdentifyTextQuiz;
use App\Models\MiniQuiz\MiniQuiz;
use App\Models\RealLibrary\RealLibrary;

class DashboardController extends Controller
{
    public function index()
    {
        $books = BookType::all(['id'])->count();
        $admins = Admin::where('points','>',100)->count();
        $badges = AdminBadge::all()->count();
        $quizzes = IdentifyCharacterQuiz::all()->count() + IdentifyTextQuiz::all()->count() + MiniQuiz::all()->count();

        $options = [
            'books' => $books,
            'admins' => $admins,
            'badges' => $badges,
            'quizzes' => $quizzes,
        ];

        return AdminBadgesController::checkForNewBadges('admin.dashboard.index', 'pages.dashboard', $options);
    }
}