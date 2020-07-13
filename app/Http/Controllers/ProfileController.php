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
use PhpParser\Node\Stmt\Catch_;
use Illuminate\Support\Facades\Storage; //画像読み込み：画像保存場所がStrageのため

class ProfileController extends Controller
{
    //プロフィールデータをDBから取得して返す
    public function getProfile(){

        //ゲストアカウントにはプロフィールへのアクセスを許可しない。
        if(session()->get('name') == '' || session()->get('name')=='ゲスト'){
            return view('login.loginReal');
        }
        //ログインしたユーザーのみプロフィールへのアクセスを許可。
        else{
            //nameカラムがsession()の値と等しいテーブルのaqua,name,introductionを取得する。
            $informationItems = UserInfomation::select('aqua','name','introduction')->where('name',session()->get('name'))->get();

            // コレクションの[0]番目のModelインスタンスの中のプロパティ（DBでのカラム）を代入
            $aqua = $informationItems[0]->aqua;
            $name = $informationItems[0]->name;
            $introduction = $informationItems[0]->introduction;

            return view('user_info.profile',compact('aqua','name','introduction'));
        }
    }

    //"新着回答"：そのユーザーが未確認の質問を取得
    public function getUnconfirmedAnswer(){
        //取得するレコードが空かどうかを判断するフラグ
        $emptyFlag = 0;
        
        //そのユーザーの新着回答になる質問IDを取得
        $unconfirmedAnswer = Answer::select('question_id')->where('question_name',session()->get('name'))->where('new',1)->get();

        //whereInメソッドは、指定カラムで、複数の条件に適合する物を取得する。例：->whereIn('id',[122,123,124,125])
        $questionItems = Question::select('id','category','title','question')->whereIn('id',$unconfirmedAnswer->pluck('question_id'))->latest()->get();

        if(count($questionItems) <= 0) {
            $emptyFlag = 1;
        }

        /*hamada test 画像が表示されるかの実験*/
        $picPath = Question::select('question_pic1')->where('id',130)->first();

        //$pathX = Storage::putFile('avatars', $request->file('avatar'));
                

        //return view('index.withAnswersSelectedCategoryPage',compact('questionItems'));
        return view('index.withAnswersSelectedCategoryPage',['emptyFlag'=>$emptyFlag],compact('questionItems'))->with('picPath',$picPath);
    }


    //”過去の質問”：そのユーザーの過去の質問を全て取得する
    public function getPastQuestion(){
        $questionItems = Question::select('id','category','title','question')->where('name',session()->get('name'))->latest()->paginate(10);

        $value ="過去の質問";

        //return view('index.withAnswersSelectedCategoryPage',compact('questionItems','data'))->with('value',$value)->with('picPath',$picPath->question_pic1);
        return view('index.withAnswersSelectedCategoryPage',compact('questionItems'))->with('value',$value);        
    }

    //"過去の回答"：ユーザーの過去の回答
    public function getAllPastAnswers(){
        $answerInfos = Answer::select('question_id')->where('name',session()->get('name'))->latest()->get();

        $value ="過去の回答";

        $questionItems = Question::select('id','category','title','question')->whereIn('id',$answerInfos
        ->pluck('question_id'))->latest()->paginate(10);

        return view('index.withAnswersSelectedCategoryPage',compact('questionItems'))->with('value',$value); 
    }   
        

    //Thanks:そのユーザーへのThanks
    public function getUnconfirmedThanks(){
        $thanksInfos = Answer::select('question_id','thanks')->where('name',session()->get('name'))->where('thanksNew',1)->latest()->get();

        //thanksメッセージ一覧画面では、質問のタイトルとthanksメッセージを表示したいために、ここでQuestionテーブルからもtitleカラムを取得する。
        $questionItems = Question::select('id','title')->whereIn('id',$thanksInfos
        ->pluck('question_id'))->latest()->get();

        $value ="Thanks";//カラウチ
        if($thanksInfos->isEmpty()){
            $emptyFlag = 2;
        }
        else{
            $emptyFlag = 1;
        }

        //return view('index.withAnswersSelectedCategoryPage',compact('questionItems','data'))->with('value',$value)->with('picPath',$picPath->question_pic1);
        return view('index.withAnswersSelectedCategoryPage',['emptyFlag'=>$emptyFlag],compact('thanksInfos','questionItems'))->with('value',$value);

    } 

    public function getThanksMessages(Request $request){
        //ユーザーが選択した質問のID
        $code = $request->input('code');

        //そのユーザーが回答を確認したと判断し、”新着フラグ”を変更する　1:新着あり　0:新着なし
        //その人が複数回、回答してしまった可能性があり、同じ質問に２個回答した場合は、２個のthanksが送られてくる可能性があるため、それに対処
        $thanksMesseges = Answer::where("question_id",$code)->where("name",session()->get('name'))->get();
        foreach($thanksMesseges as $thanksMessege){
            $thanksMessege->thanksNew = 0;
            $thanksMessege->save();
        }

        $questionItemsUserSelected = Question::select('id','name','category','title','question','question_pic1')->where('id',$code)->get();

        $name          = $questionItemsUserSelected[0] ->name;
        $category      = $questionItemsUserSelected[0] ->category;
        $title         = $questionItemsUserSelected[0] ->title;
        $question      = $questionItemsUserSelected[0] ->question;
        $question_pic1 = $questionItemsUserSelected[0] ->question_pic1;


        //そのユーザーがもらったthanksの元になっている（そのユーザーが過去に回答した）アンサーを取り出す
        $answers = Answer::select('id','answer','name','answer_pic1','thanks')->where('question_id',$code)->where('name',session()->get('name'))->get();


        return view('user_info.thanksDetail',compact('code','name','category','title','question','question_pic1','answers'));
    }


    //プロフィールで表示している”質問画面”に表示されている質問を押下すると、”新着回答件数”が減少する。
    public function getQuestionsAsProfile(Request $request) {

        //ユーザーが選択した質問のID
        $code = $request->input('code');

        //そのユーザーが回答を確認したと判断し、”新着フラグ”を変更する　1:新着あり　0:新着なし
        $values = Answer::where("question_id",$code)->get();

        foreach($values as $value){
            $value->new = 0;
            $value->save();
        }

        $questionItemsUserSelected = Question::select('id','name','category','title','question','question_pic1')->where('id',$code)->get();

        $name          = $questionItemsUserSelected[0] ->name;
        $category      = $questionItemsUserSelected[0] ->category;
        $title         = $questionItemsUserSelected[0] ->title;
        $question      = $questionItemsUserSelected[0] ->question;
        $question_pic1 = $questionItemsUserSelected[0] ->question_pic1;


        //ユーザーが選択した質問に対する、全てのアンサーも取得して返す。
        $answers = Answer::select('id','answer','name','answer_pic1','thanks','thanksNew')->where('question_id',$code)->get();
    
        //$codeはDB登録にも必要な情報のために再度View側に返す必要がある。
        return view('user_info.questionsAsProfile',compact('code','name','category','title','question','question_pic1','answers'));
    }

    public function postThanks(Request $request) {

        $answerId    = htmlspecialchars($request->answerId);
        $thanksMessege    = htmlspecialchars($request->thanksMessege);


        //教訓:first()はレコード丸ごと１つのみをごっそり取得するイメージ。Answer:select~~としてしまうと取得できない。　
        //$thanksRecord = Answer::select('thanks','thanksNew')->where('id',$answerId)->first();
        $thanksRecord = Answer::where('id',$answerId)->first();
        
        $thanksRecord->thanks = $thanksMessege;
        $thanksRecord->thanksNew = 1; //1:新着thanksあり  0:新着thanksなし
        $thanksRecord->save();

        return response()->json([
            'responseData' => '成功しました。',
            ]);

    }

}
