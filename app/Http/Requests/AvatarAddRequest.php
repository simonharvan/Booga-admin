<?php
/**
 * Created by PhpStorm.
 * User: simonharvan
 * Date: 1.6.17
 * Time: 18:34
 */

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class AvatarAddRequest extends FormRequest
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
            'name' => 'nullable',
            'description' => 'nullable',
            'profile_photo' => 'image'
        ];
    }
}