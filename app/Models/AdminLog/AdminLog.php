<?php
/**
 * Created by PhpStorm.
 * User: simonharvan
 * Date: 1.4.17
 * Time: 23:09
 */

namespace App\Models\AdminLog;


use App\Models\Admin\Admin;
use Illuminate\Database\Eloquent\Model;

class AdminLog extends Model
{
    protected $table = 'Admin_log';

    protected $fillable = ['admin_id', 'text', 'type'];



    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}