<!--これは要はimportですよ。extendsは!-->
@extends('layouts.template')

@section('addMeta')
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="description" content="質問投稿。アクアリウムや熱帯魚専門の質問サイトQ&Aquariumへの質問投稿。アクアリウムに特化しており、カテゴリー別の質問が可能。アクアリストの知識を共有しよう！"/> 
@endsection

@section('title')
    質問への回答＠アクアリウム専門質問サイトのQ&Aquarium
@endsection

@section('css')
    <link rel="stylesheet" href="css/question/question.css">
@endsection

@section('js')
<script type="text/javascript"src="{{ asset('js/postQuestion.js') }}"></script>
@endsection


<!--メインコンテンツ -->
@section('containerPerPage')
    <div class="display_form">
        質問フォーム
    </div>

    <input id="userName"type="hidden" name="name" value="{{session()->get('name')}}">
    <div class="user_name">
        ニックネーム　{{session()->get('name','ゲスト')}}様
    </div>

    
    <div class="category_wrap">
        <label>カテゴリー</label>
        <select name="category" id="selectedCategory">
            <option value="">カテゴリーを選択してください</option>
            <option value="緊急">緊急</option>
            <option value="設備">設備</option>
            <option value="水草">水草</option>
            <option value="病気">病気</option>
            <option value="立ち上げ">立ち上げ</option>
            <option value="流木"">流木</option>
            <option value="生体">生体</option>
            <option value="エサ"">エサ</option>
            <option value="レイアウト">レイアウト</option>
            <option value="その他">その他</option>
        </select>
    </div>
    
    <div class="title">
        <label>タイトル</label>
        <input type="text" name="title" id="questionTitleForm"placeholder="50文字以内　例)コリドラス飼育のコツはなんですか？" value="">
    </div>
    
    <div class="quiestion_detail">
        <p>質問内容 <span id="moji_suu">0</span>字/400字</p> 
        <textarea limit="400" id="questionContents" name="question" rows="5" placeholder="400字以内　(例)コリドラスの元気がありません。エビに突き回されています。解決策はなんでしょうか？"></textarea>
            
        
        <div id="file_upload_section">
            <label>画像添付(任意)</label>
            <div id="drop" style="width:40%; height:100px; padding:10px; border: dashed 2px #5b8bd0; margin-left:3%;" ondragover="onDragOver(event)" ondrop="onDrop(event)">
                ここに画像をドラッグアンドドロップして下さい
            </div>
        </div>
        <img id="img1"/>
    </div>

    <div id="postQuestion">投稿</div>

    {{--スマホの時は質問投稿画面にも広告を表示させる。--}}
    <div class="bannerAdvertisingLinkInSmartPhone">
            <script type="text/javascript">var a8='a19111714348_35SAUP_4HXXBM_2HOM_BUB81';var rankParam='CcL.m7dWFn1zTywmFV1j4D19Kn19Y3dQmcY3m41Iz0GCq0ECF';var bannerType='1';var bannerKind='item.variable.kind1';var vertical='1';var horizontal='1';var alignment='0';var frame='1';var ranking='1';var category='ペット・ペットグッズ';</script><script type="text/javascript" src="//rws.a8.net/rakuten/ranking.js"></script>
        </div>

    <!--ポップアップ画面-->
    <div class="modal js-modal">
        <div class="modal__bg js-modal-close"></div>
        <div class="modal__content">
            <p>投稿しました！</p>
        </div>
    </div>
@endsection