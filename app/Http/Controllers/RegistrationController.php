<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Blade;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use App\Model\Question;
use App\Model\UserInfomation;
use Exception;
use PhpParser\Node\Stmt\Catch_;

class RegistrationController extends Controller
{
    //新規登録　入力データを受け取り、
    public function Registration(Request $request) {
        //secure
        $new_password = md5($request->password);

        $newUserInfomationData = new UserInfomation();
        //Modelインスタンスのプロパティ（DBのカラム）に追加
        $newUserInfomationData->aqua = $request->userId;
        $newUserInfomationData->name = $request->name;
        $newUserInfomationData->password = $new_password;
        $newUserInfomationData->introduction = $request->introduction;

        $newUserInfomationData->save();
    
        return view('user_info.registration_done');
    }

    public function getRegistration() {
        return view('user_info.registration'); 
    }


    public function getRegistrationCheck() {
        return view('user_info.registration_check');
    }


    public function postRegistration(Request $request) {
        //新規登録の可否フラグ
        $registrationFlag = 0;//registrationFlag 0:登録OK　1:登録できない（idに被りあり）2:登録できない（ニックネームに被りあり）

        //値受け取り
        $userId       = $request->userId;
        $name         = $request->name;
        $password     = $request->password;
        $password2    = $request->password2;
        $introduction = $request->introduction;
        
        //secure
        $userId       = htmlspecialchars($userId);
        $name         = htmlspecialchars($name);
        $password     = htmlspecialchars($password);
        $password2    = htmlspecialchars($password2);
        $introduction = htmlspecialchars($introduction);

        //パスワードを暗号化
        $password = md5($password);

        //入力されたIDがすでにDBないに存在しないかをチェックする。 "aqua":Q&AquariumでのIDのこと
        $isRegistrationCounter = UserInfomation::where('aqua',$userId)->count();
        $isRegistrationCounterOfUserName = UserInfomation::where('name',$name)->count();
        
        //すでに"ID"が使われている
        if($isRegistrationCounter >= 1){
            $registrationFlag = 1;
            return response()->json([
                'responseData' => '失敗しました',
                'responseFlag' =>  $registrationFlag,
            ]);
        }
        //すでに"ニックネーム"が使われている
        elseif($isRegistrationCounterOfUserName >= 1){
            $registrationFlag = 2;
            return response()->json([
                'responseData' => '失敗しました',
                'responseFlag' =>  $registrationFlag,
            ]);
        }
        else{
        //新規ユーザーをDBに登録
        $newUserInfomationData = new UserInfomation();
        $newUserInfomationData->aqua = $userId;
        $newUserInfomationData->name = $name;
        $newUserInfomationData->password = $password;
        $newUserInfomationData->introduction = $introduction;

        $newUserInfomationData->save();

        //新規登録したら自動でログイン
        session()->put(['login' => 'true', 'name' =>$name]); 

        return response()->json([
            'responseData' => '成功しました。',
            'responseFlag' =>  $registrationFlag,
            ]);
        }
    }
}
