<?php
/**
 * Created by PhpStorm.
 * User: simonharvan
 * Date: 1.6.17
 * Time: 17:51
 */

namespace App\Models\Avatar;


trait AvatarPresenter
{
    public function getAvatarUrlAttribute()
    {
        $media = $this->getMedia()->first();

        return $media ? $media->url : asset('images/placeholder-avatar.png');
    }
}