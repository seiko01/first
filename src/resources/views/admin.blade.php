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
                <a class="header__logo" href="/">FashionablyLate
                </a>
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
                        <option value="商品の交換について" {{ request('contact_type') == '商品の交換について' ? 'selected' : '' }}>商品の交換について</option>
                        <option value="その他" {{ request('contact_type') == 'その他' ? 'selected' : '' }}>その他</option>
                    </select>
                    <input type="date" name="date" value="{{ request('date') }}">
                    <button type="submit" class="btn-search">検索</button>
                    <a href="{{ route('admin.index') }}" class="btn-reset">リセット</a>
                </div>
            </form>
            <div class="export-page">
                <a href="{{ route('admin.export') }}" class="btn-export">エクスポート</a>
                <div class="pagination">
                    <div class="pagination-top">
                        {{ $contacts->links() }}
                    </div>
                </div>
            </div>
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
                            <td>{{ $contact->gender }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->contact_type }}</td>
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
                <p id="modal-data"></p>
                <button id="delete-btn" class="btn-delete">削除</button>
            </div>
        </div>
    </body>
</html>
