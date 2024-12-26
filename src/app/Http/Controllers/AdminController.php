<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact; // お問い合わせモデル
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{
    // 管理画面の表示（初期表示・検索結果表示）
    public function index(Request $request)
    {
        $query = Contact::query();

        // 検索条件
        if ($request->filled('name')) {
                $query->where(function ($q) use ($request) {
                    $q->where('name', 'LIKE', '%' . $request->name . '%')
                    ->orWhere('email', 'LIKE', '%' . $request->name . '%');
                });
        }
        if ($request->filled('gender')) {
                $query->where('gender', $request->gender);
        }

        if ($request->filled('contact_type')) {
                $query->where('contact_type', $request->contact_type);
        }
        
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // ページネーション: 7件ごとに表示
        $contacts = $query->paginate(7);

        // 検索条件もビューに渡す
        return view('admin', [
            'contacts' => $contacts,
            'search' => $request->all(), // 検索条件をビューへ渡す
        ]);
    }

    // 詳細データ表示
    public function details($id)
    {
        $contact = Contact::findOrFail($id);  // データ取得
        return view('custom_modal_hash', compact('contact'));
    }

    // 削除機能
    public function delete($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('admin.index')->with('success', 'データを削除しました。');
    }

    // CSVエクスポート機能
    public function export(Request $request)
    {
        $query = Contact::query();

        // 絞り込み検索条件を考慮
        if ($request->filled('name')) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'LIKE', '%' . $request->email . '%');
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('contact_type')) {
            $query->where('contact_type', $request->contact_type);
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
        fputcsv($handle, ['ID', '名前', '性別', 'メールアドレス', 'お問い合わせ種類', '内容', '日付']);

        // データ
        foreach ($contacts as $contact) {
            fputcsv($handle, [
                $contact->id,
                $contact->name,
                $contact->gender,
                $contact->email,
                $contact->contact_type,
                $contact->content,
                $contact->created_at,
            ]);
        }
        fclose($handle);

        // CSVをダウンロード後、ファイルを削除
        return response()->download($path)->deleteFileAfterSend(true);
    }
}