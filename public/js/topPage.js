//ブラウザ画面を完全に読み込んだ後でも、Ajaxが読み込めない時がたまに発生したために、10ms後に実行することによって回避する。
$(window).on('load', function() {
    $('#categoryLatest').delay(10).queue(function(){
        $(this).click();
    });

    setTimeout(function(){
        var picHeight = $(".background-pic").css('height');
        $('.bubbles').css('height',picHeight);
    },200);

});



//アニメーション　jqueryのプラグイン
$(function(){
    $("h1").textillate({
        loop: true,
        in: {
            effect: 'bounceIn',
            delay: 25,
            sequence: true
        },
        //フェードアウトの時
        out: {
            effect: 'bounce',
            delay: 20,
            sequence: true
        }
    });
})


//ボタンが幾つか並んでおり、クリックしたら色が変化する。他をクリックすればまた変化し、戻る。
//全てのボタンに対象のクラスを付与する。
//その後に、色を付けたい（押下したthisボタン）ボタンのみに再度クラスを付与する。
//css側に初めは架空の.active{}を書いておく必要がある。
$(function(){
    var btn = $('.categoryButton');
    btn.click(function(){
    btn.removeClass('categoryActive');
    $(this).addClass('categoryActive');
    });
  });

  //検索ボタン
$(function(){
    $("#btnSearchStart").click(function(){
        var searchWord = $("#searchForm").val();
        if(searchWord == ""){
            return false;
        }
        //window.location.href = 'search';
        window.location.href = 'search?searchWord=' + val;
    });
    $(".weather").css("color", "#ff7c89");
})
