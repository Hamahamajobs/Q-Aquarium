<?php

namespace App\Model;//hamada  デフォルトではApp;の中にファイルがダイレクトで存在しているためにパスを書き換えないといけない。

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    public $table = 'user_questions';//これでこのモデルが担当するテーブルを定めることができる。デフォルトでは、例えばinformationテーブルのモデル名は"Informations"とすることでリンクできるらしいが、正直ややこしすぎる。なんやねんそれ。面倒臭いので、こうやって$tableプロパティを使って定めている。
}
