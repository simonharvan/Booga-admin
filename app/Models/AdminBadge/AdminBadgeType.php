<?php
/**
 * Created by PhpStorm.
 * User: simonharvan
 * Date: 6.6.17
 * Time: 10:24
 */

namespace App\Models\AdminBadge;


use App\Models\Admin\Admin;
use Devfactory\Media\MediaTrait;
use Illuminate\Database\Eloquent\Model;

class AdminBadgeType extends Model
{
    use MediaTrait;

    protected $table = 'Admin_badge_type';
    protected $with = ['media'];
    protected $appends = ['media'];
    public $timestamps = false;

    public function adminBadges() {
        return $this->hasMany(AdminBadge::class);
    }

    public function media() {
        return $this->morphMany(config('media.config.model'), 'mediable');
    }
}