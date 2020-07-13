<!--これは要はimportですよ。extendsは!-->
@extends('layouts.template')

@section('title')
    意見箱
@endsection

<!--メインコンテンツ -->
@section('containerPerPage')
    <div class="name">
        <h2>意見箱</h2>
        <form method="post" action="postsOpinion">
            {{csrf_field()}}
            <h3>ID</h3>
            <input type="text" name="aquaId" style="width:100px"><br>
            <h3>メールアドレス</h3>
            <input type="text"name="email" style="width:200px"><br>
            <h3>内容</h3>
            <input type="text" name="opinionMessege"><br>
            <h3>↓↓を押して送信してね</h3>
            <input type="submit" value="送信">
        </form>
    </div>
@endsection

