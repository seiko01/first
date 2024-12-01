<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'password', 'max:255'],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'お名前を入力してください',
            'name.string' => 'お名前を文字列で入力してください',
            'name.max' => 'お名前を255文字以下で入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.string' => 'メールアドレスを文字列で入力してください',
            'email.email' => 'メールアドレスは「ユーザー名＠ドメイン」形式で入力してください',
            'email.max' => 'メールアドレスを255文字以下で入力してください',
            'password.required' => 'パスワードを入力してください',
            'password.numeric' => 'パスワードを数値で入力してください',
        ];
    }
}
