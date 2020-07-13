<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserInfomation extends Model
{
    public $table = 'information';//これでこのモデルが担当するテーブルを定めることができる。デフォルトでは、例えばinformationテーブルのモデル名は"Informations"とすることでリンクできるらしいが、正直ややこしすぎる。なんやねんそれ。面倒臭いので、こうやって$tableプロパティを使って定めている。
    
    public $timestamps = false;//これで自動で日時を記録しているカラムを停止（？）することができる。
}
