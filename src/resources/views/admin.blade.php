<!DOCTYPE html>
<html lang="ja">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Contact Form</title>
        <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
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
                    <select name="contact_type">
                        <option value="">お問い合わせの種類</option>
                        <option value="product" {{ request('contact_type') == 'product' ? 'selected' : '' }}>商品のお届けについて</option>
                        <option value="service" {{ request('contact_type') == 'service' ? 'selected' : '' }}>商品の交換について</option>
                        <option value="support" {{ request('contact_type') == 'support' ? 'selected' : '' }}>商品トラブル</option>
                        <option value="shop" {{ request('contact_type') == 'shop' ? 'selected' : '' }}>ショップへのお問い合わせ</option>
                        <option value="other" {{ request('contact_type') == 'other' ? 'selected' : '' }}>その他</option>
                    </select>
                    <input type="date" name="date" value="{{ request('date') }}">
                    <button type="submit" class="btn-search">検索</button>
                    <a href="{{ route('admin.index') }}" class="btn-reset">リセット</a>
                </div>
            </form>
            <div class="export-page">
                <a href="{{ route('admin.export') }}" class="btn-export">エクスポート</a>
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
                            <th>お問い合わせの種類</th>
                            <th>詳細</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contacts as $contact)
                            <tr>
                                <td>{{ $contact->name }}</td>
                                <td>
                                    @php
                                        $gender = $contact->gender;
                                        $genderText = '未設定'; // デフォルト値

                                        // 性別データを日本語で表示
                                        switch ($gender) {
                                            case 'male':
                                                $genderText = '男性';
                                                break;
                                            case 'female':
                                                $genderText = '女性';
                                                break;
                                            case 'other':
                                                $genderText = 'その他';
                                                break;
                                        }
                                    @endphp
                                    {{ $genderText }}
                                </td>
                                <td>{{ $contact->email }}</td>
                                <td>
                                    @php
                                        $inquiryType = $contact->inquiry_type;  // inquiry_typeに変更
                                        $inquiryTypeText = '不明';  // デフォルト値

                                        // お問い合わせ種類を日本語で表示
                                        switch ($inquiryType) {
                                            case 'product':
                                                $inquiryTypeText = '商品のお届けについて';
                                                break;
                                            case 'service':
                                                $inquiryTypeText = '商品の交換について';
                                                break;
                                            case 'support':
                                                $inquiryTypeText = '商品トラブル';
                                                break;
                                            case 'shop':
                                                $inquiryTypeText = 'ショップへのお問い合わせ';
                                                break;
                                            case 'other':
                                                $inquiryTypeText = 'その他';
                                                break;
                                        }
                                    @endphp
                                    {{ $inquiryTypeText }}
                                </td>
                                <td><button class="btn-detail" data-id="{{ $contact->id }}">詳細</button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- モーダル -->
            <div id="modal" class="modal hidden">
                <div class="modal-content">
                    <span class="close-btn">&times;</span>
                    <h2>詳細情報</h2>
                    <p><strong>お名前:</strong> <span id="modal-name"></span></p>
                    <p><strong>性別:</strong> <span id="modal-gender"></span></p>
                    <p><strong>メールアドレス:</strong> <span id="modal-email"></span></p>
                    <p><strong>電話番号:</strong> <span id="modal-phone"></span></p>
                    <p><strong>住所:</strong> <span id="modal-address"></span></p>
                    <p><strong>建物名:</strong> <span id="modal-building"></span></p>
                    <p><strong>お問い合わせの種類:</strong> <span id="modal-inquiry"></span></p>
                    <p><strong>お問い合わせ内容:</strong> <span id="modal-content"></span></p>

                    <div class="modal-footer">
                        <button id="delete-btn" class="btn-delete">削除</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            // モーダルの要素
            const modal = document.getElementById('modal');
            const closeBtn = document.querySelector('.close-btn');

            // 詳細情報を表示する関数
            function showModal(id) {
                // Ajaxリクエストを送信して詳細情報を取得
                fetch(`/admin/details/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        // モーダルの内容を設定
                        document.getElementById('modal-name').innerText = data.name;
                        document.getElementById('modal-gender').innerText = data.gender;
                        document.getElementById('modal-email').innerText = data.email;
                        document.getElementById('modal-phone').innerText = data.phone;  // 電話番号
                        document.getElementById('modal-address').innerText = data.address;  // 住所
                        document.getElementById('modal-building').innerText = data.building;  // 建物名
                        document.getElementById('modal-inquiry').innerText = data.contact_type;  // お問い合わせの種類
                        document.getElementById('modal-content').innerText = data.content;  // お問い合わせ内容

                        // モーダルを表示
                        modal.classList.add('visible');
                    })
                    .catch(error => console.error('Error:', error));
            }

            // 詳細ボタンにイベントリスナーを追加
            const detailButtons = document.querySelectorAll('.btn-detail');
            detailButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    showModal(id);  // ボタンのdata-id属性からIDを取得してモーダルを表示
                });
            });

            // モーダルを閉じる
            closeBtn.addEventListener('click', function() {
                modal.classList.remove('visible');
            });

            // モーダル外をクリックした場合にも閉じる
            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.classList.remove('visible');
                }
            });
        </script>
    </body>
</html>