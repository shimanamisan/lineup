<?php

/****************************************
 共通処理読み込み
*****************************************/
require('Library/function.php');

if (empty($_SESSION['transition'])) {
    debug('不正に画面遷移してきました。お問い合わせページへ戻ります。confirm.php ');
    debug('   ');
    header("Location:contact.php");
    exit();
}

debug('POSTの中身を確認しています。confirm.php：' . print_r($_POST, true));
debug('   ');

if (!empty($_SESSION)) {
    debug('お問いわせ内容がSESSIONに格納されています。confirm.php ');
    debug('   ');

    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $contact = $_SESSION['contact'];

    // トークンがSESSIONにセットされていなければセットする
    if (!isset($_SESSION['csrf_token'])) {
        // CSRF対策用のトークン
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    
    // isset($_POST['send'])で'send'というキーが存在しているかを判定し、存在していれば$_POST['send']の値をチェックする
    // $_POST['send']だけだと、POST送信した際にキーが存在していなかった場合にNoticeエラーになる
    if (isset($_POST['send']) && $_POST['send']) {
        debug('isset($_POST[send]) の判定を見ています。confirm.php ' . isset($_POST['send']));
        debug('   ');
        debug('メールを送信する処理です。次の画面へ遷移します。confirm.php ' . print_r($_POST, true));
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
        <form method="post" action="./finish.php">
          <input type="hidden" name="csrf_token" value="<?php echo sanitize($_SESSION['csrf_token']);?>">
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
            <button class="c-btn c-btn__confirm" type="submit" name="send" value="send">
              送信する
            </button>
            <input class="c-btn c-btn__confirm__back" type="button" value="内容を修正する" onclick="history.back(-1)">
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
