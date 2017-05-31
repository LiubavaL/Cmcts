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
                'max' => 'Max available size is :attribute Kb.',
                'mimes' => 'Inage must have jpg or png format.',
                'confirmed' => 'passwords are not equal.',
                'string' => 'Field can accept only letters.',
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
            case 'general':
                $rules = [
                    'email' => 'sometimes|required|email'
                ]
                ;break;
            case 'account':
                $rules = [
                    'password' => 'confirmed|min:6',
                    'about' => 'max:255',
                    'country' => 'string'
                ]
                ;break;
            case 'notifications':;break;
            case '':;break;
        }

        return $rules;
    }
}
