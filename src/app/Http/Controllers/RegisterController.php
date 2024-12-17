<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends Controller
{
    public function __construct()
    {
        // 全メソッドで認証チェック
        $this->middleware('guest');
    }
    public function index()
    {
        return view('auth.register'); // 正しいビュー名を指定
    }


    public function store(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:4',
        ]);

        // ユーザー登録
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // index.blade.php ビューを返す
        return redirect('/index')->with('success', '登録が完了しました');
    }
}
