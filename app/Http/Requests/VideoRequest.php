<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'language' => 'required|string|max:10',
            'title' => 'required|string|max:255',
            'youtube_url' => 'required|url',
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'language.required' => 'Язык обязателен',
            'language.max' => 'Язык не должен превышать 10 символов',
            'title.required' => 'Название обязательно',
            'youtube_url.required' => 'YouTube ссылка обязательна',
            'youtube_url.url' => 'Некорректный формат URL',
        ];
    }
}
