
$(function(){
    $('#button-blue').click(function dojQueryAjax() { 
        var userId = $("#user_id").val();
        var name = $("#name").val();
        var password = $("#password").val();
        var password2 = $("#password2").val();

        if(password != password2 || password.length < 6 || userId.length < 4 || name.length < 2){
            if(password != password2){
                alert("パスワードが一致しません");
            }
            else if(password.length < 6){
                alert("パスワードは6文字以上入力してください。");
            }
            else if(userId.length < 4){
                alert("IDは4字以上入力してください。");
            }
            else if(name.length < 2){
                alert("ニックネームは2文字以上入力してください。");
            }
            else{
                
            }
            return false;    
        }
        else{
            $.ajax({
                url:'registration_check',
                type:'POST',
                dataType:'json',
                data : {
                    userId:userId,
                    name:name,
                    password:password,
                    password2,password2
                },
                headers : {
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                },
            }).done(function(json){
                //json型で受け取ったログイン可否フラグ 0:登録OK　1:登録できない（idに被りあり）2:登録できない（ニックネームに被りあり）
                var registrationFlag = json['responseFlag'];
                switch(registrationFlag){
                    case 0:
                        showPopUp();
                        break;
                    case 1:
                        alert("入力されたIDは既に使われています。");
                        break;
                    case 2:
                        alert("入力されたニックネームは既に使われています。");
                        break;
                    default:
                        alert("何かしらのエラーが発生しております。現在新規登録はできません。ご不便をおかけします。現在原因探索中です。");
                }
            }).fail(function(json){
                alert('エラーが発生しております。ご不便をおかけして申し訳ありません。');
            });
        }

    });
  });
  
  function showPopUp(){
      $('.js-modal').fadeIn();
  }
  
  $(function(){
      //ポップアップビューを閉じる
      $('.js-modal-close').on('click',function(){
          window.location.href = 'top';
      });
  })
  