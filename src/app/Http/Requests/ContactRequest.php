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
            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'tel1' => ['required', 'string', 'max:4'],
            'tel2' => ['required', 'string', 'max:4'],
            'tel3' => ['required', 'string', 'max:4'],
            'address' => ['required', 'string', 'max:255'],
            'building' => ['nullable', 'string', 'max:255'],
            'inquiry_type' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'max:120'],
        ];
    }
    public function messages()
    {
        return [
            'last_name.required' => '姓を入力してください。',
            'last_name.string' => '姓は文字列で入力してください。',
            'last_name.max' => '姓は255文字以内で入力してください。',
            'first_name.required' => '名を入力してください。',
            'first_name.string' => '名は文字列で入力してください。',
            'first_name.max' => '名は255文字以内で入力してください。',
            'gender.required' => '性別を選択してください。',
            'gender.string' => '性別の形式が不正です。',
            'email.required' => 'メールアドレスを入力してください。',
            'email.string' => 'メールアドレスは文字列で入力してください。',
            'email.email' => '有効なメールアドレスを入力してください。',
            'email.max' => 'メールアドレスは255文字以内で入力してください。',
            'tel1.required' => '電話番号（最初の3桁）を入力してください。',
            'tel1.string' => '電話番号は文字列で入力してください。',
            'tel1.max' => '電話番号（最初の3桁）は3桁以内で入力してください。',
            'tel2.required' => '電話番号（中間の4桁）を入力してください。',
            'tel2.string' => '電話番号は文字列で入力してください。',
            'tel2.max' => '電話番号（中間の4桁）は4桁以内で入力してください。',
            'tel3.required' => '電話番号（最後の4桁）を入力してください。',
            'tel3.string' => '電話番号は文字列で入力してください。',
            'tel3.max' => '電話番号（最後の4桁）は4桁以内で入力してください。',
            'address.required' => '住所を入力してください。',
            'address.string' => '住所は文字列で入力してください。',
            'address.max' => '住所は255文字以内で入力してください。',
            'building.string' => '建物名は文字列で入力してください。',
            'building.max' => '建物名は255文字以内で入力してください。',
            'inquiry_type.required' => 'お問い合わせの種類を選択してください。',
            'inquiry_type.string' => 'お問い合わせの種類の形式が不正です。',
            'content.required' => 'お問い合わせ内容を入力してください。',
            'content.string' => 'お問い合わせ内容は文字列で入力してください。',
            'content.max' => 'お問い合わせ内容は255文字以内で入力してください。',
        ];
    }
}
