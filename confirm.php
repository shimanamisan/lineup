<?php

/****************************************
 共通処理読み込み
*****************************************/
require('Library/function.php');

debug('POSTの中身' . print_r($_POST, true));
debug('   ');

// POST送信で戻る処理だった場合
// isset($_POST['back'])で'back'というキーが存在しているかを判定し、存在していれば$_POST['back']の値をチェックする
// $_POST['back']だけだと、POST送信した際にキーが存在していなかった場合にNoticeエラーになる
if (isset($_POST['back']) && $_POST['back']) {
    debug('入力画面へ戻ります。confirm.php：'. print_r($_SESSION, true));
    debug('   ');
    header("Location:contact.php");
    exit();
}

if (!empty($_SESSION)) {
    debug('お問いわせ内容がSESSIONに格納されています。');
    debug('   ');

    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $contact = $_SESSION['contact'];

    if (isset($_POST['send']) && $_POST['send']) {
        debug('メールを送信する処理です。');
        debug('   ');
        header("Location:finish.php");
        exit();
    }
}

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
    <title>LINEUP BASEBALLCULB | 確認画面</title>
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
          お問い合わせ内容確認

          <span class="c-title__sub">- Confirm -</span>
        </h2>
        <form method="post" action="">
          <table class="c-table c-table__table p-contact__table">
            <tbody>
              <tr>
                <th>
        
                  <p class="c-form__index">お名前</p>
                </th>
                <td>
                 <p><?php echo sanitize($name); ?></p>
                </td>
              </tr>
              <tr>
                <th>
                  <p class="c-form__index">メールアドレス</p>
                </th>
                <td>
                  <p><?php echo sanitize($email); ?></p>
                </td>
              </tr>
              <tr>
                <th>
                  <p class="c-form__index">お問い合わせ内容</p>
                </th>
                <td>
                  <p><?php echo sanitize($contact); ?></p>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="c-btn__wrapp">
            <button class="c-btn" type="submit" name="send" value="send">
              送信する
            </button>
            <button class="c-btn" type="submit" name="back" value="back">
              内容を修正する
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
