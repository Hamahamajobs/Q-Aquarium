/**
 * 質問投稿をAjaxで行う。画面遷移をしなくても情報を投稿できるからである。
 *　Laravelのセキュリティ対策でhtml側に
 <meta name="csrf-token" content="{{ csrf_token() }}">
 がないときちんとPostを使うAjaxは機能しないので注意。
 */

var AnswerPic;//画像の関連データを格納する。異なる関数で共通で仕様したい為

//質問投稿完了後のポップアップ表示
function showPopUp(){
	$('.js-modal').fadeIn();
}

//文字数カウント　ポップアップを閉じる
$(function(){
    //投稿完了後に表示するポップアップ画面を非表示にすると、TOP画面へ遷移する。
    $('.js-modal-close').on('click',function(){
        //$('.js-modal').fadeOut();
        window.location.href = 'top';
        //return false;
    });


    /*文字数カウント */
    //カウントするフィールドを監視
    $("#questionContents").keydown(function(){
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
        AnswerPic = files[0];


       //ドロップした画像を表示
       const reader = new FileReader();
       reader.onload = function (event) {
           //画像の大きさ調節は以下とする
           document.getElementById('img1').style.minHeight = "300px";
           document.getElementById('img1').style.minWidth  = "40%";
           document.getElementById('img1').style.maxHeight = "500px";
           document.getElementById('img1').style.maxWidth  = "95%";
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

    var name             = $("#userName").val();
    var category         = $("#selectedCategory").val();
    var title            = $("#questionTitleForm").val();
    var questionContents = $("#questionContents").val();

    //入力値を判定
    if(category.length < 1 || title.length<2 || (questionContents.length<10 ||questionContents.length>400)){
        if(category.length < 1){
            alert("カテゴリーを選択してください。");    
        }
        else if(title.length < 2){
            alert("タイトルを２文字以上入力してください。");
        }
        else if(questionContents.length < 10){
            alert("質問内容の文字数が足りません。10文字以上入力してください。");
        }
        else if(questionContents.length > 400){
            alert("質問内容の文字数が400文字を超えています。");
        }
        else if(title.length<=50){
            alert("タイトルの文字数は50文字を超えています。");
        }
        else{
            alert("予想外のエラー：再度ページを読み込んで下さい。");
        }
    }
    else{
        //formDataとして送る、且つPOST送信の時に、文字化けを起こしてしまう。これを防ぐために文字列をエンコード（文字コード変換的な）をする。これをコントローラー側でデコード（元の文字コードに直すこと(70%)）を行うことで、文字列の受け渡しを実現する。
        name = encodeURIComponent(name);
        category = encodeURIComponent(category);
        title = encodeURIComponent(title);
        questionContents = encodeURIComponent(questionContents);

        //渡したい文字列をformDataに格納する。
        formData.append('name',name);
        formData.append('title',title);
        formData.append('category',category);
        formData.append('questionContents',questionContents);

        $.ajax({
            type: 'POST',
            dataType : "text",
            contentType: false,//ファイル(画像)を処理する時、contentTypeはfalse
            processData: false,//ファイル(画像)を処理する時、processaDataはfalse
            url: 'postQuestion',//todo 作業が落ち着き次第、postQuestionにする。
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
    $('#postQuestion').click(function dojQueryAjax() { 
        //引数に画像データを入れて送信
        FileUpload(AnswerPic);
    });
})




//戦歴　
/*
$(function(){
    /*
    var img;
    $('#my_form').change(function(e){
        //ファイルオブジェクトを取得する
        var img = e.target.files[0];
        var reader = new FileReader();

        //画像でない場合は処理終了
        if(file.type.indexOf("image") <0){
           alert("画像ファイルを指定してください");
           return false;
        };
    });


    $('#postQuestion').click(function dojQueryAjax() { 
        var name       = $("#userName").val();
        var category   = $("#selectedCategory").val();
        var  title     = $("#questionTitleForm").val();
        var questionContents = $("#questionContents").val();
        //var img = document.getElementById("img1");
        //var img = $("#img1").attr("src");
        //var file = $('input[type=file]').prop('files')[0];
        //var img = new FormData($('#my_form').get(0));
        //var img = new FormData($('#my_form').file[0];
        //var img = $('#my_form').files[0]; //
        
        //var questionPicture = $("#questionPic").val();
        //var img1 = $("#img1").val();　もしかしてこっちかも？



        /*

        if(img == null){
            alert("nullです")
            img = 0;
        }
        else{
            alert("入ってます");
            alert(img);
        }
        


        if(category.length < 1 || title.length<2 || (questionContents.length<10 ||questionContents.length>400)){
            if(category.length < 1){
                alert("カテゴリーを選択してください。");    
            }
            else if(title.length < 2){
                alert("タイトルを２文字以上入力してください。");
            }
            else if(questionContents.length < 10){
                alert("質問内容の文字数が足りません。10文字以上入力してください。");
            }
            else if(questionContents.length > 400){
                alert("質問内容の文字数が400文字を超えています。");
            }
            else{
                alert("予想外のエラー：再度ページを読み込んで下さい。");
            }
        }
        else{
            $.ajax({
                url:'postQuestion',
                type:'POST',
                dataType:'json',

                data : {
                    name:name,
                    category:category,
                    title:title,
                    questionContents:questionContents,

                    //img:img,
                },
                headers : {
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                },
                contentType: false,
                processData: false,
            }).done(function(json){
                //Controllerから戻ってくるJson処理の記述方法
                alert(json['val']);
                showPopUp();
            }).fail(function(json){
                //alert('エラー。追加できませんでした。');
            });
        }
    });
});
*/
