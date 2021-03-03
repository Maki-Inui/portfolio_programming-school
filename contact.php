<?php 
  session_start();
  $mode=!empty($_POST["mode"])?$_POST["mode"]:"";

  $name = "";
  $kana = "";
  $tel = "";
  $mail = "";
  $purpose = "";
  $contents = "";
  $error = "";
  $error_name = "";
  $error_kana = "";
  $error_tel = "";
  $error_mail = "";
  $error_purpose = "";
  $error_contents = "";
 
if ($mode) {
    if (empty($_SESSION['token']) || $_SESSION['token'] != $_POST['token']) {
        die('不正な遷移です。');
    }

    if (empty($_POST['name'])) {
        $error_name = "※お名前を入力してください！\n";
    } else {
        $name = htmlspecialchars($_POST['name']);
    }

    if (empty($_POST['kana'])) {
        $error_kana = "※フリガナを入力してください！\n";
    } else {
        $kana = htmlspecialchars($_POST['kana']);
    }

    if (empty($_POST['tel'])) {
        $error_tel = "※電話番号を入力してください！\n";
    } else {
        $tel = htmlspecialchars($_POST['tel']);
    }

    if (empty($_POST['mail'])) {
        $error_mail = "※メールアドレスを入力してください！\n";
    } else {
        $mail = htmlspecialchars($_POST['mail']);
    }

    if (empty($_POST['purpose'])) {
        $error_purpose = "※お問い合わせ目的を選択して下さい\n";
    } else {
        $purpose = htmlspecialchars($_POST['purpose']);
    }
 
    if (empty($_POST['contents'])) {
        $error_contents = "※お問い合わせ内容を入力してください！\n";
    } else {
        $contents = htmlspecialchars($_POST['contents']);
    }
 
    if ($error_name  || $error_kana || $error_mail || $error_tel|| $error_purpose || $error_contents) {
        $mode = 'input';
    }
 
    if ($mode == 'submit') {
        session_destroy();
 
        $to = 'mqkichim@yahoo.co.jp';
        $subject = 'お問合せがありました';
        $message = 'お名前：' . $name . "\n"
                . 'ふりがな：' . $kana . "\n"
                . 'メールアドレス：' . $mail . "\n"
                . '本文：' . $contents . "\n";
        $header = 'From: sendonly@example.com';
        $result = mb_send_mail($to, $subject, $message, $header);
 
        if ($result) {
            header('Location: http://localhost/TECH%20FUN/thanks.html');
            exit;
        } else {
            $mode = 'error';
            $error = 'メール送信に失敗しました';
        }
    }
} else {
    $mode = 'input';
    $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(16));
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TECH FUN　お問い合わせフォーム</title>
  <link rel="stylesheet" href="styles.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
</head>
 

<body>


  <!-- mainここから -->
  <main >

    <div class="form-p-wrapper">

    <div class="container">

    <?php if ($mode == 'input'): ?>

      <form action="contact.php" method="post">
      <input type="hidden" name="mode" value="confirm">
      <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">

        <dl>
          <?php if ($error_name): ?><p><em><?php echo $error_name; ?></em></p><?php endif; ?>
          <dt><label for="name">お名前<span>必須</span></label></dt>
          <dd><input type="text" name="name" id="name" placeholder="お名前" value="<?php echo $name; ?>"></dd>

          <?php if ($error_kana): ?><p><em><?php echo $error_kana; ?></em></p><?php endif; ?>
          <dt><label for="kana">ふりがな<span>必須</span></label></dt>
          <dd><input type="text" name="kana" id="kana" placeholder="ふりがな" value="<?php echo $kana; ?>"></dd>

          <?php if ($error_tel): ?><p><em><?php echo $error_tel; ?></em></p><?php endif; ?>
          <dt><label for="tel">電話番号<span>必須</span></label></dt>
          <dd><input type="number" name="tel" id="tel" placeholder="電話番号" value="<?php echo $tel; ?>"></dd>

          <?php if ($error_mail): ?><p><em><?php echo $error_mail; ?></em></p><?php endif; ?>
          <dt><label for="mail">メールアドレス<span>必須</span></label></dt>
          <dd><input type="text" name="mail" id="mail" placeholder="メールアドレス"　value="<?php echo $mail; ?>"></dd>

          <dt>お問い合わせ目的</dt>
          <dd>
            <input type="checkbox" name="purpose" value="見学希望" id="visit">
            <label for="visit">教室見学を希望する</label>

            <input type="checkbox" name="purpose" value="ご質問" id="question">
            <label for="question">ご質問</label>

            <input type="checkbox" name="purpose" value="メディア取材" id="media-interview">
            <label for="media-interview">メディア取材</label>

            <input type="checkbox" name="purpose"　value="その他要望など" id="other">
            <label for="other">その他</label>

          </dd>

          <!-- <dd>
            <select name="purpose" id="">
              <option value="教室見学">教室見学</option>
              <option value="ご質問">ご質問</option>
              <option value="メディア取材">メディア取材</option>
              <option value="その他">その他</option>
            </select>
          </dd> -->

          <?php if ($error_contents): ?><p><em><?php echo $error_contents; ?></em></p><?php endif; ?>
          <dt><label for="contents">お問い合わせの内容<span>必須</span></label></dt>
          <dd><textarea name="contents" placeholder="ここにメッセージを入力してください"　id="contents" <?php echo $contents; ?>></textarea>
          </dd>

          <input type="submit" value="確認画面へ" id="submit_button">
        </dl>

        
      </form>

      <?php elseif ($mode == 'confirm'): ?>
        
      <div class="confirm-txt">
        <dl>
          <dt>お名前：</dt>
          <dd><p><?php echo $name; ?>様</p></dd>

          <dt>メールアドレス：</dt>
          <dd><p><?php echo $mail; ?></p></dd>

          <dt>お問い合わせ目的：</dt>
          <dd><p><?php echo $purpose; ?></p></dd>

          <dt>お問い合わせ内容：</dt>
          <dd><p><?php echo nl2br($contents); ?></p></dd>
        </dl>
      </div>

      <form action="contact.php" method="post">
        <input type="hidden" name="mode" value="submit">
        <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
        <input type="hidden" name="name" value="<?php echo $name; ?>">
        <input type="hidden" name="kana" value="<?php echo $kana; ?>">
        <input type="hidden" name="tel" value="<?php echo $tel; ?>">
        <input type="hidden" name="mail" value="<?php echo $mail; ?>">
        <input type="hidden" name="purpose" value="<?php echo $purpose; ?>">
        <input type="hidden" name="contents" value="<?php echo $contents; ?>">
        <p><button type="submit" id="submit_button">送信</button></p>
    </form>
 
    <form action="contact.php" method="post">
        <input type="hidden" name="mode" value="input">
        <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
        <input type="hidden" name="name" value="<?php echo $name; ?>">
        <input type="hidden" name="kana" value="<?php echo $kana; ?>">
        <input type="hidden" name="tel" value="<?php echo $tel; ?>">
        <input type="hidden" name="mail" value="<?php echo $mail; ?>">
        <input type="hidden" name="purpose" value="<?php echo $purpose; ?>">
        <input type="hidden" name="contents" value="<?php echo $contents; ?>">
        <p><button type="submit" id="submit_button">戻る</button></p>
    </form>

    </div>
  </div>

    <?php else: ?>
 
    <p>エラーが発生しました。</p>
    <?php if ($error): ?><p><em><?php echo $error; ?></em></p><?php endif; ?>

    <?php endif; ?>
    
  </main>
  <!-- mainここまで -->

  <!-- footerここから -->
  <footer>

    <a href="#Top-page" class="footer-logo">
      <img src="images/top.png">
    </a>

    <div class="footer-container">
      <div class="footer-left">
        <nav>
          <ul>
            <li><a href="#">サイトマップ</a></li>
            <li><a href="#">プライバシーポリシー</a></li>
            <li><a href="#">運営会社</a></li>
          </ul>
        </nav>

      </div>
      <div class="footer-right">
        <p>@TECH FUN educational institute</p>
      </div>
    </div>
  </footer>
  <!-- footerここまで -->
</body>

</html>
