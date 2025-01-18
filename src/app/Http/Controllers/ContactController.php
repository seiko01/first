<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    public function __construct()
    {
        // 未ログインのユーザーをログイン画面にリダイレクト
        $this->middleware('auth');
    }

    public function index()
    {
        // カテゴリを取得
        $categories = Category::all();
        // ビューにデータを渡す
        return view('index', ['categories' => $categories]);

    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->only([
        'last_name', 'first_name', 'gender', 'email', 'tel1', 'tel2', 'tel3', 'address', 'building', 'category_id', 'detail'
        ]);

        $contact['name'] = $contact['first_name'] . ' ' . $contact['last_name'];
        $contact['gender_label'] = $this->getGenderLabel($contact['gender']);

        // category_id からカテゴリ名を取得
        $category = Category::find($contact['category_id']);

        $contact['category_label'] = $category ? $category->content : '未選択';

        $contact['tel'] = $contact['tel1'] . $contact['tel2'] . $contact['tel3'];

        return view('confirm', ['contact' => $contact]);
    }

    public function store(Request $request)
    {
        Contact::create($request->all());
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
            default:
                return '未選択';
        }
    }

    public function create()
    {
        // カテゴリーデータを取得してビューに渡す
        $categories = Category::all();
        return view('contacts.create', compact('categories'));
    }

        public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('admin.index');
    }

}