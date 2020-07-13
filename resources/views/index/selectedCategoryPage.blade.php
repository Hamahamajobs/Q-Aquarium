<!--これは要はimportですよ。extendsは!-->
@extends('layouts.template')

@section('addMeta')
<meta name="description" content="カテゴリー別ページ。アクアリウムや熱帯魚専門の質問サイトQ&Aquariumのカテゴリー別ページ。アクアリウムに特化しており、カテゴリー別の質問が可能。アクアリストの知識を共有しよう！"/> 
@endsection

@section('title')
    カテゴリー別ページ＠アクアリウム専門質問サイトのQ&Aquarium
@endsection

<!--メインコンテンツ -->
@section('containerPerPage')
<!--
Ajaxで読みこまれて、<div id="sample">内のデータが送られる。
-->
<div id="sample">
    @foreach ($questionItems as $questionItem)
    <div class="allQuestionContents">
        <a href="display_question_chosen?code={{$questionItem->id}}" >
        <div class="questionContents">
            <span class="textOverflow">タイトル ： {{$questionItem->title}}</span><br> 
            <span class="textOverflow">カテゴリー：{{$questionItem->category}}</span><br> 
        </div>
        </a>
    </div>
    @endforeach
    
    @switch($value ?? '')
        @case("最新")
        <a href="selectedCategoryPageDetail?value=Latest" class="categoryDetail">もっと詳しく</a>
            @break        
        @case("水草")
        <a href="selectedCategoryPageDetail?value=Plant" class="categoryDetail">もっと詳しく</a>
            @break
        @case("病気")
        <a href="selectedCategoryPageDetail?value=Sick" class="categoryDetail">もっと詳しく</a>
            @break
        @case("エサ")
        <a href="selectedCategoryPageDetail?value=Feed" class="categoryDetail">もっと詳しく</a>
            @break
        @case("緊急")
        <a href="selectedCategoryPageDetail?value=Emergency" class="categoryDetail">もっと詳しく</a>
            @break
        @default
        <a href="selectedCategoryPageDetail?value=Start" class="categoryDetail">もっと詳しく</a>
            @break
    @endswitch

</div>

@endsection
