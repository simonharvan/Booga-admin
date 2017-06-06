<?php
/**
 * Created by PhpStorm.
 * User: simonharvan
 * Date: 22.5.17
 * Time: 13:14
 */

namespace App\Models\Genre;


use App\Models\Citation\Citation;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table = 'Genre';

    public function citations() {
        return $this->hasMany(Citation::class);
    }
}