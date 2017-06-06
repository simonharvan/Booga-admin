<?php
/**
 * Created by PhpStorm.
 * User: simonharvan
 * Date: 1.6.17
 * Time: 17:48
 */

namespace App\Models\Avatar;


use Devfactory\Media\MediaTrait;
use Illuminate\Database\Eloquent\Model;

class AvatarType extends Model
{
    use AvatarPresenter, MediaTrait;

    protected $table = 'Avatar_type';
    protected $with = ['media'];
    protected $appends = ['media'];

    public function media() {
        return $this->morphMany(config('media.config.model'), 'mediable');
    }
}