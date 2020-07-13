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
use App\Model\Answer;
use Exception;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Mail\Message;
use PhpParser\Node\Stmt\Catch_;
use Symfony\Component\HttpFoundation\Test\Constraint\ResponseCookieValueSame;

class AnswerController extends Controller
{
    public function getAnswer() {
        //質問を取得
        $questionItems = Question::select('id','category','title','question')->get();
        
        return view('answer.answer',compact('questionItems'));
    }

    public function displayQuestionChosen(Request $request) {
        //ユーザーが選択した質問のaquaIdカラムの値
        $code = $request->input('code');

        //ユーザーが回答したい質問レコードを取得する。
        $questionItemsUserSelected = Question::select('id','name','category','title','question','question_pic1')->where('id',$code)->get();

        $code          = $questionItemsUserSelected[0] ->id;
        $category      = $questionItemsUserSelected[0] ->category;
        $name          = $questionItemsUserSelected[0] ->name;
        $title         = $questionItemsUserSelected[0] ->title;
        $question      = $questionItemsUserSelected[0] ->question;
        $question_pic1 = $questionItemsUserSelected[0] ->question_pic1;

        $answers = Answer::select('answer','name','answer_pic1')->where('question_id',$code)->get();

        //$codeはDB登録にも必要な情報のために再度View側に返す必要がある。
        return view('answer.answer_to_question',compact('code','name','category','title','question','question_pic1','answers'));
    }


    /* ajaxで各カテゴリーの質問を少しだけ表示させる
    */
    //Ajax 選択されたカテゴリーの質問のみを表示する。
    //カテゴリー：最新
    public function getSelectedCategoryQuestionLatest(){

        $value = "最新";

        $questionItems = Question::select('id','category','title','question')->latest()->paginate(10);
        
        return view('index.selectedCategoryPage',compact('questionItems'))->with('value',$value);
    }

    //カテゴリー：立ち上げ
    public function getSelectedCategoryQuestionPlant(){
        $category_kind = "水草";
        $value = "水草";
        //hamada ページネーション練習のためにDB取得の条件分変更した？↓
        //$questionItems = Question::select('id','category','title','question')->where('category',$category_kind)->get();

        //todo デグレが気になるが、paginate(5)ではなくシンプルにDBから最新のレコード５つ取得
        //$questionItems = DB::table('user_questions')->paginate(5);
        //$selectedCategoryStart->setPath();
        //$questionItems->setPath();

        $questionItems = Question::select('id','category','title','question')->where('category',$category_kind)->latest()->paginate(10);
        
        return view('index.selectedCategoryPage',compact('questionItems'))->with('value',$value);
    }

    //カテゴリー：病気
    public function getSelectedCategoryQuestionSick(){
        $category_kind = "病気";
        $value = "病気";
        $questionItems = Question::select('id','category','title','question')->where('category',$category_kind)->latest()->paginate(10);

        return view('index.selectedCategoryPage',compact('questionItems'))->with('value',$value);    
    }

    //カテゴリー：エサ
    public function getSelectedCategoryQuestionFeed(){
        $category_kind = "エサ";
        $value = "エサ";
        $questionItems = Question::select('id','category','title','question')->where('category',$category_kind)->latest()->paginate(10);

        return view('index.selectedCategoryPage',compact('questionItems'))->with('value',$value);    
    }

    //カテゴリー：緊急
    public function getSelectedCategoryQuestionEmergency(){
        $category_kind = "緊急";
        $value = "緊急";
        $questionItems = Question::select('id','category','title','question')->where('category',$category_kind)->latest()->paginate(10);

        return view('index.selectedCategoryPage',compact('questionItems'))->with('value',$value);    
    }


    /* 「もっと詳しく」から遷移した、各カテゴリーの質問をページネーションと一緒に表示させる
    * 2020/3/28
    */
    public function getSelectedCategoryQuestionStartAsDetail(Request $request){

        $value = $request->input("value");

        switch($value){
            case 'Latest':
            $category_kind = "最新";
            break;

            case 'Start':
            $category_kind = "立ち上げ";
            break;

            case 'Sick':
            $category_kind = "病気";
            break;

            case 'Feed':
            $category_kind = "エサ";
            break;

            case 'With':/*todo Withだけど生体のままで修正する。　*/
            $category_kind = "生体";
            break;

            case 'Plant':
            $category_kind = "水草";
            break;

            case 'Wood':
            $category_kind = "流木";
            break;

            case 'Layout':
            $category_kind = "レイアウト";
            break;

            case 'Emergency':
            $category_kind = "緊急";
            break;

            case 'Equipment':
            $category_kind = "設備";
            break;

            case 'Other':
            $category_kind = "その他";
            break;

            default:
            //todo switch文でdefaultのときにどうする？
            //今はとりあえず$category_kind = "立ち上げ";という状態にしてます。
            //エラー処理的な感じだと思うから、もし予想外の時はカテゴリーを選ばず、全部出すとか。
            $category_kind = "最新";
        }
        //過去の質問：そのユーザーのプロフィール画面で、そのユーザーの過去の質問を表示する時
        if($value == "pastQuestion"){
            
            $questionItems = Question::select('id','category','title','question')->where('name',session()->get('name'))->latest()->paginate(10);    
        }
        //過去の回答：そのユーザーのプロフィール画面で、そのユーザーの過去の回答を表示する時
        elseif($value == "pastAnswer"){
            //そのユーザーが今までの回答した質問のquestion_idを取得
            $answerInfos = Answer::select('question_id')->where('name',session()->get('name'))->latest()->get();
            //上記で取得したidの質問を取得
            $questionItems = Question::select('id','category','title','question')->whereIn('id',$answerInfos
            ->pluck('question_id'))->latest()->paginate(10);
        }
        //カテゴリー問わず最新の質問を取得
        elseif($category_kind == "最新"){
            $questionItems = Question::select('id','category','title','question')->latest()->paginate(10);
        }
        //通常の処理
        else{
            $questionItems = Question::select('id','category','title','question')->where('category',$category_kind)->latest()->paginate(10);
        }

        return view('index.selectedCategoryPageDetail',compact('questionItems'))->with('value',$value);

    }

    //投稿された質問をDBに反映させる。Ajax通信を使うためにリクエスト元にjson形式で返す。
    public function postAnswer(Request $request){

        //ajaxでのdataType:'text'には、formData.append('testData', 123); とinput('foo')が有効。
        //エンコードとデコードを利用。ajax⇆controller間で文字化けする問題への対策
        $questionCode    =  urldecode($request->input('questionCode'));
        $answer          =  urldecode($request->input('answer'));
        $AnswerName      =  urldecode($request->input('AnswerName'));
        $questionerName  =  urldecode($request->input('questionerName'));

        //secure
        $questionCode    = htmlspecialchars($questionCode);
        $answer          = htmlspecialchars($answer);
        $AnswerName      = htmlspecialchars($AnswerName);
        $questionerName  = htmlspecialchars($questionerName);

        $dbAnswer = new Answer();
        //受け取った回答をdbの回答レコードに格納
        $dbAnswer->answer = $answer;
        //回答した質問IDを、回答db側に保存する。
        $dbAnswer->question_id = $questionCode;
        //回答者の名前を保存する
        $dbAnswer->name = $AnswerName;
        //新規着信フラグを立てる 1:新着あり　0:新着なし
        $dbAnswer->new = 1;
        //質問者のニックネーム格納
        $dbAnswer->question_name = $questionerName;

        // ファイルが来ているかのチェック
        if ( $request->hasFile('file') !== true ) {//画像なし
            $dbAnswer->answer_pic1 = null;
        }
        else{//画像あり
            $path = $request->file('file')->store('public');//ここでのpublicは公開用ではなくstorage/app/publicの方のやつ
            $path = str_replace('public/', 'storage/', $path);//todo storage/をなくしてよりシンプルに。
            $dbAnswer->answer_pic1 = $path;
        }        

        $dbAnswer->save();

        return response()->json([
        'responseData' => '成功しました。',
        ]);
    }    
}
