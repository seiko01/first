<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
public function __construct()
    {
        // 未ログインのユーザーをログイン画面にリダイレクト
        $this->middleware('auth');
    }

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
        $contact = $request->only(['name', 'email', 'address', 'building', 'inquiry_type', 'content']);
        $contact['gender'] = $gender;
        $contact['tel'] = $tel;        

        // データを保存
        Contact::create($contact);

        return view('thanks');
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