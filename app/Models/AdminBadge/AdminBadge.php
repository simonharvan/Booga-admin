<?php
/**
 * Created by PhpStorm.
 * User: simonharvan
 * Date: 6.6.17
 * Time: 10:50
 */

namespace App\Models\AdminBadge;


use App\Models\Admin\Admin;
use Illuminate\Database\Eloquent\Model;

class AdminBadge extends Model
{
    protected $table = 'Admin_badge';

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function adminBadgeType()
    {
        return $this->belongsTo(AdminBadgeType::class);
    }
}