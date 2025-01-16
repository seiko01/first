<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>thank you</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
</head>

<body>
  <header class="thanks-page">
    <div class="thanks-background">Thank you</div>
    <div class="thanks-content">
      <h1>お問い合わせありがとうございました</h1>
      <a href="/" class="home-button">HOME</a>
    </div>
  </header>
</body>

</html>