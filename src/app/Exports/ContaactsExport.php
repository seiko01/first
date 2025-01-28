<?php

namespace App\Exports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ContactsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Contact::all(); // ここで全データを返すか、検索結果に変更する
    }

    public function headings(): array
    {
        return [
            'お名前',
            '性別',
            'メールアドレス',
            '電話番号',
            '住所',
            'お問い合わせの種類',
            'お問い合わせの内容',
        ];
    }
}
