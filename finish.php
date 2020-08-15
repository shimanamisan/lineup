<?php

/****************************************
 共通処理読み込み
*****************************************/
require('Library/function.php');

debug('メールを送信しました。');
debug('   ');

if (isset($_POST['top']) && $_POST['top']) {
    header("Location:index.html");
    exit();
}

 // セッション変数の中身を空にする
 $_SESSION = [];
 // セッションを削除
 session_destroy();
 debug('メールを送信したので、セッションを削除しました。finish.php：'. print_r($_SESSION, true));
 debug('   ');


?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://fonts.googleapis.com/css2?family=Libre+Caslon+Text&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="dist/css/style.css" />
    <title>LINEUP BASEBALLCULB | 送信完了</title>
  </head>
  <body>
    <header class="l-header js-scroll-trigger p-rule__header">
      <h1 class="p-header__logo">
        <a href="index.html"
          ><img
            src="./dist/img/LNIEUP.png"
            class="p-header__logo__img js-p-header__logo"
            alt=""
        /></a>
      </h1>
      <div id="js-spmenu-trigger" class="p-header__spmenu">
        <span></span>
        <span></span>
        <span></span>
      </div>
      <nav id="js-nav-trigger" class="p-header p-header__nav">
        <ul class="p-header__list">
          <li class="p-header__item"><a href="team.html">チーム紹介</a></li>
          <li class="p-header__item"><a href="rule.html">チーム規則</a></li>
          <li class="p-header__item"><a href="">スケジュール</a></li>
          <li class="p-header__item"><a href="">お問い合わせ</a></li>
        </ul>
      </nav>
    </header>


    <main class="l-main__contact u-inner">
      <section class="c-table">
        <h2 class="c-title">
          送信完了

          <span class="c-title__sub">- Send Message -</span>
        </h2>
        <form method="post" action="">
         <div>
           <p>お問合せ内容を送信しました。</p>
         </div>
          <div class="c-btn__wrapp">
            <button class="c-btn" type="submit" name="top" value="top">
              トップページへ戻る
            </button>
          </div>
        </form>
      </section>
    </main>
    <footer id="footer" class="l-footer p-footer">
      <p class="p-footer__text">
        Copyright© LINEUP BASEBALLCULB All Rights Reserved.
      </p>
    </footer>
    <script src="./dist/js/bundle.js"></script>
  </body>
</html>
