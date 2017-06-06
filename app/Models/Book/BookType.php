<?php namespace App\Models\Book;

use App\Models\Genre\Genre;
use App\Models\IdentifyCharacter\IdentifyCharacterQuiz;
use App\Models\IdentifyText\IdentifyTextQuiz;
use App\Models\MiniQuiz\MiniQuiz;
use Devfactory\Media\MediaTrait;
use Illuminate\Database\Eloquent\Model;

class BookType extends Model
{
    use MediaTrait, BookTypePresenter;

    protected $table = 'Book_type';
    protected $dates = ['created_at','updated_at','deleted_at'];
    protected $fillable = ['name', 'isbn'];
    protected $with = ['media'];
    protected $appends = ['media'];

    const NEW_STATE = 'New';
    const IN_PROGRESS = 'In progress';
    const DONE = 'Done';

    public function identifyTextQuiz(){
        return $this->belongsTo(IdentifyTextQuiz::class, 'identify_text_quiz_id');
    }

    public function identifyCharacterQuiz(){
        return $this->belongsTo(IdentifyCharacterQuiz::class, 'identify_character_quiz_id');
    }

    public function miniQuiz(){
        return $this->belongsTo(MiniQuiz::class, 'mini_quiz_id');
    }

    public function media() {
        return $this->morphMany(config('media.config.model'), 'mediable');
    }


    public function genre() {
        return $this->belongsTo(Genre::class);
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