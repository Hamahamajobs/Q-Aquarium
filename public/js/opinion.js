
function opinionShowPopUp(){
	$('.opinionJs-modal').fadeIn();
}

//投稿完了後に表示するポップアップ画面を非表示にすると、TOP画面へ遷移する。
$(function(){
    $('.opinionJs-modal-close').on('click',function(){
        window.location.href = 'top';
    });
})

//カウント
$(function(){
    //カウントするフィールドを監視
    $(".opinionTextArea").keydown(function(){
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


$(function(){
    $("#postOpinion").click(function(){
        var opinionMesseges = $("#opinionContents").val();
        var name            = $("#forOpinionInput").val();

        if(opinionMesseges.length <= 9){
            alert("恐縮ですが、ご意見は10文字以上で投稿して下さい。");
        }
        else{
            $.ajax({
                url:'postOpinion',
                type:'GET',
                dataType:'json',
                data : {
                    name:name,
                    opinionMesseges:opinionMesseges,
                },
            }).done(function(json){
                opinionShowPopUp();
            }).fail(function(json){
                alert('エラー:投稿できませんでした。');
            });
        }
    });
})