<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'name' => 'required|min:2',
            'email' => 'required|min:2|email:rfc,dns',
            'profile_photo_path' => 'image|nullable|mimes:jpg,jpeg,png',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Ad Soyad',
            'profile_photo_path' => 'Profil Fotoğrafı',
            'password' => 'Şifre',
            'password_confirmation' => 'Şifreyi Onayla',
        ];
    }
}
