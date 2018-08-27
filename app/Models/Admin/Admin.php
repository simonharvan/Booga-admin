<?php namespace App\Models\Admin;

use App\Models\AdminBadge\AdminBadge;
use App\Models\AdminBadge\AdminBadgeType;
use App\Models\AdminLog\AdminLog;
use Devfactory\Media\MediaTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

class Admin extends Authenticatable
{
    use AdminPresenter, Notifiable, MediaTrait;

    protected $table = 'Admin';
    protected $fillable = ['name', 'email', 'password'];
    protected $casts = ['superadmin'=> 'boolean'];
    protected $hidden = ['password', 'remember_token'];
    protected $dates = ['deleted_at'];
    protected $with = ['media'];
    protected $appends = ['media'];

    public function media() {
        return $this->morphMany(config('media.config.model'), 'mediable');
    }

    public function adminLog()
    {
        return $this->hasMany(AdminLog::class, 'admin');
    }

    public function adminBadges() {
        return $this->hasMany(AdminBadge::class);
    }

    public function getImageUrl($conversion = null)
    {
        if (is_null($conversion)) {
            $imageUrl = $this->getMedia('profile_photos');
        } else {
            $media = $this->getMedia('profile_photos');
            $imageUrl = is_null($media) ? asset('images/placeholder-'. $conversion .'.png') : $this->getMedia('profile_photos', $conversion);
        }

        return $imageUrl;
    }
}
