<?php

/****************************************
 共通処理読み込み
*****************************************/
require('Library/function.php');

debug('POSTの中身を確認しています。finish.php：'. print_r($_POST, true));
debug('   ');
debug('セッションの中身を確認しています。finish.php：'. print_r($_SESSION, true));
debug('   ');

if (isset($_POST['top']) && $_POST['top']) {
    header("Location:index.html");
    exit();
}

if (empty($_SESSION['transition'])) {
    debug('不正に画面遷移してきました。お問い合わせページへ戻ります。finish.php ');
    debug('   ');
    header("Location:contact.php");
    exit();
}

if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    debug('トークンが一致していません。お問い合わせページへ戻ります。finish.php ');
    debug('   ');
    $_SESSION = [];
    header("Location:contact.php");
}

// セッションのユーザー情報を格納
$name = $_SESSION['name'];
$email = $_SESSION['email'];
$contact = $_SESSION['contact'];

/****************************************
 問い合わせユーザーへ返信する内容
*****************************************/
$from = 'team.info@lineupbaseballclub.com';
$to = $_SESSION['email'];
$subject = 'お問い合わせ内容を受け付けました。';
$comment = <<<EOT
{$name}　様

お問い合わせありがとうございます。
以下のお問合せ内容を、メールにて確認させて頂きました。

===================================================
【 お名前 】 
{$name}

【 メールアドレス 】 
{$email}

【 お問い合わせ内容 】 
{$contact}
===================================================

内容を確認の上、回答させて頂きます。
しばらくお待ちください。


━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
　※本メールにご返信いただいてもお答えできませんのでご了承ください。
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
Copyright (C) LINEUP BASEBALLCULB, All Rights Reserved.
EOT;

/****************************************
 管理者へ通知する内容
*****************************************/
$toAdmin = 'team.info@lineupbaseballclub.com';
$subjectAdmin = 'メッセージを受信しました｜lineupbaseballclub.com';
$commentAdmin = <<<EOT

ウェブサイトより下記のお問い合わせが有りました。

===================================================
【 お名前 】 
{$name}

【 メールアドレス 】 
{$email}

【 お問い合わせ内容 】 
{$contact}
===================================================

ユーザーへ返信してください。
EOT;

// 問い合わせたユーザーへ送信
sendMail($from, $to, $subject, $comment);

// 管理者へ送信
sendMailAdmin($toAdmin, $subjectAdmin, $commentAdmin);

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
         <div class="c-form__send">
           <p class="c-form__send__text">お問合せ内容を送信しました。</p>
           <p class="c-form__send__text__sub">自動にトップページへ戻らない場合は、トップページへ戻るボタンをクリックしてください。</p>
         </div>
          <div class="c-btn__wrapp">
            <button class="c-btn" type="submit" name="top" value="top" id="js-top-redirect">
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