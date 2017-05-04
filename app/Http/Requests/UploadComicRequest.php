<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadComicRequest extends FormRequest
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
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        $parentMessages = parent::messages();
        return array_merge(
            $parentMessages,
            [
                'max' => 'Рвзмер изображения не должен превыщать :attribute Кб.',
                'image' => 'Некорректный формат изображения.',
                'mimes' => 'Изображение должно быть формата zip.',
                'confirmed' => 'Пароли не совпадают.',
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'description' => 'required',
            //'cover' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'cover_slide' => 'image|mimes:jpeg,png,jpg|max:2048',
            'genres' => 'required',
            'volume' => 'required',
            //'volume.*.chapter' => 'required',
            //'volume.*.title' => 'required',
            //'volume.*.chapter.*.title' => 'required',
            //'volume.*.chapter.*.chapter_images' => 'required'
        ];
    }

}
