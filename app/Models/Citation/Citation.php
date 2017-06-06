<?php
/**
 * Created by PhpStorm.
 * User: simonharvan
 * Date: 22.5.17
 * Time: 18:11
 */

namespace App\Models\Citation;


use App\Models\Genre\Genre;
use Illuminate\Database\Eloquent\Model;

class Citation extends Model
{
    protected $table = 'Citation';

    public function genre() {
        return $this->belongsTo(Genre::class);
    }
}