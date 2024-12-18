<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Admin Page</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <h1>FashionablyLate</h1>

    <!-- 検索フォーム -->
    <form method="GET" action="{{ route('admin.index') }}">
        <input type="text" name="name" value="{{ old('name', $search['name'] ?? '') }}" placeholder="名前で検索">
        <input type="email" name="email" value="{{ old('email', $search['email'] ?? '') }}" placeholder="メールアドレスで検索">
        <select name="gender">
            <option value="">性別</option>
            <option value="male" {{ isset($search['gender']) && $search['gender'] == 'male' ? 'selected' : '' }}>男性</option>
            <option value="female" {{ isset($search['gender']) && $search['gender'] == 'female' ? 'selected' : '' }}>女性</option>
        </select>
        <button type="submit">検索</button>
        <a href="{{ route('admin.index') }}">リセット</a>
    </form>

    <!-- CSVエクスポート -->
    <a href="{{ route('admin.export', request()->all()) }}" class="btn btn-success">CSVエクスポート</a>

    <!-- データ表示 -->
    <table border="1">
        <thead>
            <tr>
                <th>名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>お問い合わせ種類</th>
                <th>詳細</th>
                <th>削除</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
                <tr>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->gender }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->contact_type }}</td>
                    <td>
                        <button onclick="showDetails({{ $contact->id }})">詳細</button>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.delete', $contact->id) }}">
                            @csrf
                            <button type="submit">削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- ページネーション -->
    <div>
        {{ $contacts->links() }}
    </div>

    <!-- 詳細モーダル -->
    <div id="modal" style="display:none;">
        <div id="modal-content"></div>
        <button onclick="closeModal()">閉じる</button>
    </div>

    <script>
        function showDetails(id) {
            fetch(`/admin/details/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('modal-content').innerText = JSON.stringify(data, null, 2);
                    document.getElementById('modal').style.display = 'block';
                });
        }

        function closeModal() {
            document.getElementById('modal').style.display = 'none';
        }
    </script>
</body>
</html>
