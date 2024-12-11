<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
    </head>

    <body>
        <header class="header">
            <div class="header__inner">
                <a class="header__logo" href="/">FashionablyLate
                </a>
            </div>
        </header>
        <main>
            <div class="confirm__content">
                <div class="confirm__heading">
                    <h2>Confirm</h2>
                </div>
                <form class="form" action="/contacts" method="post">
                @csrf
                    <div class="confirm-table">
                        <table class="confirm-table__inner">
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">お名前</th>
                            <td class="confirm-table__text">
                                    <input type="text" name="name" value="{{ $contact['name'] }}" readonly />
                            </td>
                        </tr>
                            <tr class="confirm-table__row">
                                <th class="confirm-table__header">性別</th>
                                <td class="confirm-table__text" style="text-align: left;">{{ $contact['gender_label'] }}
                                </td>
                            </tr>
                            <tr class="confirm-table__row">
                                <th class="confirm-table__header">メールアドレス</th>
                                <td class="confirm-table__text">
                                    <input type="email" name="email" value="{{ $contact['email'] }}" readonly />
                                </td>
                            </tr>
                            <tr class="confirm-table__row">
                                <th class="confirm-table__header">電話番号</th>
                                <td class="confirm-table__text">
                                    <input type="tel" name="tel" value="{{ $contact['tel'] ?? '未入力' }}" readonly />
                                </td>
                            </tr>
                            <tr class="confirm-table__row">
                                <th class="confirm-table__header">住所</th>
                                <td class="confirm-table__text">
                                    <input type="text" name="address" value="{{ $contact['address'] }}" readonly />
                                </td>
                            </tr>
                            <tr class="confirm-table__row">
                                <th class="confirm-table__header">建物名</th>
                                <td class="confirm-table__text">
                                    <input type="text" name="building" value="{{ $contact['building'] }}" readonly />
                                </td>
                            </tr>
                            <tr class="confirm-table__row">
                                <th class="confirm-table__header">お問い合せの種類</th>
                                <td class="confirm-table__text">
                                    <select name="inquiry_type" id="inquiry_type" disabled>
                                    <option value="{{ $contact['inquiry_type'] }}" selected> {{ $contact['inquiry_type_label'] }}</option>
                                    </select>
                                    <input type="hidden" name="inquiry_type" value="{{ $contact['inquiry_type'] }}" />
                                </td>
                            </tr>
                            <tr class="confirm-table__row">
                                <th class="confirm-table__header">お問い合わせ内容</th>
                                <td class="confirm-table__text">
                                    <input type="text" name="content" value="{{ $contact['content'] }}" readonly />
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="form__button">
                        <button class="form__button-submit" type="submit">送信</button>
                        <button class="form__button-back" type="button" onclick="history.back()">修正</button>
                    </div>
                </form>
            </div>
        </main>
    </body>
</html>