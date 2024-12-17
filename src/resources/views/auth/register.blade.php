@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">

@endsection
@section('iwao')
<div class="header-login-link">
<a href="/login">login</a>
</div>
@endsection

@section('content')
<div class="register-background">
    <h2>Register</h2>
</div>
    <div class="register-container">
        <form class="form" action="/register" method="post">
        @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お名前</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="例: 山田  太郎" class="form__input">
                </div>
                <div class="form__error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">メールアドレス</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="例: coachtech@ggmail.com" class="form__input">
                </div>
                <div class="form__error">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">パスワード</span>
            </div>
            <div class="form__group-content">
            <div class="form__input--text">
                <input type="password" name="password" value="{{ old('password') }}" placeholder="例: coachtech1106" class="form__input">
            </div>
            <div class="form__error">
                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
<div class="form__button">
    <button class="form__button-submit" type="submit">登録</button>
</div>
</form>
</div>
@endsection
