<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Question;
use App\Model\Answer;
use LengthException;

class SearchController extends Controller
{
    //検索機能：ユーザーから文字列を受け取り、それが含まれる質問を一覧にして返す。
    public function showResult(Request $request) {
        //GETメソッドで受け取った検索する文字列を格納
        $searchWord = $request->input('searchWord');

        //検索する文字列が”質問内容”内に含まれているレコードを取得。
        $results = Question::select('id','category','title','question')->where('question','like','%'.$searchWord.'%')->get();
        

        return view('search.search',compact('results'));
    }

    //新着通知
    public function notifice(){
        //新着回答のカウンター: ログインしているユーザーの名前と同じ名前で投稿された質問の、新着フラグ（new）が立っているものを取得
        $newCounterOfAnswer = Answer::where('new',1)->where('question_name',session()->get('name'))->count();
        //新着thanksのカウンター
        $newCounterOfThanks = Answer::where('thanksNew',1)->where('name',session()->get('name'))->count();
        //新着回答のカウンターと新着thanksのカウンターの合計値を新着件数として表示させる。
        $newCounter = $newCounterOfAnswer + $newCounterOfThanks;

        return response()->json([
            'responseData' => '成功しました。',
            'newCounter' => $newCounter,
        ]);
    }
}
