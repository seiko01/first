<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <style>
        /* モーダル背景 */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: none;
            z-index: 1000;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        /* モーダル本体 */
        .modal {
            position: fixed;  /* 固定位置に設定 */
            top: 50%;          /* 画面の垂直中央 */
            left: 50%;         /* 画面の水平中央 */
            transform: translate(-50%, -50%); /* 自身の幅・高さ分だけ移動して中央に */
            background-color: #fff;
            padding: 100px;
            color: #8B7969;
            z-index: 1001;
            width: 100%;        /* 横幅を80%に設定 */
            max-width: 600px;  /* 最大幅を設定 */
        }
        /* ハッシュターゲットのスタイル適用 */
        :target.modal-overlay {
            display: block;
        }

        :target .modal {
            display: block;
        }

        /* 閉じるボタン */
        .modal-close {
            font-size: 24px;
            color: #fff; /* バツの色を白に */
            text-decoration: none;
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #333; /* 背景色を設定 */
            width: 30px;  /* 丸の直径 */
            height: 30px; /* 丸の直径 */
            border-radius: 50%; /* 丸くする */
            display: flex;
            justify-content: center; /* 水平中央 */
            align-items: center; /* 垂直中央 */
            text-align: center;
        }

        .modal-close:hover {
            background-color: #555; /* ホバー時の色 */
        }
        .modal-close:hover {
            color: red;
        }

        /* 各情報のスタイル */
        .modal p {
            display: flex;
            justify-content: flex-start;
            margin-bottom: 10px;
            font-size: 14px;
            line-height: 1.6;
            color: #8B7969;
            text-align: left; /* 親要素で左寄せ */
            align-items: center;
        }

        .modal h2 {
            text-align: center; /* 見出しを中央に */
        }

        .modal p strong {
            color: #8B7969;
            display: inline-block;
            width: 150px;  /* ラベル部分の幅を指定して整列 */
            text-align: left;
            margin-right: 10px;
        }

        .modal p span {
            flex: 1; /* 内容部分を残りの幅に広げる */
            text-align: left; /* 左寄せ */
            color: #8B7969;
        }

         /* 削除ボタン */
        .modal-delete {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #e74c3c;
            color: white;
            text-align: center;
            border: none;
            cursor: pointer;
        }

        .modal-delete:hover {
            background-color: #c0392b;
        }

    </style>
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <!-- ロゴ -->
            <a class="header__logo" href="/">FashionablyLate</a>

            <!-- ログアウトボタン -->
            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                @csrf
                <button type="submit" class="btn-logout">ログアウト</button>
            </form>
        </div>
    </header>
    <main>
        <div class="admin__content">
            <div class="admin__heading">
                <h2>Admin</h2>
            </div>
        </div>
        <form action="{{ route('admin.index') }}" method="GET" class="search-form">
        @csrf
            <div class="search-fields">
                <input type="text" name="name" placeholder="名前やメールアドレスを入力してください" value="{{ request('name') }}">
                <select name="gender">
                    <option value="">性別</option>
                    <option value="男性" {{ request('gender') == '男性' ? 'selected' : '' }}>男性</option>
                    <option value="女性" {{ request('gender') == '女性' ? 'selected' : '' }}>女性</option>
                    <option value="その他" {{ request('gender') == 'その他' ? 'selected' : '' }}>その他</option>
                </select>
                <select name="category_id">
                    <option value="">お問い合わせの種類</option>
                    <option value="1" {{ request('category_id') == '1' ? 'selected' : '' }}>商品のお届けについて</option>
                    <option value="2" {{ request('category_id') == '2' ? 'selected' : '' }}>商品の交換について</option>
                    <option value="3" {{ request('category_id') == '3' ? 'selected' : '' }}>商品トラブル</option>
                    <option value="4" {{ request('category_id') == '4' ? 'selected' : '' }}>ショップへのお問い合わせ</option>
                    <option value="5" {{ request('category_id') == '5' ? 'selected' : '' }}>その他</option>
                </select>
                <input type="date" name="date" value="{{ request('date') }}">
                <button type="submit" class="btn-search">検索</button>
                <a href="{{ route('admin.index') }}" class="btn-reset">リセット</a>
            </div>
        </form>
        <div class="export-page">
            <a href="{{ route('admin.export', request()->query()) }}" class="btn-export">エクスポート</a>
            <div class="pagination">
                <div class="paginationーtop">
                    {{ $contacts->links('vendor.pagination.tailwind') }}
                </div>
            </div>
        </div>
        <div class="table-wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th>お名前</th>
                        <th>性別</th>
                        <th>メールアドレス</th>
                        <th>お問合せの種類</th>
                        <th>詳細</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)
                        <tr>
                            <td>{{ $contact->first_name . ' ' . $contact->last_name }}</td>
                            <td>
                                {{ $contact->gender == 'male' ? '男性' : ($contact->gender == 'female' ? '女性' : 'その他') }}
                            </td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->category ? $contact->category->content : '未選択' }}</td>
                            <td><a href="#modal-{{ $contact->id }}" class="btn-info">詳細</a></td>
                        </tr>
                        <div id="modal-{{ $contact->id }}" class="modal-overlay">
                            <div class="modal">
                                <a href="#" class="modal-close">&times;</a>
                                <h2>お問い合わせ詳細</h2>
                                <p><strong>お名前:</strong> <span>{{ $contact->first_name . ' ' . $contact->last_name }}</span></p>
                                <p><strong>性別:</strong> <span>{{ $contact->gender == 'male' ? '男性' : ($contact->gender == 'female' ? '女性' : 'その他') }}</span></p>
                                <p><strong>メールアドレス:</strong> <span>{{ $contact->email }}</span></p>
                                <p><strong>電話番号:</strong> <span>{{ $contact->tel }}</span></p>
                                <p><strong>住所:</strong> <span>{{ $contact->address }}</span></p>
                                <p><strong>建物名:</strong> <span>{{ $contact->building }}</span></p>
                                <p><strong>お問い合わせの種類:</strong> <span>{{ $contact->category ? $contact->category->content : '未選択' }}</span></p>
                                <p><strong>お問い合わせの内容:</strong> <span>{{ $contact->detail }}</span></p>
                        <!-- 削除ボタン -->
                                <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" class="modal-delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="modal-delete">削除</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>
