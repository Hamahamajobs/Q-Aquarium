{{--ファイル説明：プロフィール画面からAjaxで表示された質問を押下したあと、詳しく表示するためのファイル。カテゴリーごとに表示させたい内容が異なる。--}}

@extends('layouts.template')

@section('addMeta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title')
    質問確認画面＠アクアリウム専門質問サイトのQ&Aquarium
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
    {{--広告挿入--}}
    <div class="bannerAdvertisingLinkInPC">
            <script type="text/javascript">var a8='a19111714348_35SAUP_4HXXBM_2HOM_BUB81';var rankParam='.7MUdQY-jcJAgIOdjnJq5VJvfcJv2PY_d72Pd5JbAuN.LuF.j';var bannerType='1';var bannerKind='item.variable.kind2';var vertical='1';var horizontal='4';var alignment='0';var frame='1';var ranking='1';var category='ペット・ペットグッズ';</script><script type="text/javascript" src="//rws.a8.net/rakuten/ranking.js"></script>
    </div>
    <div class="bannerAdvertisingLinkInTablet">
        <script type="text/javascript">var a8='a19111714348_35SAUP_4HXXBM_2HOM_BUB81';var rankParam='u2saieE4.YGPo7ki.dGUBmG-MYG-F1EHi2F1iBGQPV6urVCu.';var bannerType='1';var bannerKind='item.variable.kind1';var vertical='1';var horizontal='2';var alignment='0';var frame='1';var ranking='1';var category='ペット・ペットグッズ';</script><script type="text/javascript" src="//rws.a8.net/rakuten/ranking.js"></script>
    </div>
    <div class="bannerAdvertisingLinkInSmartPhone">
            <script type="text/javascript">var a8='a19111714348_35SAUP_4HXXBM_2HOM_BUB81';var rankParam='CcL.m7dWFn1zTywmFV1j4D19Kn19Y3dQmcY3m41Iz0GCq0ECF';var bannerType='1';var bannerKind='item.variable.kind1';var vertical='1';var horizontal='1';var alignment='0';var frame='1';var ranking='1';var category='ペット・ペットグッズ';</script><script type="text/javascript" src="//rws.a8.net/rakuten/ranking.js"></script>
    </div>

    @if ($answers->isEmpty())
        <div class="thereIsNoAnswers">現在回答はありません。</div>    
    @else
        <!--あとでクラス名の修正など必要-->
        <h3 class="pastAnswerList">回答一覧</h3>
        <div class="pastAnswerListContainer">
            @foreach ($answers as $answer)
            {{--見た目が崩れたので保留に。
                @if ($loop->iteration == 3)
                    //広告挿入
                    <div class="bannerAdvertisingLink" style="margin-top:10%;">
                            <script type="text/javascript">var a8='a19111714348_35SAUP_4HXXBM_2HOM_BUB81';var rankParam='.7MUdQY-jcJAgIOdjnJq5VJvfcJv2PY_d72Pd5JbAuN.LuF.j';var bannerType='1';var bannerKind='item.variable.kind2';var vertical='1';var horizontal='4';var alignment='0';var frame='1';var ranking='1';var category='ペット・ペットグッズ';</script><script type="text/javascript" src="//rws.a8.net/rakuten/ranking.js"></script>
                    </div>
                @endif
            --}}
                <p class="answerCounter">{{$loop->iteration}}個目の回答</p>
                <div class="answerContents">
                    <input id="answerId" type="hidden" value="{{$answer->id}}">{{--thanksメッセージ送信のための回答識別id--}}
                    <div class="pastAnswerman">回答者：{{$answer->name}}</div>
                    <div class="pastAnswerContents">回答：{{$answer->answer}}</div>
                    @if($answer->answer_pic1 ?? '' != '')
                    <p class="picture1">画像</p>
                    <img src="{{$answer->answer_pic1 ?? ''}}" alt="test" class="questionPicture">
                    @endif
                    @if ($answer->thanks ?? '' != null)
                        <div class="thanksMessege">{{$answer->name}}さんへのThanksメッセージ：{{$answer->thanks}}</div>
                {{--↓インデントは意図的：thanksがある場合は”回答の線枠内”に表示させたいため--}}
                    @endif
                </div>

                
                @if(!isset($answer->thanks)){{--thanksがないとき--}}
                    @if ($answer->name == 'ゲスト'){{--ゲストからの回答の時はthanksが送れない--}}
                    <div class="thanksForm">
                        <div class="thanks_detail">
                            <p class="thanksFormTitle">回答者がゲストの場合は、thanksを送信できません。</p> 
                        </div>
                    </div>
                    @else
                        <div class="thanksForm">
                            <div class="thanks_detail">
                                <p class="thanksFormTitle">Thanks内容：<span id="moji_suu{{$answer->id}}">0</span>字/400字</p> 
                                <textarea limit="400" class="thanksFormTextarea" id="thanksForm{{$answer->id}}" name="{{$answer->id}}" rows="5" placeholder="400字以内（ここにthanksメッセージを記述してください。)"></textarea>
                            </div>
                        </div>

                        <div class="postThanks" id="postThanks" name="{{$answer->id}}">Thanks投稿</div>
                        
                    @endif
                    <br><br>{{--スペース調整：各回答だと認識しやすいように--}}
                @endif
                <div class="modal js-modal">
                    <div class="modal__bg js-modal-close"></div>
                    <div class="modal__content">
                        <p>{{$answer->name}}さんにthanksを送りました</p>
                    </div>
                </div>

            @endforeach
        </div>
    @endif



@endsection