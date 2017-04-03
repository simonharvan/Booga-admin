<?php namespace App\Models\Admin;

use App\Models\AdminLog\AdminLog;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;


    protected $table = 'Admin';
    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];

    /*
     * Relations
     */
    public function logs()
    {
        return $this->hasMany(AdminLog::class);
    }
}
