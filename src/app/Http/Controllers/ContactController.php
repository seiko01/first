<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function confirm(Request $request)
    {

    $validated = $request->validate([
        'last_name' => 'required|string|max:255',
        'first_name' => 'required|string|max:255',
        'gender' => 'required|in:male,female,other',
        'email' => 'required|email|max:255',
        'tel1' => 'nullable|regex:/^\d{0,4}$/',
        'tel2' => 'nullable|regex:/^\d{0,4}$/',
        'tel3' => 'nullable|regex:/^\d{0,4}$/',        'address' => 'required|string|max:255',
        'building' => 'nullable|string|max:255',
        'inquiry_type' => 'required|string|max:255',
        'content' => 'required|string|max:1000',
    ]);

        $validated['tel'] = trim(
            $validated['tel1'] . $validated['tel2'] . $validated['tel3']
        );

    $genderLabels = [
        'male' => '男性',
        'female' => '女性',
        'other' => 'その他',
    ];

    $inquiryTypeLabels = [
        'product' => '商品のお届けについて',
        'service' => '商品交換について',
        'support' => '商品トラブル',
        'shop' => 'ショップへのお問い合わせ',
        'other' => 'その他'
    ];

    $contact = $validated;
    $contact['name'] = $validated['last_name'] . ' ' . $validated['first_name'];
    $contact['gender_label'] = $genderLabels[$validated['gender']];

    $contact['inquiry_type_label'] = $inquiryTypeLabels[$validated['inquiry_type']] ?? '未選択';
    
    return view('confirm', compact('contact'));
    }
}