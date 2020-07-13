
//ポップアップ方法１
$(function(){
    var popup = document.getElementById('js-popup');
    if(!popup) return;

    //var blackBg = document.getElementById('js-black-bg');
    var blackBg = document.getElementById('js-black-bg');
    var closeBtn = document.getElementById('js-close-btn');
    var showBtn = document.getElementById('js-show-popup');

    closePopUp(blackBg);
    closePopUp(closeBtn);
    closePopUp(showBtn);
    function closePopUp(e) {
        if(!e) return;
        e.addEventListener('click', function() {
        //toggle( className ) : クラスがあれば削除・無ければ追加
        popup.classList.toggle('is-show');
        });
        //"is-show"クラスがそのタグについていないときにそれを追加する。追加されるとCSSが適応されて、visibility: visible;になる。その逆ではvisibility: visible;が外れるので、見えなくなる。popupはdocument.getElementById('js-popup');でjs-popupとリンク。このjs-popupがついているタグのclassリストの中にis-showがあるとは消し、ない時は追加させる。ので、まず画面遷移したときはis-showが追加されて、閉じるボタンや画面の外を押下すれば、is-showが取られるので、CSSが働かなくなり表示されなくなる。という仕組み
    }
})

//ポップアップ方法2
$(function(){
	$('.js-modal-open').on('click',function(){
		$('.js-modal').fadeIn();
		return false;
	});
	$('.js-modal-close').on('click',function(){
		$('.js-modal').fadeOut();
		return false;
    });
});



