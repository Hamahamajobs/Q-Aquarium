
//画像の関連データを格納。
var questionPic;

function showPopUp(){
	$('.js-modal').fadeIn();
}

//投稿完了後に表示するポップアップ画面を非表示にすると、TOP画面へ遷移する。
$(function(){
    $('.js-modal-close').on('click',function(){
        window.location.href = 'top';
    });
})

//カウント
$(function(){
    //カウントするフィールドを監視
    $("#answerForm").keydown(function(){
        //現在入力されている文字
        var text = $(this).val();
        //正確にカウントするため改行コード削除
        text = text.replace((new RegExp("\r\n","g")),"");
        text = text.replace((new RegExp("\n","g")),"");
        //現在の文字数
        var count = text.length;

        //設定した上限文字数
        var moji_limit = $(this).attr("limit");
 
        //文字数をリアルタイムの表示
        $("#moji_suu").text(count);
 
        //処理分け
        if(count == 0){
            //字を消して0文字となった場合。
            $("#moji_suu").text("0");
        } else if(count > moji_limit) {
            //上限文字数を超えたら赤色表示
            $("#moji_suu").css("color", "red");
        } else {
            //文字数が範囲内なら色を戻す
            $("#moji_suu").css("color", "");
        }
    });
});


// ブラウザ上でファイルを展開する挙動を抑止
//ドラックエリアにホバーしたら実行
function onDragOver(event) {
    event.preventDefault();
}

// Drop領域にドロップしたファイル情報を読み取り
function onDrop(event) {
    // ブラウザ上でファイルを展開する挙動を抑止
    event.preventDefault();

    // ドロップされたファイルのfilesプロパティを参照
    var files = event.dataTransfer.files;
    if (files.length >= 1) {
        //alert(files[0].name + ":" + files[0].size); ファイル名とサイズの確認
        questionPic = files[0];

       //ドロップした画像を表示
       const reader = new FileReader();
       reader.onload = function (event) {
           //画像の大きさ調節は以下とする
           document.getElementById('img1').style.minWidth  = "40%";
           document.getElementById('img1').style.minHeight = "300px";
           document.getElementById('img1').style.maxWidth  = "95%";
           document.getElementById('img1').style.maxHeight = "500px";
           document.getElementById('img1').src = event.target.result;
       }
       reader.readAsDataURL(event.dataTransfer.files[0]);
    }
}

// ファイルアップロード
function FileUpload(f) {

    //formDataとしてコントローラーに渡すために格納する。:append("hoge",goge) formDataにはファイル関連のインスタンス群が格納されるらしい
    var formData = new FormData();
    formData.append('file', f);

    var answer         = $("#answerForm").val();
    var questionCode   = $("#question_code").val();
    var AnswerName     = $("#AnswerName").val();
    var questionerName = $("#questionerName").val();

    //入力値を判定
    if(answer.length<10 ){
        alert("１０文字以上で回答してください。")
    }
    else{
        //formDataとして送る、且つPOST送信の時に、文字化けを起こしてしまう。これを防ぐために文字列をエンコード（文字コード変換的な）をする。これをコントローラー側でデコード（元の文字コードに直すこと(70%)）を行うことで、文字列の受け渡しを実現する。
        answer = encodeURIComponent(answer);
        questionCode = encodeURIComponent(questionCode);
        AnswerName = encodeURIComponent(AnswerName);
        questionerName = encodeURIComponent(questionerName);

        //渡したい文字列をformDataに格納する。
        formData.append('answer',answer);
        formData.append('questionCode',questionCode);
        formData.append('AnswerName',AnswerName);
        formData.append('questionerName',questionerName);

        $.ajax({
            type: 'POST',
            dataType : "text",
            contentType: false,//ファイル(画像)を処理する時、contentTypeはfalse
            processData: false,//ファイル(画像)を処理する時、processaDataはfalse
            url: 'postAnswer',//todo 作業が落ち着き次第、postQuestionにする。
            data: formData,//formDataは上記の処理にもあるように、渡したい画像データや文字列が格納されている。
            headers: {
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        }).done(function(json) {
            //alert(json);
            showPopUp();
        }).fail(function(jqXHR, textStatus, errorThrown) {
            alert("エラーが発生しました。再度ページを読み込んでください。それでも解決しない場合はサーバーダウンが考えられますので、復旧までしばらくお待ちください。")
            window.location.href = 'top';
        });
    }
}

//送信ボタンを押下した時の処理
$(function(){
    $('#postAnswer,#postAnswerAsGuest').click(function dojQueryAjax() { 
        //引数に画像データを入れて送信
        FileUpload(questionPic);
    });

    $("#moveToResistration").click(function(){
        window.location.href = 'registration';
    });
})