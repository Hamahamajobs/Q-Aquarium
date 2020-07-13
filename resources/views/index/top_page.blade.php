<!--これは要はimportですよ。extendsは!-->
@extends('layouts.template')

@section('addMeta')
<meta name="description" content="トップページ：アクアリウムや熱帯魚専門の質問サイトQ&Aquariumのトップページ。アクアリウムに特化しており、カテゴリー別の質問が可能。アクアリストの知識を共有しよう！"/> 
@endsection

@section('title')
    トップページ＠アクアリウム専門質問サイトのQ&Aquarum
@endsection

@section('css')
    <link rel="stylesheet" href="css/answer/answer.css">
    <link rel="stylesheet" href="css/index/top_page.css">
@endsection

@section('js')
    <script type="text/javascript"src="{{ asset('js/jquery.textillate.js') }}"></script>
    <script type="text/javascript"src="{{ asset('js/jquery.lettering.js') }}"></script>
    <script type="text/javascript"src="{{ asset('js/topPage.js') }}"></script>
    <script type="text/javascript"src="{{ asset('js/question_per_category.js') }}"></script>
@endsection

@section('topOfpermanentMainArea')
    <div class="background-pic">
        {{-- <div class="topPageMessage"> --}}
        <div class="topPicWrapper">
            <img src="picture/Explain-pic7.png" alt="test" id="topPageImage">      
            <div id="topPagePicMesseges">
                <p>Question For Aquarium.</p>
                <p>Answer For Everyone.</p>
            </div>
        </div>

        {{-- </div> --}}
        <div class="bubbles">
                <div class="bubble"></div><div class="bubble"></div>
                <div class="bubble"></div><div class="bubble"></div>
                <div class="bubble"></div><div class="bubble"></div>
                <div class="bubble"></div><div class="bubble"></div>
                <div class="bubble"></div><div class="bubble"></div>
                <div class="bubble"></div><div class="bubble"></div>
        </div>
    </div>
@endsection

@section('containerPerPage')
    <div class="question_category_parent">
        <br>
        <button id="categoryLatest" class="categoryButton categoryActive">最新</button>
        <button id="categoryEmergency" class="categoryButton">緊急</button>
        <button id="categoryPlant" class="categoryButton">水草</button>
        <button id="categorySick" class="categoryButton">病気</button>
        <button id="categoryFeed" class="categoryButton">エサ</button>
        
    </div>
    <!--以下にAjax経由で質問内容が表示される。初めは”最新”が表示されている -->
    <div class="selected_category_question">
        <div class="selected_category_detail">
        </div>
    </div>
    
    {{-- 削除したらUIに影響が出るはずだったが、出なかった。なぜ？
        <br><br><br><br><br><br><br><br>
    --}}
@endsection



