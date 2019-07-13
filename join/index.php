<?php
session_start();
if (!empty($_POST)) {
  //ここでPOSTが空でないときに以下を確認（フォームは送信されている）
  if ($_POST['name'] == '') {
    $error['name'] = 'blank';
  }
  if ($_POST['email'] == '') {
  //↑（）の打ち間違いでかなりタイムロス。以後要注意
    $error['email'] = 'blank';
  }
  if (strlen($_POST['password']) < 4 ) {
  //string + length = strlen
    $error['password'] = 'length';
  }
  if ($_POST['password'] == '') {
    $error['password'] = 'blank';
  }

  if (empty($error)) {
  //$error配列が空ならセッションに値を保存
    $_SESSION['join'] = $_POST;
    header('Location: check.php');
    exit();
  }
}
?>



<p>次のフォームに必須事項をご記入ください</p>
<form action="index.php" method="post" enctype="multipart/form-data">
  <dl>
    <dt>ニックネーム<span class="required">必須</span></dt>
    <dd>
      <input type="text" name="name" size="35" maxlength="255" value="<?php echo htmlspecialchars($_POST['name'], ENT_QUOTES); ?>"/>
     <!--  htmlspecialchars...セキュリティ対策。ユーザー入力の際は記述すべし。  -->
      <?php if($error['name'] == 'blank'): ?>
      <p class="error">* ニックネームを入力してください</p>
      <?php endif; ?>
    </dd>
    <dt>メールアドレス<span class="required">必須</span></dt>
    <dd><input type="text" name="email" size="35" maxlength="255" value = "<?php echo htmlspecialchars($_POST['email'], ENT_QUOTES) ?>" />
      <?php if($error['email'] == 'blank'): ?>
      <p class="error">* メールアドレスを入力してください</p>
      <?php endif; ?>
    </dd>
    <dt>パスワード<span class="required">必須</span></dt>
    <dd><input type="text" name="password" size="10" maxlength="20" value="<?php echo htmlspecialchars($_POST['password'], ENT_QUOTES) ?>"/>
      <?php if($_POST['password'] =='blank'): ?>
      <p class="error">* パスワードを入力してください</p>
      <?php endif; ?>
      <?php if($error['password'] == 'length'): ?>
      <p class="error">* パスワードは4文字以上で入力してください</p>
      <?php endif; ?>
    </dd>
    <dt>写真など</dt>
    <dd><input type="file" name="image" size="35" /></dd>
  </dl>
  <div><input type="submit" value="入力内容を確認する" /></div>

</form>
