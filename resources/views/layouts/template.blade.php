<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @yield("addMeta")

        <title>@yield('title',"アクアリウム専門質問サイトQ&Aquarium")</title>
        <!--bootstrap要 -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <!--Original css -->
        <link rel="stylesheet" href="css/template/hina.css">
        @yield('css')
        <!--jQuery読み込み-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript"src="{{ asset('js/notification.js') }}"></script>
        <script type="text/javascript"src="{{ asset('js/opinion.js') }}"></script>
        @yield('js')
    </head>
        <body>
            <header>
                <div class="header-left">
                    <a href="top" id="titleQandAquarium">Q&Aquarium</a>
                    <div class="welcomeQandAquarium">{{session()->get('name','ゲスト')}}様</div>
                    
                    <div id="searchByWord">
                        <form  action="{{ url('/search')}}", method="get">
                            <input id="searchForm" name="searchWord" type="text" placeholder="キーワードで検索" value= "{{ $searchWord ?? '' }}">
                            <input id="searchSendButton" type="submit"value="検索" >
                        </form>
                    </div>
                </div>

                <div class="header-right">
                    <a href="question" class="questionButton">質問する<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                <a class="userProfile" href="profile" data-badge="">プロフィール<span class="glyphicon glyphicon-home" aria-hidden="true"></span></a>
                <input type="hidden"  value="" id="newNumUkezara">
                {{--PC画面の時はマルテンと”新着ボックス”も表示させる--}}
                <div class="balloon3-top" >新着あり</div>
                    
                    <input type="hidden"value="{{session()->get('name','ゲスト')}}">
                    {{--ログインしている時は”ログアウト”を表示させる--}}
                    @if (session()->get('name','ゲスト') != "ゲスト")
                    <a class="logout" href="javascript:void(0);">ログアウト<span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a>
                    @else
                    <a class="loginButton" href="loginPage">ログイン<span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a>    
                    @endif
                </div>

                {{--スマホ用にハンバーガーメニューを作成する--}}
                    <div class="menu-btn">
                    {{-- iタグで囲った部分の文字体がイタリックになる。それだけ --}}
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </div>
                    <div class="menu">
                        <a href="top" id="toTopFromhamburger">トップ</a>
                        <a href="selectedCategoryPageDetail?value=Plant" class="menu__item " id="">水草</a>
                        <a href="selectedCategoryPageDetail?value=Sick" class="menu__item" id="">病気</a>
                        <a href="selectedCategoryPageDetail?value=Start" class="menu__item" id="">立上げ</a>
                        <a href="selectedCategoryPageDetail?value=Wood" class="menu__item" id="">流木</a>
                        <a href="selectedCategoryPageDetail?value=With" class="menu__item" id="">生体</a>
                        <a href="selectedCategoryPageDetail?value=Feed" class="menu__item" id="">エサ</a>
                        <a href="selectedCategoryPageDetail?value=Layout" class="menu__item" id="">レイアウト</a>
                        <a href="selectedCategoryPageDetail?value=Equipment" class="menu__item" id="">設備</a>
                        <a href="selectedCategoryPageDetail?value=Emergency" class="menu__item" id="emergency">緊急</a>
                        <a href="selectedCategoryPageDetail?value=Other" class="menu__item" id="">その他</a>
                        <form  action="{{ url('/search')}}", method="get">
                            <input id="searchFormInSmartPhone" name="searchWord" type="text" placeholder="キーワードで検索" value= "{{ $searchWord ?? '' }}">
                            <input id="searchSendButtomInSmartPhone"  type="submit"value="検索" >
                        </form>
                    </div>
                
            </header>
            {{--画面上部に戻るためのスクロールボタン --}}
            <p id="page-top"><a href="#wrap">⬆︎</a></p>

            @yield('topOfpermanentMainArea')

        <div class="permanentMainArea">
            <!--選択されたカテゴリーのみの質問内容を表示-->
            <div class="containerPerPage">
                <br><br><br>{{--ヘッダーを固定しているために少し下にずらさないと全ての画面が揃わなくなる。--}}
                @yield('containerPerPage')
            </div>    

            <div class="side_bar">
                <br><br><br>{{--ヘッダーを固定しているために少し下にずらさないと全ての画面が揃わなくなる。--}}

                {{--「実装してないならわざわざ示す必要なくない？」という理由で削除 --}}
                {{-- <div class="question_ranking">
                    <div class="sideBarTitle"><h4>質問ランキング</h4></div>
                    <p>ただいま準備中です。</p>
                </div> --}}
                <div class="explainQandAquarium">
                    <div class="sideBarTitle"><h4>Q&Aquariumとは？</h4></div>
                    <p ><span class="explainQandAquariumMarker">アクアリウム専用の質問サイトです。アクアリウムの”Q&A”を皆で作ろう！</span></p>
                </div>

                <div class="category_list_holder">
                    <div class="sideBarTitle"><h4>カテゴリー</h4></div>
                    <div class="categoryList">
                        <a href="selectedCategoryPageDetail?value=Plant" class="oneOfCategory oneOfCategoryLeft" id="">水草</a>
                        <a href="selectedCategoryPageDetail?value=Sick" class="oneOfCategory oneOfCategoryRight" id="">病気</a>
                        <a href="selectedCategoryPageDetail?value=Start" class="oneOfCategory oneOfCategoryLeft" id="oneOfCategoryStart">立上げ</a>
                        <a href="selectedCategoryPageDetail?value=Wood" class="oneOfCategory oneOfCategoryRight" id="">流木</a>
                        <a href="selectedCategoryPageDetail?value=With" class="oneOfCategory oneOfCategoryLeft" id="">生体</a>
                        <a href="selectedCategoryPageDetail?value=Feed" class="oneOfCategory oneOfCategoryRight" id="">エサ</a>
                        <a href="selectedCategoryPageDetail?value=Layout" class="oneOfCategory oneOfCategoryLeft" id="oneOfCategoryLayout">レイアウト</a>
                        <a href="selectedCategoryPageDetail?value=Equipment" class="oneOfCategory oneOfCategoryLeft" id="oneOfCategoryEquipment">設備</a>
                        <a href="selectedCategoryPageDetail?value=Emergency" class="oneOfCategory oneOfCategoryLeft" id="">緊急</a>
                        <a href="selectedCategoryPageDetail?value=Other" class="oneOfCategory oneOfCategoryRight" id="">その他</a>
                    </div>    
                </div>

                {{--準備中のために保留とする
                <div class="tag_list">
                    <div class="sideBarTitle"><h4>タグ一覧</h4></div>
                    <p>ただいま準備中です。</p>
                </div>
                --}}

                <div id="harumakiInformations">
                    <div class="sideBarTitle"><h4>管理者情報</h4></div>
                    
                    <div id="harumakiImgHolder">
                        <div class="harumakiContainer"><img src="picture/harumaki.png" alt="test" id="harumakiImg" class="harumakiTarget"></div>
                        <div class="harumakiInfoMessegeInPC">はるまきです。アクアリウムが大好き！Q&Aquariumをもっと盛り上げたい!コリドラスが好き。</div>
                    </div>
                    
                    <div class="harumakiInfoMessegeInTablet">はるまきです。アクアリウムが大好き！Q&Aquariumをもっと盛り上げたい!コリドラスが好き。</div>
                    
                    <div id="followHarumaki">
                        <ul class="follow-me">
                            <li><a href="https://harumakiii.com/harumaki_blog/" target="_blank" id="toHarumakiBlog">ブログへ</a><li>
                            <li><a href="https://www.youtube.com/channel/UCnGJbaWmcd9SaMs4wmUxbcA" target="_blank" id="youtubeIconPropaty"></a></li>
                            <li><a href="https://github.com/Hamahamajobs?tab=repositories" target="_blank"></a></li>
                            <li><a href="https://twitter.com/harumaki_hama" target="_blank"></a><li>
                        </ul>            
                    </div>
                    <p id="contactHarumaki">問合せ：harumakikk@gmail.com</p>

                </div>
                
                {{--準備中のために保留とする
                <div class="dialyNews">
                    <h4 class="sideBarTitle">日記やニュース</h4>
                    <p>ただいま準備中です。</p>
                </div>
                --}}
                {{--
                <div class="sendOpinion">
                    <div class="sideBarTitle"><h4>今日の豆知識</h4></div>
                    <p>コリドラスは種類が豊富で、現時点で命名されているのは約１６０種も！いまだ発見されていないコリさんも非常に多く存在しているらしいです。</p>
                </div>   
                --}}


                <div class="advertisingLink">
                    <div class="sideBarTitle"><h4>スポンサーリンク</h4></div>
                    <div class="advertisingLinkInPC" style="text-align: center;">
                            <script type="text/javascript">var a8='a19111714348_35SAUP_4HXXBM_2HOM_BUB81';var rankParam='3NCPTmgazGB-LDQTzlBAckBUFGBU64gdTN64TcBV-Of3ROp3z';var bannerType='1';var bannerKind='item.variable.kind1';var vertical='3';var horizontal='1';var alignment='0';var frame='1';var ranking='1';var category='ペット・ペットグッズ';</script><script type="text/javascript" src="//rws.a8.net/rakuten/ranking.js"></script>
                    </div>
                    <div class="advertisingLinkInTablet">
                        <script type="text/javascript">var a8='a19111714348_35SAUP_4HXXBM_2HOM_BUB81';var rankParam='sBoWe8H3M_n.i5DeMQn917nzg_nzKuHkeBKue1nw.IYsvILsM';var bannerType='0';var bannerKind='item.fix.kind6';var frame='1';var ranking='1';var category='ペット・ペットグッズ';</script><script type="text/javascript" src="//rws.a8.net/rakuten/ranking.js"></script>
                    </div>
                </div>

                {{-- フッターとして設定する --}}
                <div class="footerInSmartPhone">
                Copyright © 2020 Q&Aquarium All Rights Reserved.
                </div>

            </div>

        </div>

        <div class="footer">
            @yield('topOfFooter')
            <footer>

            {{--広告挿入--}}
            {{--
            <div class="footerAdvertisingLink">
                <div id="suponser">スポンサーリンク </div>
                <div style="">
                    <script type="text/javascript">var a8='a19111714348_35SAUP_4HXXBM_2HOM_BUB81';var rankParam='XlAtfGZ0okQsj1cfo8QpVBQCikQCTIZNflTIfVQJs5HXz5vXo';var bannerType='0';var bannerKind='item.fix.kind1';var frame='1';var ranking='1';var category='ペット・ペットグッズ';</script><script type="text/javascript" src="//rws.a8.net/rakuten/ranking.js"></script>
                </div>
            </div>
            --}}
            {{--
            <div class="footerAdvertisingLink">
                <div id="suponser">スポンサーリンク </div>
                <div style="">
                    <script type="text/javascript">var a8='a19111714348_35SAUP_4HXXBM_2HOM_BUB81';var rankParam='XlAtfGZ0okQsj1cfo8QpVBQCikQCTIZNflTIfVQJs5HXz5vXo';var bannerType='0';var bannerKind='item.fix.kind1';var frame='1';var ranking='1';var category='ペット・ペットグッズ';</script><script type="text/javascript" src="//rws.a8.net/rakuten/ranking.js"></script>
                </div>
            </div>
            --}}
            

                <div class="footer_list">
                    <textarea class="opinionTextArea footerContents" limit="400" id="opinionContents"placeholder="ご意見をお聞かせ下さい。"></textarea>
                    <button class="sendOpinionBtn" id="postOpinion">送信</button>
                    <span class="opinionCounter"><span id="moji_suu">0</span>/400</span>
                </div>
                {{--なぜがopinion投稿でコントローラー側でニックネームが取得できない。のでinputをクッションにして送る--}}
                <input id="forOpinionInput"type="hidden" value="{{session()->get('name','ゲスト')}}">

                <div class="copyRight">Copyright © 2020 Q&Aquarium All Rights Reserved.</div>
            </footer>
        </div>

        {{--ログアウトした時のポップアップ--}}
        <div class="logoutModal logoutJs-modal">
            <div class="logoutModal__bg logoutJs-modal-close"></div>
            <div class="logoutModal__content">
                <p id="doneLogout">ログアウトしました!またQ&Aquariumを使ってください！</p>
            </div>
        </div>

        {{--意見を送信した時のポップアップ--}}
        <div class="opinionModal opinionJs-modal">
            <div class="opinionModal__bg opinionJs-modal-close"></div>
            <div class="opinionModal__content">
                <h3 id="doneOpinion">ご意見ありがとうございました！</h3>
                <svg viewBox="0 0 3387 1270">
                    <path id="planePath" class="planePath" d="M-226 626c439,4 636,-213 934,-225 755,-31 602,769 1334,658 562,-86 668,-698 266,-908 -401,-210 -893,189 -632,630 260,441 747,121 1051,91 360,-36 889,179 889,179" />
                    <g id="plane">
                    <polygon class="fil1" points="-141,-10 199,0 -198,-72 -188,-61 -171,-57 -184,-57 " />
                    <polygon class="fil2" points="199,0 -141,-10 -163,63 -123,9 " />
                    <polygon class="fil3" points="-95,39 -113,32 -123,9 -163,63 -105,53 -108,45 -87,48 -90,45 -103,41 -94,41 " />
                    <path class="fil4" d="M-87 48l-21 -3 3 8 19 -4 -1 -1zm-26 -16l18 7 -2 -1 32 -7 -29 1 11 -4 -24 -1 -16 -18 10 23zm10 9l13 4 -4 -4 -9 0z" />
                    <polygon class="fil1" points="-83,28 -94,32 -65,31 -97,38 -86,49 -67,70 199,0 -123,9 -107,27 " />
                    </g>
                    <animateMotion xlink:href="#plane" dur="5s" repeatCount="indefinite" rotate="auto">
                    <mpath xlink:href="#planePath" />
                    </animateMotion> 
                </svg>
            </div>
        </div>
    </body>
</html>