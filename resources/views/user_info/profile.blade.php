<!--これは要はimportですよ。extendsは!-->
@extends('layouts.template')


@section('addMeta')
<meta name="description" content="プロフィール画面。アクアリウムや熱帯魚専門の質問サイトQ&Aquariumのプロフィール画面はこちら。アクアリウムに特化しており、カテゴリー別の質問が可能。アクアリストの知識を共有しよう！"/> 
@endsection

@section('title')
    プロフィール画面＠アクアリウム専門質問サイトのQ&Aquarium 
@endsection

@section('css')
<link rel="stylesheet" href="css/user_info/profile.css">
@endsection

@section('js')
    <script type="text/javascript"src="{{ asset('js/profile.js') }}"></script>
@endsection

<!--メインコンテンツ -->
@section('containerPerPage')

    <!--未確認の回答と今までの回答を表示させる-->
    <div class="question_category_parent">
        <br>
        <button id="allPastQuestions"   class="categoryButton">過去の質問</button>{{--そのユーザーが投稿した質問一覧--}}
        <button id="allPastAnswers"     class="categoryButton">過去の回答</button>{{--そのユーザーが回答した質問一覧--}}
        <button id="unconfirmedAnswers" class="categoryButton">新着回答</button>{{--そのユーザーの質問への新着回答--}}
        <button id="unconfirmedThanks"  class="categoryButton">Thanks</button>{{--そのユーザーへのThanks--}}
    </div>

    <!--読み込んだ質問や回答を表示させる-->
    <div class="selected_category_question">
        <div class="selected_category_detail"></div>
    </div>
@endsection
