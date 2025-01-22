<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/modal.css') }}" />

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
