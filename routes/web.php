<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

//Laravel画面へ
Route::get('/', function () {return view('welcome');});
Route::get('aaa', function () {return view('index.tohoge');});
//ランディングページ(LP)の作成
Route::get('top', 'SwichPageController@getTop');


//ログイン
Route::get('loginPage', 'LoginController@getLogin');
Route::post('loginChecker', 'LoginController@postLoginCheck');
Route::get('logout', 'LoginController@makeUserLogout');

//質問投稿
Route::get('question', 'QuestionController@getQuestion');
Route::post('question_check', 'QuestionController@postQuestionDone');
//Route::post('postQuestion', 'QuestionController@postQuestion');
Route::post('postQuestion','QuestionController@postQuestion')->name('fileUpload');


//プロフィール
Route::get('profile', 'ProfileController@getProfile');
Route::post('user_question_check', 'ProfileController@checkAnswer');
Route::get('selectedUnconfirmedAnswer', 'ProfileController@getUnconfirmedAnswer');//未確認の回答がついた質問を取得
Route::get('pastQuestion', 'ProfileController@getPastQuestion');//ユーザーの過去の質問取得
Route::get('questionsAsProfile', 'ProfileController@getQuestionsAsProfile');//プロフィールから書く質問の詳細にアクセス
Route::post('postThanks', 'ProfileController@postThanks');
Route::get('allPastAnswers', 'ProfileController@getAllPastAnswers');//ユーザーの過去の質問取得
Route::get('unconfirmedThanks', 'ProfileController@getUnconfirmedThanks');//ユーザーの過去の質問取得
Route::get('thanksMessages', 'ProfileController@getThanksMessages');//ユーザーの過去の質問取得



//新規登録
Route::get('registration', 'RegistrationController@getRegistration');
Route::post('registration_check', 'RegistrationController@postRegistration');
Route::post('registration_done', 'RegistrationController@Registration');

//検索
Route::get('search','SearchController@showResult');
Route::get('notification','SearchController@notifice');

//回答投稿
Route::get('answer', 'AnswerController@getAnswer');
Route::get('display_question_chosen', 'AnswerController@displayQuestionChosen');
Route::post('postAnswer', 'AnswerController@postAnswer');

//トップページで選択したカテゴリーの質問のみ表示
//html側でanswer/MIZUKUSAなどでリクエストすればパラメーターとして渡される。
Route::get('selectedCategoryLatest', 'AnswerController@getSelectedCategoryQuestionLatest');
Route::get('selectedCategoryPlant', 'AnswerController@getSelectedCategoryQuestionPlant');
Route::get('selectedCategorySick', 'AnswerController@getSelectedCategoryQuestionSick');
Route::get('selectedCategoryFeed', 'AnswerController@getSelectedCategoryQuestionFeed');
Route::get('selectedCategoryEmergency', 'AnswerController@getSelectedCategoryQuestionEmergency');

//「もっと詳しく」から遷移。選択されたカテゴリーをページネーションと一緒に表示させる
Route::get('selectedCategoryPageDetail
', 'AnswerController@getSelectedCategoryQuestionStartAsDetail');

//意見箱
//Route::get('opinion', function () {return view('opinion.opinion');});
//Route::post('postOpinion','OpinionController@postsOpinion');
Route::get('postOpinion','OpinionController@postsOpinion');

//はるまき情報
Route::get('harumakiInfo', 'OtherController@getHarumakiInfo');

//はるまきにコンタクト
Route::get('harumakiContact', 'OtherController@contactHarumaki');

//テスト
Route::get('aaa', function () {return view('index.zikken');});

//--------------------------------------------------------------------------
//以下は過去の産物
//--------------------------------------------------------------------------
//これはModelを使ってDBからデータを読み込む処理
//Route::post('registration_done', 'DatabaseController@getInformation');

//これは”認証システム”関連かな？
//Route::get('/home', 'HomeController@index')->name('home');

//@section,@yield問題の時の実験
//Route::get('section', function (){return view('layouts.section_test');});