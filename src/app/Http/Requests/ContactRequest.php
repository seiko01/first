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
            'gender' => ['required', 'integer', 'in:1,2,3'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'tell1' => ['required', 'string', 'max:4'],
            'tell2' => ['required', 'string', 'max:4'],
            'tell3' => ['required', 'string', 'max:4'],
            'address' => ['required', 'string', 'max:255'],
            'building' => ['nullable', 'string', 'max:255'],
            'detail' => ['required', 'string', 'max:120'],
            'category_id' => 'required|exists:categories,id'
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
            'gender.integer' => '性別の形式が不正です。',
            'email.required' => 'メールアドレスを入力してください。',
            'email.string' => 'メールアドレスは文字列で入力してください。',
            'email.email' => '有効なメールアドレスを入力してください。',
            'email.max' => 'メールアドレスは255文字以内で入力してください。',
            'tel1.required' => '電話番号（最初の3桁）を入力してください。',
            'tell1.string' => '電話番号は文字列で入力してください。',
            'tell1.max' => '電話番号（最初の3桁）は3桁以内で入力してください。',
            'tell2.required' => '電話番号（中間の4桁）を入力してください。',
            'tell2.string' => '電話番号は文字列で入力してください。',
            'tell2.max' => '電話番号（中間の4桁）は4桁以内で入力してください。',
            'tell3.required' => '電話番号（最後の4桁）を入力してください。',
            'tell3.string' => '電話番号は文字列で入力してください。',
            'tell3.max' => '電話番号（最後の4桁）は4桁以内で入力してください。',
            'address.required' => '住所を入力してください。',
            'address.string' => '住所は文字列で入力してください。',
            'address.max' => '住所は255文字以内で入力してください。',
            'building.string' => '建物名は文字列で入力してください。',
            'building.max' => '建物名は255文字以内で入力してください。',
            'detail.required' => 'お問い合わせ内容を入力してください。',
            'detail.string' => 'お問い合わせ内容は文字列で入力してください。',
            'detail.max' => 'お問い合わせ内容は120文字以内で入力してください。',
            'category_id.required' => 'お問い合わせの種類を選択してください。',
            'category_id.exists' => '選択されたお問い合わせの種類が無効です。',
        ];
    }
}