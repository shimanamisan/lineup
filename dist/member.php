<?php

/****************************************
 共通処理読み込み
*****************************************/
require('Library/function.php');

getIP();

// ページ宣言
$mode = 'member';

if (isset($_SESSION['mode']) && $_SESSION['mode'] !== $mode) {
    $_SESSION = []; // セッションをする前に空にする
    session_destroy(); // この時点ではセッションは削除されない
    debug('お問い合わせページから遷移してきました。セッションの値を削除します。member.php' . print_r($_SESSION, true));
    debug('   ');
}

// セレクトボックスの内容を生成
$selectBox = [
  '1' => 'ピッチャー',
  '2' => 'キャッチャー',
  '3' => 'ファースト',
  '4' => 'セカンド',
  '5' => 'サード',
  '6' => 'ショート',
  '8' => 'レフト',
  '9' => 'センター',
  '10' => 'ライト',
  '11' => 'マネージャー',
];

// POST内容の確認
debug('POST内容の確認をしています。member.php ' . print_r($_POST, true));
debug('   ');

// POST送信されていた場合
if (!empty($_POST)) {
    debug('POST送信されている処理です。member.php');
    debug('   ');
    // POST時の値をフォームに表示させるので、確認画面から戻ってきた場合に
    // SESSIONの値を表示させているものをクリアする
    clearSession('name');
    clearSession('email');
    clearSession('contact');
    clearSession('position');

    // 変数にフォームの値を格納
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $position = $_POST['position'];

    // 入力必須
    validRequire($name, 'name');
    validRequire($email, 'email');
    validRequire($contact, 'contact');
    validRequire($position, 'position');

    // バリデーションエラーが無い場合
    if (empty($err_msg)) {
        debug('未入力バリデーションが通った時の処理です。member.php');
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
            debug('バリデーションOKの時の処理です。member.php');
            debug('   ');
    
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            $_SESSION['contact'] = $contact;
            $_SESSION['position'] = $position;
            $_SESSION['transition'] = true;
            $_SESSION['mode'] = $mode;

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
          メンバー募集
          <span class="c-title__sub">- Member -</span>
        </h2>

          <table class="c-table c-table__table">
          <tbody>
            <tr>
              <th>
                <p>活動地区</p>
              </th>
              <td>
                <p>大阪府、大阪市内中心</p>
              </td>
            </tr>
            <tr>
              <th>
                <p>募集ポジション</p>
              </th>
              <td>
                <p>
                指定なし、応相談（マネージャーも募集中です）
                </p>
              </td>
            </tr>
            <tr>
              <th>
                <p>主な活動日</p>
              </th>
              <td>
                <p>
                  土曜日
                </p>
              </td>
            </tr>
            <tr>
              <th>
                <p>活動頻度</p>
              </th>
              <td>
                <p>週1回</p>
              </td>
            </tr>
            <tr>
              <th>
                <p>年齢制限</p>
              </th>
              <td>
                <p>18歳～</p>
              </td>
            </tr>
            <tr>
              <th>
                <p>募集人数</p>
              </th>
              <td>
                <p>
                  1名
                </p>
              </td>
            </tr>
            <tr>
              <th>
                <p>活動日</p>
              </th>
              <td>
                <p>
                  毎週土曜日
                </p>
              </td>
            </tr>
            <tr>
              <th>
                <p>その他コメント</p>
              </th>
              <td>
                <p class="p-member__text">
                【体験参加大歓迎！助っ人からもOKです！】
                </p>
                <p class="p-member__text">
                はじめまして！
                LINEUP代表の和田と申します。
                </p>
                <p>
                当チームではメンバー、マネージャー（男女問わず）を募集しております。
                </p>
<p>
活動は毎週行っており、ポジションは当日参加するメンバーによって決める為、複数ポジションを守って頂くことになります。
</p>
<p>
※チーム事情として捕手が足りておりません。
</p>
<ul>
<li>■20代歓迎。</li>
<li>■性格重視で社会性がある方。</li>
<li>■野球が上手くなりたいという向上心のある方。</li>
</ul>
<p>
チーム結成は2005年。インターネットを通じてメンバーを募集し続け、現在に至ります。
</p>
<p>
長年の目標であったGBNドーム決勝戦(ナゴヤドーム)、SKYCUPドーム決勝戦(京セラドーム)に行き、敗れはしましたが、最高の思い出となりました！
</p>
<p>
またその試合でも、未経験者のメンバーが試合に出場し、本人の努力もありますが、うちのチームらしいなと実感することが出来ました。
</p>
<p>
当チームの特徴は経験者と未経験者の融合チームです。
しかし、全員が競争意識を持ち、常に向上心溢れるチーム作りを目指しています。
</p>
<p>
そして、野球だけではなく、社会人としてのマナーも気を配り、対戦相手様とも野球を楽しめるチームを目指しています。
</p>
<p>
草野球チームらしく、メンバーと仲良く過ごし、少しでも有意義な休日にするとともに、チーム運営も協力しながら行っています。
</p>
<p>
ご興味があるかたは是非お気軽にご連絡下さい♪
</p>
<ul>
<li>■2004年結成。</li>
<li>■在籍メンバー15名。</li>
<li>※正メンバー12名。準メンバー3名。記録員1名。</li>
<li>■最年少25歳～最年長52歳で平均年齢33歳です。20代メンバーは3名となっております。</li>
<li>■参加大会はGBNとSKYCUP。年間通してリバーサイドリーグへ参戦しています。</li>
<li>■活動日は毎週土曜日。基本は波除運動場での活動になり、あとは対戦相手様との兼ね合いで遠征に出ることもあります。</li>
<li>■ユニフォーム購入代13,000円。会費年間12,000円(スポーツ保険料込み)。</li>
<li>参加日球場代＋審判代折半200～500円程度。</li>
<li>■公式戦、リーグ戦での活動がメインの為、派遣審判をお願いして試合することが多いです。</li>
</ul>
              </td>
            </tr>
          </tbody>
        </table>
        <h3 class="p-member__title">
          応募フォーム
        </h3>

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
                  <p class="c-form__index">希望ポジション</p>
                </th>
                <td>
                <div class="c-form__selectbox__wrapp">
                <span class="c-form__selectbox__icon"></span>
                    <select class="c-form__input c-form__selectbox
                    <?php
                    if (!empty($err_msg['position'])) {
                        echo 'c-error';
                    }?> 
                    " name="position" id="">
                      <option value="">選択してください</option>
                      <?php foreach ($selectBox as $key => $val):?>
                        <option value="<?php echo $val ?>" <?php if ($key === getFormData($key)) {
                        echo 'selected' ;
                    }?>><?php echo $val?></option>
                      <?php endforeach;?>
                    </select>
                </div>
                  <div class="c-error__msg">
                  <?php
                    if (!empty($err_msg['position'])) {
                        echo sanitize('選択項目は') . $err_msg['position'];
                    }
                    ?>
                  </div>
                </td>
              </tr>
              <tr>
                <th>
                  <span class="c-form__require">必須</span>
                  <p class="c-form__index">その他</p>
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
