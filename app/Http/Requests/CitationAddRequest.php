<?php
/**
 * Created by PhpStorm.
 * User: simonharvan
 * Date: 31.5.17
 * Time: 20:48
 */

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class CitationAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'text' => 'required',
            'author' => 'nullable',
            'from' => 'required',
            'to' => 'required',
            'genre' => 'nullable'
        ];
    }
}