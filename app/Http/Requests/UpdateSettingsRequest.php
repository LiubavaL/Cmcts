<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingsRequest extends FormRequest
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
                'mimes' => 'Изображение должно быть формата jpg или png.',
                'confirmed' => 'Пароли не совпадают.',
                'string' => 'Поле может соержать только буквы.',
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $activeTab = $this->input('tab');
        $rules = array();

        switch($activeTab) {
            case 'general':;break;
            case 'account':
                $rules = [
                    'cover' => 'image|mimes:jpeg,png,jpg',
                    'password' => 'confirmed|min:6',
                    'country' => 'string'
                ]
                ;break;
            case 'notifications':;break;
            case '':;break;
        }

        return $rules;
    }
}
