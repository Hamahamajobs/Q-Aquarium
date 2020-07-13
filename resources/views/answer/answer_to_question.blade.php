<!--これは要はimportですよ。extendsは!-->
@extends('layouts.template')

@section('addMeta')
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="description" content="アクアリウムや熱帯魚専門の質問サイトQ&Aquariumでの回答画面はこちら。アクアリウムに特化しており、カテゴリー別の質問が可能。アクアリストの知識を共有しよう！"/> 
@endsection

@section('title')
    質問への回答＠アクアリウム専門質問サイトのQ&Aquarium
@endsection

@section('css')
    <link rel="stylesheet" href="css/answer/postAnswerPage.css">
@endsection

@section('js')
    <script type="text/javascript"src="{{ asset('js/postAnswer.js') }}"></script>
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
        <img src="{{$question_pic1 ?? ''}}" alt="添付された画像です" class="questionPicture">
        {{--記録 <img src="{{ asset('storage/zmXU28nqC0UPKOC4IzGsEx2gnAq7HfKJamLIyz7O.png') }}" alt="test" width="400" height="230" style="margin: 0 5% 5% 5%;">--}}
        @endif
        
    </div>

    <div class="answerForm">
        <div class="answer_detail">
            <p>回答内容<span id="moji_suu">0</span>字/400字</p> 
            <textarea limit="400" id="answerForm" name="answer" rows="5" placeholder="400字以内（ここに回答を記述してください。）"></textarea>
            <input id="question_code" type="hidden" name="code" value="{{$code}}">   
            <input id="AnswerName" type="hidden" name="AnswerName" value="{{session()->get('name','ゲスト')}}""> 
            <input id="questionerName" type="hidden" name="questionerName" value="{{$name}}">
        </div>

        <div id="file_upload_section">
            <label>画像添付(任意)</label>
            <div id="drop" style="width:40%; height:100px; padding:10px; border: dashed 2px #5b8bd0; margin-left:3%;" ondragover="onDragOver(event)" ondrop="onDrop(event)">
                ここに画像をドラッグアンドドロップして下さい
            </div>
            <img id="img1"/>
        </div>
    </div>
    @if (session()->get('name') == 'ゲスト' || session()->get('name') == '')
    <div id="postAnswerAsGuest">回答(ゲスト)</div><div id="moveToResistration">新規登録へ</div>        
    @else
    <div id="postAnswer">回答投稿</div>       
    @endif

    <hr>
{{--回答が0件の時--}}

    {{--広告挿入--}}
    <div class="bannerAdvertisingLinkInPc">
            <script type="text/javascript">var a8='a19111714348_35SAUP_4HXXBM_2HOM_BUB81';var rankParam='.7MUdQY-jcJAgIOdjnJq5VJvfcJv2PY_d72Pd5JbAuN.LuF.j';var bannerType='1';var bannerKind='item.variable.kind2';var vertical='1';var horizontal='4';var alignment='0';var frame='1';var ranking='1';var category='ペット・ペットグッズ';</script><script type="text/javascript" src="//rws.a8.net/rakuten/ranking.js"></script>
    </div>
    <div class="bannerAdvertisingLinkInTablet">
        <script type="text/javascript">var a8='a19111714348_35SAUP_4HXXBM_2HOM_BUB81';var rankParam='u2saieE4.YGPo7ki.dGUBmG-MYG-F1EHi2F1iBGQPV6urVCu.';var bannerType='1';var bannerKind='item.variable.kind1';var vertical='1';var horizontal='2';var alignment='0';var frame='1';var ranking='1';var category='ペット・ペットグッズ';</script><script type="text/javascript" src="//rws.a8.net/rakuten/ranking.js"></script>
    </div>
    <div class="bannerAdvertisingLinkInSmartPhone">
        <script type="text/javascript">var a8='a19111714348_35SAUP_4HXXBM_2HOM_BUB81';var rankParam='CcL.m7dWFn1zTywmFV1j4D19Kn19Y3dQmcY3m41Iz0GCq0ECF';var bannerType='1';var bannerKind='item.variable.kind1';var vertical='1';var horizontal='1';var alignment='0';var frame='1';var ranking='1';var category='ペット・ペットグッズ';</script><script type="text/javascript" src="//rws.a8.net/rakuten/ranking.js"></script>
    </div>



    @if ($answers->isEmpty())
        <div class="thereIsNoAnswers">現在回答はありません。回答募集中！</div>
    @else
        <p class="pastAnswerList">今までの回答</p>
        <div class="pastAnswerListContainer">
            @foreach ($answers as $answer)
                <p class="answerCounter">{{$loop->iteration}}個目の回答</p>
                <div class="answerContents">
                    <div class="pastAnswerman">回答者：{{$answer->name}}</div>
                    <div class="pastAnswerContents">回答：{{$answer->answer}}</div>
                    @if($answer->answer_pic1 ?? '' != '')
                    <p class="picture1"{{--class名,借りてます--}}>画像</p>
                    <img src="{{$answer->answer_pic1 ?? ''}}" alt="test" class="questionPicture">
                    @endif
                </div>
            @endforeach
        </div>  
    @endif
    {{--スマホでの広告は二つ出そう！--}}
    <div class="bannerAdvertisingLinkInSmartPhone">
        <script type="text/javascript">var a8='a19111714348_35SAUP_4HXXBM_2HOM_BUB81';var rankParam='CcL.m7dWFn1zTywmFV1j4D19Kn19Y3dQmcY3m41Iz0GCq0ECF';var bannerType='1';var bannerKind='item.variable.kind1';var vertical='1';var horizontal='1';var alignment='0';var frame='1';var ranking='1';var category='ペット・ペットグッズ';</script><script type="text/javascript" src="//rws.a8.net/rakuten/ranking.js"></script>
    </div>

    <div class="modal js-modal">
        <div class="modal__bg js-modal-close"></div>
        <div class="modal__content">
            <p>回答を投稿しました。ありがとうございました。</p>
        </div>
    </div>

@endsection