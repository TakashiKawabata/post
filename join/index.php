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
  $fileName = $_FILES['image']['name'];
  if (!empty($fileName)){
    $ext = substr($fileName, -3);
    //substr...文字列から一部分だけを切り取る。ここでは「-3」で「後ろから3文字目」を切り取る
    //ここでは'jpg'や'gif'が該当するように設定
    if ($ext != 'jpg' && $ext != 'gif'){
      $error['image'] = 'type';
      //拡張子が'jpg'と'gif'でない場合にエラーメッセージが出るように設定
    }
  }

  if (empty($error)) {
  //$error配列が空ならセッションに値を保存
    $image = date('YmdHis') . $_FILES['image']['name'];
    //ファイル名は被らないように時間を使用
    move_uploaded_file($_FILES['image']['tmp_name'], '../member_picture/' . $image);
    //move_updated_file...アップロードされたファイルを新しい位置へ移動
    $_SESSION['join'] = $_POST;
    $_SESSION['join']['image'] = $image;
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
    <dd><input type="file" name="image" size="35" />
    <?php if($error['image'] == 'type'): ?>
    <p class="error">* 写真は「.jpg」か「.gif」を指定してください</p>
    <?php endif; ?>
    <?php if (!empty($error)): ?>
    <p class="error">* 画像を改めて指定してください</p>
    <?php endif; ?>
    </dd>
  </dl>
  <div><input type="submit" value="入力内容を確認する" /></div>

</form>
