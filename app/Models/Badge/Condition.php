<?php
/**
 * Created by PhpStorm.
 * User: simonharvan
 * Date: 5.6.17
 * Time: 12:38
 */

namespace App\Models\Badge;


use App\Models\EventType\EventType;
use Illuminate\Database\Eloquent\Model;

class Condition extends Model
{
    protected $table = 'Condition';
    protected $with = ['condition', 'eventType'];
    protected $appends = ['condition', 'eventType'];

    public $timestamps = false;

    public function eventType() {
        return $this->belongsTo(EventType::class);
    }

    public function condition() {
        return $this->belongsTo(Condition::class);
    }
}