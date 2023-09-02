<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WebinarRequest extends FormRequest
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
            'title' => ['min:3', 'max:20'],
            'description' => ['min:3', 'max:100'],
            'datetime' => ['min:3'],
            'place' => ['min:3', 'max:40'],
            'fee' => ['min:3', 'max:20'],
            'image_path' => ['image', 'file', 'max:1024'],
            'video_url' => ['min:3', 'max:100'],
            'meet_url' => ['min:3', 'max:100'],
            'poster_url' => ['min:3', 'max:100'],
        ];
    }
}
