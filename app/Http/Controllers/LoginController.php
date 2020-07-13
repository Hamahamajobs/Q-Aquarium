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

class LoginController extends Controller
{
    //Method:入力されたidとpasswordが正しいかを判断する
    public function postLoginCheck(Request $request) {
        try{
            //$user_id = $request->id;
            $user_id = htmlspecialchars($request->id);
            
            //md5 secure
            //$user_password = md5($request->password);
            $user_password = htmlspecialchars($request->password);
            $user_password = md5($user_password);




            $loginFlag = true;//true:ログインOK　false:ログイン不可

            $databaseData = UserInfomation::where('Aqua',$user_id)->first();
            $name = $databaseData->name;
            //DB内のパスワード（ハッシュ値適応後）と入力されたパスワードの比較
            if($user_password == $databaseData->password){
                //ヘルパ関数を使って、セッションを実施。
                //session()が優秀で、グローバル変数を取り扱うようなイメージを今は持っている。
                session()->put(['login' => 'true', 'name' =>$name]); 
            }
            // 入力値が正しくない時
            else{
                session()->put(['login' => 'false', 'name' =>'ゲスト']);
                $loginFlag = false;
            }

            return response()->json([
                'responseData' => '成功しました。',
                'responseFlag' =>  $loginFlag,
                ]);
        }
        catch(Exception $e){//DBと接続できないときの処理
            $loginFlag = false;
            return response()->json([
                'responseData' => '失敗しました。',
                'responseFlag' =>  $loginFlag,
                ]);
        } 
    }

    public function postLogin() {
        //DBと照合して、ログインできれば、トップページを表示して、
        //ログインできなければ、ログイン画面に戻す
        return view('login.loginReal');
    }

    public function getLogin() {

        return view('login.loginReal');
    }

    //ユーザーをログアウトさせる
    public function makeUserLogout(){

        //ヘルパ関数を使ってログアウト実施　各値をログアウト状態にする。
        session()->put(
            ['login' => 'false','name'  => 'ゲスト']
        );        

        return response()->json(['responseData' => '成功しました。',]);
    }

    //--------------------------------------------------------------------------
    //以下は過去の産物
    //--------------------------------------------------------------------------
    /*
    //特定のカラムを取得
    //$passoword_for_checks = UserInfomation::where('id','=',$user_id)->get();
    //$databaseData = UserInfomation::whereAqua($user_id)->first();
    $databaseData = UserInfomation::where('Aqua',$user_id)->first();



    //session()
    //詳しくはhttps://techacademy.jp/magazine/18789を確認してみてね。
    //基本的にはグローバル変数的なものに値を代入し、実質的な”ログイン状態”を作る。
    //session()->put(['key1' => 'value1', 'key2' => 'value2']);
    //$value = session()->get(‘key');

    //これは値が取得できなかった時の処理。
    ようこそ,{{session()->get('name','ゲスト')}}様
    */
}
