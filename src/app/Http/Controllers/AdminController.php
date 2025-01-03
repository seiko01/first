<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AdminController extends Controller
{
        // 管理画面の表示（初期表示・検索結果表示）
    public function index(Request $request)
    {
        // 初期クエリビルダー
        $query = Contact::query();

        // 名前またはメールアドレスで検索
        if ($request->has('name') && $request->name != '') {
            $query->where(function($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->name . '%')
                ->orWhere('last_name', 'like', '%' . $request->name . '%')
                ->orWhere('email', 'like', '%' . $request->name . '%');
            });
        }

        // 性別で検索
        if ($request->has('gender') && $request->gender != '') {
            $query->where('gender', $request->gender);
        }

        // カテゴリで検索（inquiry_typeではなくcategory_idを使用）
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        // 日付で検索
        if ($request->has('date') && $request->date != '') {
            $query->whereDate('created_at', $request->date);
        }

        // 検索結果を取得してページネーションを適用
        $contacts = $query->paginate(7);

        // ビューに変数を渡す
        return view('admin', ['contacts' => $contacts]);
    }

    // 詳細データ表示
    public function details($id)
    {
        $contact = Contact::with('category')->findOrFail($id); // リレーションをロード
        $category = $contact->category ? $contact->category->name : '未選択';
        return view('custom_modal_hash', compact('contact', 'category'));
    }


    // CSVエクスポート機能
    public function export(Request $request)
    {
        $query = Contact::with('category');

        // 絞り込み検索条件を考慮
        if ($request->filled('name')) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'LIKE', '%' . $request->name . '%')
                  ->orWhere('last_name', 'LIKE', '%' . $request->name . '%')
                  ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%' . $request->name . '%']);
            });
        }

        if ($request->filled('email')) {
            $query->where('email', 'LIKE', '%' . $request->email . '%');
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->get();

        // CSV生成処理
        $filename = 'contacts_export_' . now()->format('Y_m_d_H_i_s') . '.csv';
        $path = storage_path('app/' . $filename);
        $handle = fopen($path, 'w');

        // ヘッダー
        fputcsv($handle, ['ID', '名前', '性別', 'メールアドレス', 'カテゴリ', '内容', '日付']);

        // データ
        foreach ($contacts as $contact) {
            $categoryName = $contact->category ? $contact->category->name : '未選択';
            $fullName = $contact->first_name . ' ' . $contact->last_name;
            fputcsv($handle, [
                $contact->id,
                $fullName,
                $contact->gender,
                $contact->email,
                $categoryName,
                $contact->content,
                $contact->created_at,
            ]);
        }
        fclose($handle);

        return response()->download($path)->deleteFileAfterSend(true);
    }
}
