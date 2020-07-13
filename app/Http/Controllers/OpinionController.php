<?php

namespace App\Http\Controllers;

use App\Model\Opinion;
use App\Model\UserInfomation;
use Illuminate\Http\Request;

class OpinionController extends Controller
{


    public function postsOpinion(Request $request) {

        $opinionMesseges    = htmlspecialchars($request->opinionMesseges);
        $name               = htmlspecialchars($request->name);

        $newopinion = new Opinion();
        //$newopinion->name = session()->get('name');
        $newopinion->name = $name;
        $newopinion->opinionMesseges = $opinionMesseges;
        $newopinion->save();

        return response()->json([
            'responseData' => '成功しました。',
            ]);
    }

        /* 昔、メールを送信できていたもの。
    public function postsOpinion(Request $request) {
        $aqua           =  $request->aquaId;
        $email          =  $request->email;
        $opinionMessege =  $request->opinionMessege;

        //入力されたメールアドレスにメールを送信する。
        $userOpinion = new Opinion();
        $userOpinion->aqua            =  $aqua;
        $userOpinion->email           = $email;
        $userOpinion->opinionMessege  =  $opinionMessege;
        $userOpinion->save();

        //メールにユーザー名を記載するために、aquaIdを使用してユーザー名を取得
        $username = UserInfomation::where('aqua',$aqua)->first();
        $userName = $username->name;
        //PHPの自動メール送信の雛形
        //自動送信 php的な書き方。laravel専用のものがあるらしいが時間がないのでこれで。
        $mail_sub  = 'アンケートありがとうございました。';
        $mail_body = $userName.'様へ\n貴重なご意見ありがとうございました。';
        $mail_body = html_entity_decode($mail_body,ENT_QUOTES,"UTF-8");
        $mail_head = 'From:Q＆Aquarium管理人はるまき';
        mb_language('Japanese');
        mb_internal_encoding("UTF-8");
        mb_send_mail($request->email,$mail_sub,$mail_body,$mail_head);

        return view('opinion.thanks',compact('userName','aqua','email','opinionMessege'));
    }
    */


}
