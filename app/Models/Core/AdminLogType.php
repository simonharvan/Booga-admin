<?php
/**
 * Created by PhpStorm.
 * User: simonharvan
 * Date: 1.4.17
 * Time: 23:18
 */

namespace App\Models\Core;


use App\Models\Core\Enum;

class AdminLogType extends Enum
{
    const ADMIN_CREATED = 'admin_created';
    const ADMIN_UPDATED = 'admin_updated';
    const ADMIN_DELETED = 'admin_deleted';

    const BOOK_CREATED = 'book_created';
    const BOOK_UPDATED = 'book_updated';
    const BOOK_DELETED = 'book_deleted';

    const MINI_QUIZ_CREATED = 'mini_quiz_created';
    const MINI_QUIZ_UPDATED = 'mini_quiz_updated';
    const MINI_QUIZ_DELETED = 'mini_quiz_deleted';

    const IDENTIFY_CHARACTER_QUIZ_CREATED = 'identify_character_quiz_created';
    const IDENTIFY_CHARACTER_QUIZ_UPDATED = 'identify_character_quiz_updated';
    const IDENTIFY_CHARACTER_QUIZ_DELETED = 'identify_character_quiz_deleted';

    const IDENTIFY_TEXT_QUIZ_CREATED = 'identify_text_quiz_created';
    const IDENTIFY_TEXT_QUIZ_UPDATED = 'identify_text_quiz_updated';
    const IDENTIFY_TEXT_QUIZ_DELETED = 'identify_text_quiz_deleted';

    const ADMIN_LOGGED = 'admin_logged';
    const ADMIN_LOGGED_OUT = 'admin_logged_out';

    const BADGE_CREATED = 'badge_created';
    const BADGE_UPDATED = 'badge_updated';
    const BADGE_DELETED = 'badge_deleted';

    const AVATAR_CREATED = 'avatar_created';
    const AVATAR_UPDATED = 'avatar_updated';
    const AVATAR_DELETED = 'avatar_deleted';

    const BADGE_GAINED = 'badge_gained';
}