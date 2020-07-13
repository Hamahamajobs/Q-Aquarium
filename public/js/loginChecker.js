
/*


$('input').keypress(function(e){
    if(e.which == 13) {
        alert(11);
        $('#submit').trigger('click');
        //$(this).parents('form').submit();
        return false;
    }
});
*/



$(function(){
  $('#submit').click(function dojQueryAjax() { 
      var id = $("#id").val();
      var password = $("#password").val();
      
        $.ajax({
            url:'loginChecker',
            type:'POST',
            dataType:'json',
            data : {//json的に記述する。
                id:id,
                password:password
            },
            headers : {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            },
        }).done(function(json){
            //json型で受け取ったログイン可否フラグ
            var loginFlag = json['responseFlag'];
            if(loginFlag == true){
                //ログイン成功した時の処理
                window.location.href = 'top';
            }
            else{
                //ログイン失敗した時の処理
                showPopUp();
            }
        }).fail(function(json){
            alert('エラーが発生しております。ご不便をおかけして申し訳ありません。');
        });
  });
});

function showPopUp(){
    $('.js-modal').fadeIn();
}


//投稿完了後に表示するポップアップ画面を非表示にすると、TOP画面へ遷移する。
$(function(){

    //新規登録ボタン押下
    $('#btnSignUp').on('click',function(){
        window.location.href = 'registration';
    });

    //ポップアップビューを閉じる
    $('.js-modal-close').on('click',function(){
        //$('.js-modal').fadeOut();
        window.location.href = 'loginPage';
		//return false;
    });

    //ログインフォーム はhtmlのformではないのでenterキーを押下しても自動で送信とはならない。その為にjsでそれを実現する。
    $('#password,#id').keypress(function(e){
        if ( e.which == 13 ) {
            $("#submit").click();
            return false;
        }
    } );
    


})
