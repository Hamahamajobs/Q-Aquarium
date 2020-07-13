<!--todo thanks画面を作成する-->

@extends('layouts.template')

@section('addMeta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title')
    プロフィール画面thanks送信＠アクアリウム専門質問サイトのQ&Aquarium
@endsection

@section('css')
    <link rel="stylesheet" href="css/answer/postAnswerPage.css">
    <link rel="stylesheet" href="css/user_info/profile.css">
@endsection

@section('js')
    <script type="text/javascript"src="{{ asset('js/profile.js') }}"></script>
@endsection

<!--メインコンテンツ -->
@section('containerPerPage')
    <div class="question">
        
        <p class="user_name">ニックネーム : {{$name}}</p>
        <p class="title">タイトル　　 {{$title}}</p>
        <p class="category_wrap">カテゴリー　{{$category}}</p>
        <p class="question_content">質問内容<br>{{$question}}</p>
        
        @if($question_pic1 ?? '' != '')
            <p class="title"{{--class名,借りてます--}}>画像</p>
            <img src="{{$question_pic1 ?? ''}}" alt="test" width="400" height="230" style="margin: 0 5% 5% 5%;">
        @endif
    </div>
    <hr>


    @foreach ($answers as $answer)
        {{--thanksメッセージのみを表示--}}
        <p class="answerCounter{{--クラス名レンタル--}}">{{$name}}さんからのThanksメッセージ</p>
        <div class="thanksContainer">
            <div class="newThanksMessege">{{$answer->thanks}}</div>
        </div>

        <div class="pastAnswerListContainer">

            <p class="answerCounter">{{$answer->name}}様が投稿した回答</p>

            <div class="answerContents">
                <input id="answerId" type="hidden" value="{{$answer->id}}">{{--thanksメッセージ送信のための回答識別id--}}
                <div class="newPastAnswerContents">{{$answer->answer}}</div>

                @if($answer->answer_pic1 ?? '' != '')
                    <p class="picture1">画像</p>
                    <img src="{{$answer->answer_pic1 ?? ''}}" alt="test" width="400" height="230" style="margin-left:3%;">
                @endif
            </div>
            <br><br><br><br>

            <div class="modal js-modal">
                <div class="modal__bg js-modal-close"></div>
                <div class="modal__content">
                    <p>{{$answer->name}}さんにthanksを送りました</p>
                </div>
            </div>
        </div>
     @endforeach
@endsection