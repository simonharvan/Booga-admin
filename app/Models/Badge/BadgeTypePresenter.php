<?php
/**
 * Created by PhpStorm.
 * User: simonharvan
 * Date: 5.6.17
 * Time: 12:41
 */

namespace App\Models\Badge;


trait BadgeTypePresenter
{
    public function getAvatarUrlAttribute()
    {
        $media = $this->getMedia()->first();

        return $media ? $media->url : asset('images/placeholder-badge.png');
    }
}