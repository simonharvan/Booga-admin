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
    const ADMIN_UPDATED = 'admin_updated';
    const ADMIN_CREATED = 'admin_created';
}