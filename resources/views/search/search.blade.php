<!--これは要はimportですよ。extendsは!-->
@extends('layouts.template')

@section('addMeta')
<meta name="description" content="検索。アクアリウムや熱帯魚専門の質問サイトQ&Aquariumでの検索こちら。アクアリウムに特化しており、カテゴリー別の質問が可能。アクアリストの知識を共有しよう！"/> 
@endsection

@section('title')
    質問への回答＠アクアリウム専門質問サイトのQ&Aquarium
@endsection

@section('css')
    <link rel="stylesheet" href="css/search/search.css">
@endsection

@section('js')
    <script type="text/javascript"src="{{ asset('js/search.js') }}"></script>
@endsection


<!--メインコンテンツ -->
@section('containerPerPage')
@if ($results->isEmpty())
    <div class="resultIsEmpty"><br>検索結果は０件です</div>
@else

    @foreach ($results as $result)
        <div class="allQuestionContents">
            <a href="display_question_chosen?code={{$result->id}}" >
                <div class="questionContents">
                    タイトル ： {{$result->title}}<br>
                    質問内容 ： {{$result->question}}<br> 
                    カテゴリー: {{$result->category}}
                </div>
            </a>
        </div>
    @endforeach
@endif
@endsection