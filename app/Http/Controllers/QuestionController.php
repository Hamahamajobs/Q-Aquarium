<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Blade;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use App\Model\UserInfomation;
use App\Model\Question;
use Exception;
use PhpParser\Node\Stmt\Catch_;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\Environment\Console;

/*
**質問投稿
**
*/
class QuestionController extends Controller
{
    protected $name,$category,$title,$question,$picture;
    static $questionID;

    //質問作成の画面
    public function getQuestion() {
        if(session()->get('name') == '' || session()->get('name')=='ゲスト'){
            return view('login.loginReal');
        }
        else{
            return view('question.question');
        }
    }


    
    public function postQuestion(Request $request) {
                
        //ajaxでのdataType:'text'には、formData.append('testData', 123); とinput('foo')が有効。
        //エンコードとデコードを利用。ajax⇆controller間で文字化けする問題への対策
        $name              =  urldecode($request->input('name'));
        $title             =  urldecode($request->input('title'));
        $category          =  urldecode($request->input('category'));
        $questionContents  =  urldecode($request->input('questionContents'));

        //secure
        $name  = htmlspecialchars($name);
        $title   = htmlspecialchars($title);
        $category = htmlspecialchars($category);
        $questionContents = htmlspecialchars($questionContents);


        $newQuestion = new Question();

        $newQuestion->name = $name;
        $newQuestion->title = $title;
        $newQuestion->category = $category;
        $newQuestion->question = $questionContents;


        /*
        laravelで画像を保存する方法
        ・DBに直接画像を保存するのはNG→処理が重くなるから。違うところに保存しておいてDBにはパスのみを格納しておく感じ。
        ・$request->file('file')はajaxでファイル形式の物を送る場合に必要らしい。正規のやり方では<form>タグで送るが、今回はajax経由なので、いろいろと装飾が必要。
        ・->store('public');で、画像の格納場所を指定している。 store('public') とすることで public ディレクトリに保存している。ここでいうpublicディレクトリとはcss,jsなどが入っているところではなく、僕の環境で言う/storage/app/storageのこと。初期設定では storage/app ディレクトリに保存されるようになっているようで、public ディレクトリに保存するためにstore メソッドの引数にディレクトリ名 public を指定する。デフォルトだとstorageに生で入ってしまう→自分でフォルダを作成する(public)→そこに帆zんされる→でも実際に公開されるのはpublic(js,cssが格納されている方のpublic)→public側からも、storage/app/publicを叩けるようにすることで、アプリを公開しても画像にアクセスできる→シンボリックリンクを使う（php artisan storage:link）→これでlaravelの裏側に保存されていた画像が、公開用のpublicから見れるようになった（70%）状態になる。
        */
        // ファイルが来ているかのチェック
        if ( $request->hasFile('file') !== true ) {//画像なし
            $newQuestion->question_pic1 = null;
        }
        else{//画像あり
            $path = $request->file('file')->store('public');//ここでのpublicは公開用ではなくstorage/app/publicの方のやつ
            $path = str_replace('public/', 'storage/', $path);//todo storage/を無くして、View側で呼び出す時にガッチャンコする感じで。
            $newQuestion->question_pic1 = $path;
        }

        $newQuestion->save();

        
        //return response()->json(['status' => 'true', 'path' => $path,'jon'=>$jon]);
        return response()->json(['status' => 'true']);
    }
}
