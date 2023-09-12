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
            'title' => ['min:3'],
            'description' => ['min:3'],
            'datetime' => ['min:3'],
            'place' => ['min:3'],
            'fee' => ['min:3'],
            'image_path' => ['image', 'file', 'max:3000'],
            'video_url' => ['min:0'],
            'meet_url' => ['min:0'],
            'poster_url' => ['min:3'],
        ];
    }
}
