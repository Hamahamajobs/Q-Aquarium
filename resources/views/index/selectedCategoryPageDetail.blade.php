<!--これは要はimportですよ。extendsは!-->
@extends('layouts.template')

@section('addMeta')
<meta name="description" content="カテゴリー別詳細ページ。アクアリウムや熱帯魚専門の質問サイトQ&Aquariumのカテゴリー別詳細ページ。アクアリウムに特化しており、カテゴリー別の質問が可能。アクアリストの知識を共有しよう！"/> 
@endsection

@section('title')
    カテゴリー別詳細ページ＠アクアリウム専門質問サイトのQ&Aquarium
@endsection

@section('css')
    <link rel="stylesheet" href="css/index/top_page.css">
    <link rel="stylesheet" href="css/answer/answer.css">
@endsection


<!--メインコンテンツ -->
@section('containerPerPage')
    
    <div class="showCategoryAllQuestionInOnePage"id="sample">
        @foreach ($questionItems as $questionItem)
        <div class="allQuestionContents">
            <a href="display_question_chosen?code={{$questionItem->id}}" >
                <div class="questionContents">
                    タイトル ： {{$questionItem->title}}<br>
                    カテゴリー: {{$questionItem->category}}
                </div>
            </a>
        </div>
        
        @endforeach
        <!--ページネーション：appends(['sort' => 'votes'])で各リンクにクエリパラメータを追記できる！便利！
        ControllerとViewの間で”Valueがループしてます。”-->
        <div class="linkToNexrPage">{{$questionItems->appends(['value' => $value])->links()}}</div><br>
    </div>
@endsection



