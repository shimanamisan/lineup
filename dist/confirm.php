<?php

/****************************************
 共通処理読み込み
*****************************************/
require "Library/function.php";

if (empty($_SESSION["transition"])) {
    debug(
        "不正に画面遷移してきました。お問い合わせページへ戻ります。confirm.php "
    );
    debug("   ");
    header("Location:contact.php");
    exit();
}

debug("POSTの中身を確認しています。confirm.php：" . print_r($_POST, true));
debug("   ");

if (isset($_POST["back"]) && $_POST["back"]) {
    debug("前のページへ戻る処理です。confirm.php ");
    debug("   ");
    switch (true) {
        case $_SESSION["mode"] === "member":
            debug("メンバー募集のページへ戻ります。confirm.php ");
            debug("   ");
            unset($_SESSION["csrf_token"]);
            header("Location:member.php");
            exit();
            break;
        case $_SESSION["mode"] === "contact":
            debug("お問い合わせページへ戻ります。confirm.php ");
            debug("   ");
            unset($_SESSION["csrf_token"]);
            header("Location:contact.php");
            exit();
            break;
        default:
            debug("エラーが発生しました。トップページへ戻ります。confirm.php ");
            debug("   ");
            unset($_SESSION["csrf_token"]);
            header("Location:index.php");
            exit();
    }
}

// セッションに値が入っていたら処理を行う
if (isset($_SESSION)) {
    debug(
        "お問いわせ内容がSESSIONに格納されています。confirm.php " .
            print_r($_SESSION, true)
    );
    debug("   ");

    if ($_SESSION["mode"] === "member") {
        // セッションの値を配列に格納
        $confirm_content = [
            "お名前" => $_SESSION["name"],
            "メールアドレス" => $_SESSION["email"],
            "希望ポジション" => $_SESSION["position"],
            "その他" => $_SESSION["contact"],
        ];
    } elseif ($_SESSION["mode"] === "contact") {
        // セッションの値を配列に格納
        $confirm_content = [
            "お名前" => $_SESSION["name"],
            "メールアドレス" => $_SESSION["email"],
            "お問い合わせ内容" => $_SESSION["contact"],
        ];
    }

    // トークンがSESSIONにセットされていなければセットする
    if (!isset($_SESSION["csrf_token"])) {
        // CSRF対策用のトークン
        $_SESSION["csrf_token"] = bin2hex(random_bytes(32));
    }

    // isset($_POST['send'])で'send'というキーが存在しているかを判定し、存在していれば$_POST['send']の値をチェックする
    // $_POST['send']だけだと、POST送信した際にキーが存在していなかった場合にNoticeエラーになる
    if (isset($_POST["send"]) && $_POST["send"]) {
        debug(
            'isset($_POST[send]) の判定を見ています。confirm.php ' .
                isset($_POST["send"])
        );
        debug("   ");
        debug(
            "メールを送信する処理です。次の画面へ遷移します。confirm.php " .
                print_r($_POST, true)
        );
        debug("   ");
        header("Location:finish.php");
        exit();
    }
} else {
    debug("セッションが空だったので前のページへ戻ります。。confirm.php ");
    debug("   ");
    header("Location:contact.php");
    exit();
}
?>

<?php
$siteTitle = "お問い合わせ内容確認";
// メタタグなど読み込み
require "head.php";

// bodyタグからheaderを読み込み
require "header.php";
?>

    <main class="l-main__contact u-inner">
      <section class="c-table">
        <h2 class="c-title">
          お問い合わせ内容確認

          <span class="c-title__sub">- Confirm -</span>
        </h2>
        <form method="post" action="./finish.php">
          <input type="hidden" name="csrf_token" value="<?php echo sanitize(
              $_SESSION["csrf_token"]
          ); ?>">
          <table class="c-table c-table__table p-contact__table">
            <tbody>
              <?php foreach ($confirm_content as $key => $val): ?>
                <tr>
                  <th>
                    <p class="c-form__index"><?php echo sanitize($key); ?></p>
                  </th>
                  <td>
                  <p><?php echo sanitize($val); ?></p>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          <div class="c-btn__wrapp">
            <button class="c-btn c-btn__confirm" type="submit" name="send" value="send">
              送信する
            </button>
            </form>
            <form method="post" action="">
                <button class="c-btn c-btn__confirm__back" type="submit" name="back" value="back">
                内容を修正する
                </button>
            </form>
          </div>
       
       
        
      </section>
    </main>
    
    <?php // フッターを読み込み
// フッターを読み込み
?>require "footer.php";
?>
