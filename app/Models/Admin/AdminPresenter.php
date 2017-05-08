<?php namespace App\Models\Admin;

trait AdminPresenter
{
    public function getAvatarUrlAttribute()
    {
        $media = $this->getMedia()->first();

        return $media ? $media->url : asset('images/placeholder-avatar.png');
    }
}