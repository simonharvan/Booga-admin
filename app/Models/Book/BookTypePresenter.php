<?php
/**
 * Created by PhpStorm.
 * User: simonharvan
 * Date: 22.5.17
 * Time: 18:15
 */

namespace App\Models\Book;


trait BookTypePresenter
{
    public function getAvatarUrlAttribute()
    {
        $media = $this->getMedia()->first();

        if ($media){
            return $media->url;
        }

        if ($this->image_url != null) {
            return $this->image_url;
        }

        return asset('images/placeholder-avatar.png');
    }
}