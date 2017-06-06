<?php
/**
 * Created by PhpStorm.
 * User: simonharvan
 * Date: 5.6.17
 * Time: 11:29
 */

namespace App\Models\Badge;


use Devfactory\Media\MediaTrait;
use Illuminate\Database\Eloquent\Model;

class BadgeType extends Model
{
    use BadgeTypePresenter, MediaTrait;

    protected $table = 'Badge_type';
    protected $with = ['media'];
    protected $appends = ['media'];

    public function condition() {
        return $this->belongsTo(Condition::class);
    }

    public function media() {
        return $this->morphMany(config('media.config.model'), 'mediable');
    }
}