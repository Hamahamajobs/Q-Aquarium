//未確認の投稿を表示させるために読み込む
$(window).on('load', function() {
    $('#allPastQuestions').delay(10).queue(function(){
        $(this).click();
    });
});


$(function(){
    //”新着回答”：そのユーザーが確認していない回答がついている質問を表示
    $('#unconfirmedAnswers').click(function dojQueryAjax() { 
        $.ajax({
            url:'selectedUnconfirmedAnswer',
            type:'GET',
        }).done(function(data){
            $(".selected_category_detail").load("selectedUnconfirmedAnswer #sample");
        }).fail(function(data){
            alert('サーバーエラー。現在原因解明中です。復旧までしばらくお待ちください。');
        });
    });

    //"過去の質問”：そのユーザーが今までに投稿した質問質問
    $('#allPastQuestions').click(function dojQueryAjax() { 
        $.ajax({
            url:'pastQuestion',
            type:'GET',
        }).done(function(data){
            $(".selected_category_detail").load("pastQuestion #sample");
        }).fail(function(data){
            alert('サーバーエラー。現在原因解明中です。復旧までしばらくお待ちください。');
        });
    });


    //Thanks : そのユーザーの回答に対してThanksがあるもの且つユーザーが確認していないものを表示
    $('#unconfirmedThanks').click(function dojQueryAjax() { 
        $.ajax({
            url:'unconfirmedThanks',
            type:'GET',
        }).done(function(data){
            $(".selected_category_detail").load("unconfirmedThanks #sample");
        }).fail(function(data){
            alert('サーバーエラー。現在原因解明中です。復旧までしばらくお待ちください。');
        });
    });


    //Answer : そのユーザーが回答した質問を表示
    $('#allPastAnswers').click(function dojQueryAjax() { 
        $.ajax({
            url:'allPastAnswers',
            type:'GET',
        }).done(function(data){
            $(".selected_category_detail").load("allPastAnswers #sample");
        }).fail(function(data){
            alert('サーバーエラー。現在原因解明中です。復旧までしばらくお待ちください。');
        });
    });


    //ボタンの色の入れ変わり
    var btn = $('.categoryButton');
    btn.click(function(){
    btn.removeClass('categoryActive');
    $(this).addClass('categoryActive');
    });
});



//thanksフォームをカウント
$(function(){
    $(".thanksFormTextarea").keydown(function(){
        //現在入力されている文字
        var text = $(this).val();
        //正確にカウントするため改行コード削除
        text = text.replace((new RegExp("\r\n","g")),"");
        text = text.replace((new RegExp("\n","g")),"");
        //現在の文字数
        var count = text.length;

        //設定した上限文字数
        var moji_limit = $(this).attr("limit");
    
        //そのthanksfromが属する回答IDを取得
        var answerId = $(this).attr('name');
 
        //そのthanksFormに対応する文字数をリアルタイムの表示
        $("#moji_suu" + answerId).text(count);
 
        //処理分け
        if(count == 0){
            //字を消して0文字となった場合。
            $("#moji_suu" + answerId).text("0");
        } else if(count > moji_limit) {
            //上限文字数を超えたら赤色表示
            $("#moji_suu" + answerId).css("color", "red");
        } else {
            //文字数が範囲内なら色を戻す
            $("#moji_suu" + answerId).css("color", "");
        }
    });
});


//thanksメッセージを送信する
$(function(){
    $('.postThanks').click(function dojQueryAjax() { 
        var answerId = $(this).attr('name');//thanksを送りたい回答の主キー"id"
        var thanksMessege = $("#thanksForm" + answerId).val();

        if(thanksMessege.length < 5 || thanksMessege.length>400){
            if(thanksMessege.length < 5){
                alert("Thanksメッセージは5文字以上入力して下さい。");    
            }
            else if(thanksMessege.length > 400){
                alert("Thanksメッセージは400文字以下で入力して下さい。");
            }
            else{

            }
        }
        else{
            $.ajax({
                url:'postThanks',
                type:'POST',
                dataType:'json',
                data : {
                    answerId:answerId,
                    thanksMessege:thanksMessege,
                },
                headers : {
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                },
                //contentType: false,//いらない？
                //processData: false,//いらない？
            }).done(function(json){
                showPopUp();
            }).fail(function(json){
                alert('エラー。thanksが送信できませんでした。再度ページを読み込んでください。');
            });
        }
    });
});


//thanksメッセージ送信後のポップアップ
function showPopUp(){
    $('.js-modal').fadeIn();
}

$(function(){
    //ポップアップビューを閉じる
    $('.js-modal-close').on('click',function(){
        window.location.reload();//thanksを投稿すればページ再度読み込む
    });
})











