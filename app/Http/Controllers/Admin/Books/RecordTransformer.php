<?php
/**
 * Created by PhpStorm.
 * User: simonharvan
 * Date: 31.5.17
 * Time: 10:51
 */

namespace App\Http\Controllers\Admin\Books;


class RecordTransformer
{
    public static function transform($record){
        return [
            'title' => $record->title,
            'year_published' => $record->year,
            'author' => isset($record->creators[0]) ? $record->creators[0]['name']. " " . $record->creators[0]['surname'] : null,
            'isbn' => isset($record->isbns[0]) ? $record->isbns[0] : null,
            'note' => isset($record->notes[0]) > 0 ? $record->notes[0] : null,
        ];
    }
}