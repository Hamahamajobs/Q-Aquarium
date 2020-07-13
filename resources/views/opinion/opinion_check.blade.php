<!--これは要はimportですよ。extendsは!-->

<!--あとまわし　こりゃもう死んでます。仕組みがそもそも古すぎるのでyield対応の価値なし-->
@extends('layouts.template')

@section('title')
    意見をチェックします
@endsection

@section('css')
<link rel="stylesheet" href="opinion_check.css">
@endsection

<!--メインコンテンツ -->
@section('containerPerPage')
<div class="kari">
        <h2>確認ページです。</h2>
        <?php 
        $nickname = $_POST['nickname'];
        $email = $_POST['email'];
        $content = $_POST['content'];

        //これで無毒化している。無毒化する関数htmlspecialcharsに値を投げて返り値（無毒な値）を再度入れている。
        $nickname = htmlspecialchars($nickname);
        $email    = htmlspecialchars($email);
        $content  = htmlspecialchars($content);

        if($nickname==''){
            print'未入力です';
            print'<br>';
        }
        else{
            print'thank you for your inviting';
            print'<br>';
            print $nickname;
            print'様';
            print'<br>';
        }

        if($email == ''){
            print '未入力です';
            print'<br>';
        }
        else{
            print $email;
            print'<br>';
        }

        if($content == ''){
            print '未入力です';
            print'<br>';
        }
        else{
            print $content;
            print'<br>';
        }
        if($email==''||$nickname==''||$content==''){
            print'<form>';
            print'<input type="button" onclick="history.back()" value="戻る">';
            print'</form>';
        }
        else{//ここで入力された値を次のthanks.phpに投げている。
            print '<form method="post" action="thanks.php">';
            print '<input type="hidden" name="nickname" value="'.$nickname.'">';
            print '<input type="hidden" name="email" value="'.$email.'">';
            print '<input type="hidden" name="content" value="'.$content.'">';
            print '<input type="button" onclick="history.back()" value="戻る">';
            print '<input type="submit" value="OK">';
            print '</form>';
        }
        ?>
    </div>
@endsection

