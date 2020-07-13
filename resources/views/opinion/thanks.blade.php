<!DOCTYPE html>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Q&Aquarium</title>
        <link rel="stylesheet" href="css/question/question.css">
        <link rel="stylesheet" href="css/template/hina.css">
        
    </head>
    <body>
        <header>
            <div class="header-left"><a href="top">Q&Aquarium</a>
                ようこそ,{{session()->get('name','ゲスト')}}様
            </div>
            <div class="header-right">
                <a href="question">質問する</a>
                <a href="answer">回答する</a>
                <a href="profile">プロフィール</a>
                <a href="loginReal">ログイン</a>
            </div>
        </header>

        <div class="container">
            <br><br><br><br>
            <h3>以下の内容でご意見を受け付けました。</h3>
            <div class="email">メール： {{$email}}</div>
            <div class="opinion">ご意見： {{$opinionMessege}}</div>
            <br><br>
            <h3>{{$userName}}様、貴重なご意見ありがとうございました。</h3>
            <h3>{{$email}}にメールをお送りいたしました。２〜３営業日でご返信致します。</h3>
            <h3>今後とも宜しくお願い致します。</h3>

            <a href="top"><h3>タイトルへ戻る</h3></a>
        </div>

        <div class="footer">
            <footer>
                <div class="footer_list">
                <a href="">　問合せ　</a>
                <a href="">管理者情報</a>
                <a href="opinion.php">　意見箱　</a>
                </div>
            </footer>
        </div>
    </body>
</html>