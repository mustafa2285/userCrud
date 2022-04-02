<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ArticleCreateRequest extends FormRequest
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
            'title' => 'required|min:1',
            'article' => 'required|min:200',
            'image' => 'image|nullable|mimes:jpg,jpeg,png',
        ];
    }
    public function attributes()
    {
        return [
            'title' => 'Makale Başlığı',
            'article' => 'Makale',
            'image' => 'Makale Fotoğrafı',
        ];
    }
}
