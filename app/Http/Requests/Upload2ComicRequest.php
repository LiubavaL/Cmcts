<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Upload2ComicRequest extends FormRequest
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
            //'volume' => 'required',
            //'volume.*.chapter' => 'required',
            //'volume.*.title' => 'required',
            //'volume.*.chapter.*.title' => 'required',
            //'volume.*.chapter.*.chapter_images' => 'required'
        ];
    }
}
