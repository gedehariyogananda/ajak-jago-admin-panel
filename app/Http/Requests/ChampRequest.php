<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChampRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required'],
            'description' => ['required'],
            'start_date_reg' => ['date'],
            'end_date_reg' => ['date'],
            'time_long' => ['required'],
            'place' => ['required'],
            'fee' => ['required'],
            'image_path' => ['image', 'file', 'max:3000'],
            'wa_group_url' => ['required'],
        ];
    }
}
