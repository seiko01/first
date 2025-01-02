<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>詳細モーダル</title>
    <style>
        /* 初期状態は非表示 */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        /* :targetでモーダルを表示 */
        .modal:target {
            display: flex !important;
        }
        /* モーダルのコンテンツ */
        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            width: 500px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        /* 閉じるボタン */
        .close-btn {
            font-size: 24px;
            color: #333;
            text-decoration: none;
            position: absolute;
            top: 10px;
            right: 10px;
        }

        /* フッターのスタイル */
        .modal-footer {
            text-align: right;
            margin-top: 20px;
        }

        /* 削除ボタン */
        .btn-delete {
            background-color: red;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* 詳細ボタン */
        .btn-info {
            text-decoration: none;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            margin: 5px;
            display: inline-block;
        }

        /* ボタンのホバー効果 */
        .btn-info:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <!-- 詳細ボタン -->
    @foreach ($contacts as $contact)
        <a href="#modal-{{ $contact->id }}" class="btn-info">詳細</a> <!-- 詳細ボタン -->
        <div id="modal-{{ $contact->id }}" class="modal">
            <div class="modal-content">
                <a href="#" class="close-btn">&times;</a>
                <h2>詳細情報</h2>
                <p><strong>お名前:</strong> {{ $contact->first_name }} {{ $contact->last_name }}</p>
                <p><strong>性別:</strong> {{ $contact->gender }}</p>
                <p><strong>メールアドレス:</strong> {{ $contact->email }}</p>
                <p><strong>電話番号:</strong> {{ $contact->tel }}</p>
                <p><strong>住所:</strong> {{ $contact->address }}</p>
                <p><strong>建物名:</strong> {{ $contact->building }}</p>
                <p><strong>お問い合わせの種類:</strong> {{ $contact->category ? $contact->category->content : '未選択' }}</p>
                <p><strong>お問い合わせ内容:</strong> {{ $contact->detail }}</p>
                <div class="modal-footer">
                    <button class="btn-delete">削除</button>
                </div>
            </div>
        </div>
    @endforeach

</body>
</html>
