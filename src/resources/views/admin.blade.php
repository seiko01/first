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
                    <select name="inquiry_type">
                        <option value="">お問い合わせの種類</option>
                        <option value="product" {{ request('inquiry_type') == 'product' ? 'selected' : '' }}>商品のお届けについて</option>
                        <option value="service" {{ request('inquiry_type') == 'service' ? 'selected' : '' }}>商品の交換について</option>
                        <option value="support" {{ request('inquiry_type') == 'support' ? 'selected' : '' }}>商品トラブル</option>
                        <option value="shop" {{ request('inquiry_type') == 'shop' ? 'selected' : '' }}>ショップへのお問い合わせ</option>
                        <option value="other" {{ request('inquiry_type') == 'other' ? 'selected' : '' }}>その他</option>
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
                                <td><a href="#modal-{{ $contact->id }}" class="btn-detail">詳細</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </body>
</html>