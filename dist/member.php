<?php

/****************************************
 共通処理読み込み
*****************************************/
require('Library/function.php');

getIP();

// POST送信されていた場合
if (!empty($_POST)) {
    debug('POST送信されている処理です。');
    debug('   ');
    // POST時の値をフォームに表示させるので、確認画面から戻ってきた場合に
    // SESSIONの値を表示させているものをクリアする
    clearSession('name');
    clearSession('email');
    clearSession('contact');

    // 変数にフォームの値を格納
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];

    // 入力必須
    validRequire($name, 'name');
    validRequire($email, 'email');
    validRequire($contact, 'contact');

    // バリデーションエラーが無い場合
    if (empty($err_msg)) {
        debug('未入力バリデーションが通った時の処理です。');
        debug('   ');

        // Email形式チェック
        validEmail($email, 'email');
        // 名前が全角かチェック
        validNameText($name, 'name');

        // 各フォーム文字数チェック
        validMaxLen($name, 'name', 50);
        validMaxLen($email, 'email');
        validContactMaxLen($contact, 'contact');

        if (empty($err_msg)) {
            debug('バリデーションOKの時の処理です。');
            debug('   ');
    
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            $_SESSION['contact'] = $contact;
            $_SESSION['transition'] = true;

            header("Location:confirm.php");
            exit();
        }
    }
}

?>

<?php
$siteTitle = 'メンバー募集';
// メタタグなど読み込み
require('head.php');

// bodyタグからheaderを読み込み
require('header.php');

?>


    <main class="l-main__contact u-inner">
      <section class="c-table">
        <h2 class="c-title">
          お問い合わせ

          <span class="c-title__sub">- Contact -</span>
        </h2>
        <form method="post" action="">
          <table class="c-table c-table__table p-contact__table">
            <tbody>
              <tr>
                <th>
                  <span class="c-form__require">必須</span>
                  <p class="c-form__index">お名前</p>
                </th>
                <td>
                  <input
                    type="text"
                    name="name"
                    class="c-form__input 
                    <?php
                    if (!empty($err_msg['name'])) {
                        echo 'c-error';
                    }
                    ?>"
                    placeholder="お名前"
                    value="<?php echo getFormData('name');?>"
                  />
                  <div class="c-error__msg">
                  <?php
                    if (!empty($err_msg['name'])) {
                        echo sanitize('お名前は') . $err_msg['name'];
                    }
                    ?>
                  </div>
                </td>
              </tr>
              <tr>
                <th>
                  <span class="c-form__require">必須</span>
                  <p class="c-form__index">メールアドレス</p>
                </th>
                <td>
                  <input
                    type="text"
                    name="email"
                    class="c-form__input <?php if (!empty($err_msg['email'])) {
                        echo 'c-error';
                    } ?>"
                    placeholder="メールアドレス"
                    value="<?php echo getFormData('email');?>"
                  />
                  <div class="c-error__msg">
                  <?php
                    if (!empty($err_msg['email'])) {
                        echo sanitize('メールアドレスは') . $err_msg['email'];
                    }
                    ?>
                  </div>
                </td>
              </tr>
              <tr>
                <th>
                  <span class="c-form__require">必須</span>
                  <p class="c-form__index">お問い合わせ内容</p>
                </th>
                <td>
                  <textarea
                    type="text"
                    name="contact"
                    class="c-form__textarea <?php if (!empty($err_msg['contact'])) {
                        echo 'c-error';
                    } ?>"
                    cols="40"
                    rows="10"
                    placeholder="お問い合わせ内容"
                  ><?php echo getFormData('contact');?></textarea>
                  <div class="c-error__msg c-error__text--contact">
                  <?php
                    if (!empty($err_msg['contact'])) {
                        echo sanitize('お問い合わせ内容は') . $err_msg['contact'];
                    }
                    ?>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="c-btn__wrapp">
            <button class="c-btn" type="submit" name="send">
              内容を確認する
            </button>
          </div>
        </form>
      </section>
    </main>

    <?php
// フッターを読み込み
require("footer.php");
?>
