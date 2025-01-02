<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/">FashionablyLate
            </a>
        </div>
    </header>
    <main>
        <div class="contact-form__content">
            <div class="contact-form__heading">
                <h2>Contact</h2>
            </div>
            <form method="POST" action="{{ route('contacts.confirm') }}">
            @csrf
                <!--お名前-->
                <div class="form__group--name">
                    <div class="form__group-title">
                        <span class="form__label--item">お名前</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <div class="form__input-wrapper">
                                <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="例：山田" />
                                <div class="form__error">
                                    @error('first_name')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form__input-wrapper">
                                <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="例：太郎" />
                                <div class="form__error">
                                    @error('last_name')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--性別-->
                <div class="form__group--gender">
                    <div class="form__group-title">
                        <span class="form__label--item">性別</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--radio">
                            <label>
                                <input type="radio" name="gender" value="male" {{ old('gender') == 'male' ? 'checked' : '' }}  checked /> 男性
                            </label>
                            <label>
                                <input type="radio" name="gender" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}/> 女性
                            </label>
                            <label>
                                <input type="radio" name="gender" value="other" {{ old('gender') == 'other' ? 'checked' : '' }} /> その他
                            </label>
                        </div>
                        <div class="form__error">
                            @error('gender')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <!--メルアド-->
                <div class="form__group--email">
                    <div class="form__group-title">
                        <span class="form__label--item">メールアドレス</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <div class="form__input-email">
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="test@example.com" />
                                <div class="form__error">
                                @error('email')
                                {{ $message }}
                                @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--電話-->
                <div class="form__group--tel">
                    <div class="form__group-title">
                        <span class="form__label--item">電話番号</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <div class="form__input-tel">
                                <input type="tel" name="tel1" placeholder="090" maxlength="4" value="{{ old('tel1') }}" />
                                <div class="form__error">
                                    @error('tel1')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <span>-</span>
                            <div class="form__input-tel">
                                <input type="tel" name="tel2" placeholder="1234" maxlength="4" value="{{ old('tel2') }}" />
                                <div class="form__error">
                                    @error('tel2')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <span>-</span>
                            <div class="form__input-tel">
                                <input type="tel" name="tel3" placeholder="5678" maxlength="4" value="{{ old('tel3') }}" />
                                <div class="form__error">
                                    @error('tel3')
                                    {{ $message }}
                                @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--住所-->
                <div class="form__group--address">
                    <div class="form__group-title">
                        <span class="form__label--item">住所</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <div class="form__input-address">
                                <input type="text" name="address" value="{{ old('address') }}" placeholder="例：東京都渋谷区千駄ケ谷１−２−３" />
                                <div class="form__error">
                                    @error('address')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--建物-->
                <div class="form__group--building">
                    <div class="form__group-title">
                        <span class="form__label--item">建物名</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                        <input type="text" name="building" value="{{ old('building') }}" placeholder="例：千駄ケ谷マンション１０１" />
                        </div>
                    </div>
                </div>
                <!--問い合わせ種類-->
                <div class="form__group--inquiry_type">
                    <div class="form__group-title">
                        <span class="form__label--item">お問い合わせの種類</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--select">
                            <select name="category_id" id="category_id">
                                <option value="" disabled {{ old('category_id') == '' ? 'selected' : '' }}>選択してください</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->content }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="form__error">
                                @error('category_id')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                    <!--内容-->
                <div class="form__group--inquiry_type">
                    <div class="form__group-title">
                        <span class="form__label--item">お問い合わせ内容</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-title">
                        <div class="form__input--textarea">
                            <textarea name="detail" placeholder="お問合せ内容をご記載ください">{{ old('detail') }}</textarea>
                            <div class="form__error">
                                @error('detail')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form__button">
                    <button class="form__button-submit" type="submit">確認画面</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>