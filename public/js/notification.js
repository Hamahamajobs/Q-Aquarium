    //新着回答があるかを確かめる
    $.ajax({
        url:'notification',
        type:'GET',
        dataType:'json',
        data : {
        },
    }).done(function(json){
        //ajaxで新着通知の数を受け取る
        var notification = json['newCounter'];
        //１件以上ある時は表示させる
        if(notification >= 1){
            //受け皿を使ったワンクッション作戦じゃないと上手くいかないから注意。
            /*参考にしたサイト:https://qiita.com/toshiharu-irie/items/e7f803085000c4008f51 */
            $('#newNumUkezara').attr('value',notification);
            $('.userProfile').attr('data-badge',$('#newNumUkezara').attr('value'));
            $(".balloon3-top").css("visibility",'visible');
        }
        else{
            //新着通知がない時は新着通知表示の属性”data-badge”を削除する。
            $(".userProfile").removeAttr('data-badge');

        }
    }).fail(function(json){
        alert('エラーが発生しております。ご不便をおかけして申し訳ありません。');
    });




/*ポップアップ関連 */
function logoutShowPopUp(){
	$('.logoutJs-modal').fadeIn();
}

//投稿完了後に表示するポップアップ画面を非表示にすると、TOP画面へ遷移する。
$(function(){
    $('.logoutJs-modal-close').on('click',function(){
        window.location.href = 'top';
    });
})

$(function(){
    // //新着回答があるかを確かめる
    // $.ajax({
    //     url:'notification',
    //     type:'GET',
    //     dataType:'json',
    //     data : {
    //     },
    // }).done(function(json){
    //     //ajaxで新着通知の数を受け取る
    //     var notification = json['newCounter'];
    //     //１件以上ある時は表示させる
    //     if(notification >= 1){
    //         // $(".balloon3-top").css("visibility","visible");
    //         alert($('.userProfile').data('badge'));
    //         $('.userProfile').data('badge',notification);
    //         alert($('.userProfile').data('badge'));
    //         // $("#newNum").text(notification);
    //     }
    //     else{
    //         $(".userProfile").removeAttr('data-badge');
    //         //通知がない時は何も処理しない。
    //         return false;
    //     }
    // }).fail(function(json){
    //     alert('エラーが発生しております。ご不便をおかけして申し訳ありません。');
    // });
});



$(function(){
    //新着回答があるかを確かめる
    $(".logout").click(function(){
        $.ajax({
            url:'logout',
            type:'GET',
        }).done(function(json){
            logoutShowPopUp();
        }).fail(function(json){
            alert('ログアウトできませんでした。エラーが発生しております。ご不便をおかけして申し訳ありません。');
        });
    });
});


$(function(){
    //通知ボックス自体を押下した時
    $(".balloon3-top").click(function(){
        window.location.href = 'profile';
    });

    //常にsidebarはメインコンテンツのheightと同じ高さに設定する。
    setTimeout(function(){
        var mainHeight = $(".containerPerPage").css('height');
        $('.side_bar').css('height',mainHeight);
    },1000);

    //sidebarの「はるまきについて」の「ブログへ」の高さ調節
    /*
    setTimeout(function(){
        var blogHeight = $("#youtubeIconPropaty").css('height');
        var blogWidth = $("#youtubeIconPropaty").css('width');

        blogHeight = blogHeight * 14;
        blogWidth  = blogWidth  * 14;

        $('#toHarumakiBlog').css('width',blogWidth);
        $('#toHarumakiBlog').css('height',blogHeight);
    },200);
    */

    /*ハンバーガーメニュー　スマホ用　*/
    $('.menu-btn').on('click', function(){
        $('.menu').toggleClass('is-active');
    });


    /*画面上部に戻るためのスクロールボタン  */
    var topBtn = $('#page-top');    
    topBtn.hide();
    //スクロールが800に達したらボタン表示
    $(window).scroll(function () {
        if ($(this).scrollTop() > 800) {
            topBtn.fadeIn();
        } else {
            topBtn.fadeOut();
        }
    });
    //スクロールしてトップ
    topBtn.click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 500);
        return false;
    });


    /*空文字で検索されることを防ぐ */
    $("#searchForm").keydown(function(){
        //現在入力されている文字
        var text = $(this).val();
        //現在の文字数
        var count = text.length;
        if(count >= 2){
            $("#searchSendButton").css("background-color","green");
            $("#searchSendButton").css("color","white");
            $("#searchSendButton").css("pointer-events","initial");
        }
        else{
            return false;
        }
    });
})













