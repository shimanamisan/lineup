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
    header("Location:index.php");
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
    session_destroy();
    header("Location:contact.php");
}

// セッションのユーザー情報を格納
if ($_SESSION['mode'] === 'member') {
    /****************************************
 メンバー募集から遷移してきた時の処理
*****************************************/
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $position = $_SESSION['position'];
    $contact = $_SESSION['contact'];

    $from = 'team.info@lineupbaseballclub.com';
    $to = $email;
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

【 希望ポジシヨン 】 
{$position}

【 その他 】 
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

【 希望ポジシヨン 】 
{$position}

【 その他 】 
{$contact}
===================================================

ユーザーへ返信してください。
EOT;
} elseif ($_SESSION['mode'] === 'contact') {
    /****************************************
 お問い合わせページから遷移して来た時の処理
*****************************************/
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $contact = $_SESSION['contact'];

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
}


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

<?php
$siteTitle = '送信完了';
// メタタグなど読み込み
require('head.php');

// bodyタグからheaderを読み込み
require('header.php');

?>


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

    <?php
// フッターを読み込み
require("footer.php");
?>