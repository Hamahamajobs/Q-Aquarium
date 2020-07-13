// jQueryを使う方法
//ページを読み込んだ後に、これを実行したい。
//ページを読み込んだと同時に、これにつながるボタンを押下したことにすればOK

//"$"が、PHPの”＄”とコンフリクトしたときは、jQuery(function(){})で対応可能。
jQuery(function(){
    jQuery('#categoryLatest').click(function dojQueryAjax() { 
        jQuery.ajax({
            //Laravelのweb.phpに合わせる
            url:'selectedCategoryLatest',
            type:'GET',
        }).done(function(data){
            //任意のhtml側の要素に、読み込んだhtmlのデータ、またはそこの指定idを表示
            jQuery(".selected_category_detail").load("selectedCategoryLatest #sample");
        }).fail(function(data){
            alert('サーバーエラー。現在原因解明中です。復旧までしばらくお待ちください。');
        });
    });
});

$(function(){
    $('#categoryPlant').click(function dojQueryAjax() { 
        $.ajax({
            url:'selectedCategoryPlant',
            type:'GET',
        }).done(function(data){
            $(".selected_category_detail").load("selectedCategoryPlant #sample");
        }).fail(function(data){
            alert('サーバーエラー。現在原因解明中です。復旧までしばらくお待ちください。');
        });
    });
});

$(function(){
    $('#categorySick').click(function dojQueryAjax() {
        $.ajax({        
            url:'selectedCategorySick',
            type:'GET',
        }).done(function(data){
            $(".selected_category_detail").load("selectedCategorySick #sample");
        }).fail(function(data){
            alert('サーバーエラー。現在原因解明中です。復旧までしばらくお待ちください。');
        });
    });
});


$(function(){
    $('#categoryFeed').click(function dojQueryAjax() {
        $.ajax({       
            url:'selectedCategoryFeed',
            type:'GET',
        }).done(function(data){
            $(".selected_category_detail").load("selectedCategoryFeed #sample");
        }).fail(function(data){
            alert('サーバーエラー。現在原因解明中です。復旧までしばらくお待ちください。');
        });
    });
});

$(function(){
    $('#categoryEmergency').click(function dojQueryAjax() {
        $.ajax({        
            url:'selectedCategoryEmergency',
            type:'GET',
        }).done(function(data){
            $(".selected_category_detail").load("selectedCategoryEmergency #sample");
        }).fail(function(data){
            alert('サーバーエラー。現在原因解明中です。復旧までしばらくお待ちください。');
        });
    });
});

/*
//↓これは勝負の証。ajaxで読み込んだ先ページでのpagination機能実装に伴いチャレンジした。
//しかし求める機能を実現することができなかった。
//問題点は「ページネーションを押下すれば遷移してしまう。僕はtop画面でajaxとして表示されるだけでよかった」こと。また機会があればチャレンジしたい。
$(function(){
    $(document).on('click','.pagination',function dojQueryAjax() {
        $.ajax({        
            url:'selectedCategoryStart',
            type:'GET',
        }).done(function(data){
            alert("テスト");
            $(".selected_category_detail").load("selectedCategoryStart #sample");
        }).fail(function(data){
            alert('サーバーエラー。現在原因解明中です。復旧までしばらくお待ちください。');
        });
    });
});

//jQueryの関数の読み込みに関する経験が増えた！↓.on()でajax後の要素も読み込める。
$(function(){
    $(document).on('click', '.jontony', function(){
        alert("bbbbbb");
    });
});
*/

//↓コメントアウトしましたがこれなんですか？
//import { createSecureContext } from "tls";
