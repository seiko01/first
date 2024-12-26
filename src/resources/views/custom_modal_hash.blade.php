<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>詳細モーダル</title>
    <style>
        /* モーダルの初期状態は非表示 */
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
            cursor: pointer;
            position: absolute;
            top: 10px;
            right: 10px;
        }

        /* モーダルが表示される際のスタイル */
        .modal:target {
            display: flex; /* URLのハッシュが#modal-<id>の時に表示 */
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
        }
    </style>
</head>
<body>

    <!-- モーダル本体 -->
    @foreach ($contacts as $contact)
        <div id="modal-{{ $contact->id }}" class="modal">
            <div class="modal-content">
                <span class="close-btn">&times;</span>
                <h2>詳細情報</h2>
                <p><strong>お名前:</strong> <span id="modal-name">{{ $contact->name }}</span></p>
                <p><strong>性別:</strong> <span id="modal-gender">{{ $contact->gender }}</span></p>
                <p><strong>メールアドレス:</strong> <span id="modal-email">{{ $contact->email }}</span></p>
                <p><strong>電話番号:</strong> <span id="modal-phone">{{ $contact->phone }}</span></p>
                <p><strong>住所:</strong> <span id="modal-address">{{ $contact->address }}</span></p>
                <p><strong>建物名:</strong> <span id="modal-building">{{ $contact->building }}</span></p>
                <p><strong>お問い合わせの種類:</strong> <span id="modal-inquiry">{{ $contact->inquiry_type }}</span></p>
                <p><strong>お問い合わせ内容:</strong> <span id="modal-content">{{ $contact->detail }}</span></p>

                <div class="modal-footer">
                    <button class="btn-delete">削除</button>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        // モーダルの閉じるボタンをクリックしたときにハッシュを削除
        document.querySelectorAll('.close-btn').forEach(button => {
            button.addEventListener('click', function () {
                window.location.hash = ''; // ハッシュを削除してモーダルを非表示にする
            });
        });
    </script>

</body>
</html>
