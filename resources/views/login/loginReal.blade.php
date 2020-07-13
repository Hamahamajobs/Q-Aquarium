<!--これは要はimportですよ。extendsは!-->
@extends('layouts.template')

@section('addMeta')
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="description" content="アクアリウムや熱帯魚専門の質問サイトQ&Aquariumへのログインはこちら。アクアリウムに特化しており、カテゴリー別の質問が可能。アクアリストの知識を共有しよう！"/> 
@endsection

@section('title')
    ログイン(アクアリウム専門質問サイトのQ&Aquariumへのログイン)
@endsection

@section('css')
    <link rel="stylesheet" href="css/user_info/login.css">
@endsection

@section('js')
    <script type="text/javascript"src="{{ asset('js/loginChecker.js') }}"></script>
@endsection

<!--メインコンテンツ -->
@section('containerPerPage')
    <div class="login">
        <div class="login-triangle"></div>
        <h2 class="login-header">Log in</h2>
        <div class="login-container">
            <p><input id="id" type="text" name="id"placeholder="ID"></p>
            <p><input id="password" type="password" name="password" placeholder="パスワード"></p>
            <p><input id="submit" type="submit" value="ログイン"></p>
            <p><input id="btnSignUp"type="button" value="新規登録"></p>
        </div>
    </div>

    <div class="modal js-modal">
        <div class="modal__bg js-modal-close"></div>
        <div class="modal__content">
            <h3>ログインできませんでした。</h3>
            <h3>IDもしくはパスワードが間違っています</h3>
            <a class="js-modal-close" href="loginPage">もどる</a>
        </div>
    </div>
@endsection



