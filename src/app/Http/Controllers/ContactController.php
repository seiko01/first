<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->only(['last_name', 'first_name', 'gender', 'email', 'tel1', 'tel2', 'tel3', 'address', 'building','inquiry_type', 'content']);

        $contact['name'] = $contact['first_name'] . ' ' . $contact['last_name'];

        $contact['gender_label'] = $this->getGenderLabel($contact['gender']);
        $contact['inquiry_type_label'] = $this->getInquiryTypeLabel($contact['inquiry_type']);

        $contact['tel'] = $contact['tel1'] . $contact['tel2'] . $contact['tel3'];


        return view('confirm', ['contact' => $contact]);
    }

    public function store(Request $request)
    {
    // gender と tel のデフォルト値を設定
        $gender = $request->input('gender', 'unspecified');
        $tel = $request->input('tel', '未入力'); // tel にデフォルト値を設定

        // リクエストデータを取得し、gender と tel を上書き
        $contact = $request->only(['last_name', 'first_name', 'email', 'address', 'building', 'inquiry_type', 'content']);
        $contact['gender'] = $gender;
        $contact['tel'] = $tel;  // tel フィールドを上書き

        // データを保存
        Contact::create($contact);

        return view('thanks');
    }

    public function showConfirm(Request $request)
    {

    $first_name = $request->input('first_name');
    $last_name = $request->input('last_name');
    $gender = $request->input('gender');
    $email = $request->input('email');
    $tel = $request->input('tel1') . '-' . $request->input('tel2') . '-' . $request->input('tel3');
    $address = $request->input('address');
    $building = $request->input('building');
    $inquiry_type = $request->input('inquiry_type');
    $content = $request->input('content');

    $name = $first_name . ' ' . $last_name;
    $inquiry_type_label = $this->getInquiryTypeLabel($inquiry_type);

    $contact = [
        'name' => $name,
        'gender_label' => $this->getGenderLabel($gender),
        'email' => $email,
        'tel' => $tel,
        'address' => $address,
        'building' => $building,
        'inquiry_type' => $inquiry_type,
        'inquiry_type_label' => $inquiry_type_label,
        'content' => $content,
    ];

    return view('confirm', compact('contact'));
    }

    private function getGenderLabel($gender)
    {
    switch ($gender) {
        case 'male':
            return '男性';
        case 'female':
            return '女性';
        case 'other':
            return 'その他';
    }
    }

    private function getInquiryTypeLabel($inquiry_type)
    {
        switch ($inquiry_type) {
            case 'product':
                return '商品のお届けについて';
            case 'service':
                return '商品交換について';
            case 'support':
                return '商品トラブル';
            case 'shop':
                return 'ショップへのお問い合わせ';
            case 'other':
                return 'その他';
            default:
                return '未選択';
        }
    }
}