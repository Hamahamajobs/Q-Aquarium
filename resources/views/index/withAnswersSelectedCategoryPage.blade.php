<!--プロフィールでの各種読み込み情報をまとめてここに記載する-->
@extends('layouts.template')

<!--メインコンテンツ -->
@section('containerPerPage')
<div id="sample">

    {{--thanksメッセージがある時--}}
    @if(isset($thanksInfos))
        @if($emptyFlag == 2)
            <h3>新着Thanksは0件です</h3><br>
        @else
            @foreach ($thanksInfos as $thanksInfo)
                <div class="allQuestionContents">
                    <a href="thanksMessages?code={{$thanksInfo->question_id}}" >
                        @foreach ($questionItems as $questionItem)
                            @if($questionItem->id == $thanksInfo->question_id)
                                <span class="text_overflow">タイトル：{{$questionItem->title}}</span><br> 
                            @endif
                        @endforeach
                        <span class="text_overflow">Thanksメッセージ：{{$thanksInfo->thanks}}</span><br> 
                    </a>
                </div>         
            @endforeach
        @endif
    {{--thanks以外--}}
    @else
        @foreach ($questionItems as $questionItem)
            <div class="allQuestionContents">
                <!--プロフィール画面に合わせた機能にする-->
                <a href="questionsAsProfile?code={{$questionItem->id}}" >
                    <div class="questionContents">
                        <span class="text_overflow">タイトル ： {{$questionItem->title}}</span><br> 
                        <span class="">カテゴリー：{{$questionItem->category}}</span><br> 
                    </div>
                </a>
            </div>
        @endforeach
        {{--if文の中でも↓このように"??"を使うことができる --}}
        @if($emptyFlag ?? '' == 1)
            <h3>新着回答は0件です</h3>
        @endif

        @switch($value ?? '')
            @case("最新")
            <a href="selectedCategoryPageDetail?value=Latest" class="categoryDetail">もっと詳しく</a>
                @break        
            @case("立ち上げ")
            <a href="selectedCategoryPageDetail?value=Start" class="categoryDetail">もっと詳しく</a>
                @break
            @case("病気")
            <a href="selectedCategoryPageDetail?value=Sick" class="categoryDetail">もっと詳しく</a>
                @break
            @case("エサ")
            <a href="selectedCategoryPageDetail?value=Feed" class="categoryDetail">もっと詳しく</a>
                @break
            @case("生体")
            <a href="selectedCategoryPageDetail?value=With" class="categoryDetail">もっと詳しく</a>
                @break
            @case("過去の質問")
            <a href="selectedCategoryPageDetail?value=pastQuestion" class="categoryDetail">もっと詳しく</a>
                @break
            @case("過去の回答")
            <a href="selectedCategoryPageDetail?value=pastAnswer" class="categoryDetail">もっと詳しく</a>
                @break            
            @default
            　<!--未処理-->
                @break
        @endswitch

    @endif


</div>

@endsection
