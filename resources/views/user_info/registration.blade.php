<!--これは要はimportですよ。extendsは!-->
@extends('layouts.template')

@section('addMeta')
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="description" content="新規登録画面。アクアリウムや熱帯魚専門の質問サイトQ&Aquariumへの新規登録こちら。アクアリウムに特化しており、カテゴリー別の質問が可能。アクアリストの知識を共有しよう！"/> 
@endsection

@section('title')
    新規登録＠アクアリウム専門質問サイトのQ&Aquarium
@endsection

@section('css')
<link rel="stylesheet" href="css/user_info/registration.css">
@endsection

@section('js')
    <script type="text/javascript"src="{{ asset('js/registration.js') }}"></script>
@endsection


<!--メインコンテンツ -->
@section('containerPerPage')
<div id="form-main">
      <div id="form-div">

        <div class="form" id="form1">
  
        <p class="user_id">
          <div class="registrationFormWrapper">
            <img src="picture/id.png" alt="" id="" class="registrationImages">             
            <input name="userId" type="text" class="feedback-input" id="user_id" placeholder="id" />
          </div>
        </p>

        <p class="name">
            <div class="registrationFormWrapper">
              <img src="picture/human.png" alt="" id="" class="registrationImages">
              <input name="name" type="text" class="feedback-input" placeholder="ニックネーム" id="name" />
            </div>
        </p>
        <p class="password">
            <div class="registrationFormWrapper">
              <img src="picture/password.png" alt="" id="" class="registrationImages">
              <input name="password" type="password" class="feedback-input" id="password" placeholder="パスワード" />
            </div>
        </p>

        <p class="password">
            <div class="registrationFormWrapper">
              <img src="picture/password.png" alt="" id="" class="registrationImages">
              <input name="password2" type="password" class="feedback-input" id="password2" placeholder="再確認パスワード" />
            </div>
        </p>
        <!--自己紹介はあとで設定できるので、とりあえず保留-->
        <input name="introduction" type="hidden" value="" id="" cols="30" rows="10">
        
        <div class="submit">
          <input type="submit" value="登録する" id="button-blue"/>
          <div class="ease"></div>
        </div>
      </div>

      </div>

      <div class="modal js-modal">
          <div class="modal__bg js-modal-close"></div>
          <div class="modal__content">
              <p>登録ありがとうございます！</p>
              <a class="js-modal-close" href="question"><span id="registrationSendQuestionBtn">質問する</span></a>
          </div>
      </div>

</div>

@endsection
