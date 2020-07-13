<!--これは要はimportですよ。extendsは!-->
@extends('layouts.template')

@section('title')
    はるまきにコンタクト
@endsection

@section('css')

@endsection

@section('js')
    <script type="text/javascript"src="{{ asset('js/jquery.textillate.js') }}"></script>

@endsection


<!--メインコンテンツ -->
@section('containerPerPage')
    <h3>はるまきにコンタクト</h3>
@endsection

<!--フッターの上 -->
@section('topOfFooter')

@endsection


