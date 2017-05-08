<?php namespace App\Models\Book;

use Devfactory\Media\MediaTrait;
use Illuminate\Database\Eloquent\Model;

class BookType extends Model
{
    use MediaTrait;

    protected $table = 'Book_type';
    protected $dates = ['deleted_at'];
    protected $with = ['media'];
    protected $appends = ['media'];


    public function media() {
        return $this->morphMany(config('media.config.model'), 'mediable');
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