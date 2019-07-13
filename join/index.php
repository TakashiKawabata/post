<?php
session_start(); //

if (!empty($_POST)){ //ここでPOSTが空でないときに以下を確認（フォームは送信されている）
  if($_POST['name']==''){
    $error['name']='blank';
  }
  if($_POST)['email']==''{
    $error['email']='blank';
  }
  if(strlen($_POST['password'])<4){ //string + length = strlen
    $error['password']='length';
  }
  if($_POST['password']==''){
    $error['password']='blank';
  }

  if(empty($error)){ //$error配列が空ならセッションに値を保存
    $_SESSION['join']=$_POST;
    header('Location: check.php');
    exit();
  }
}
?>



<p>次のフォームに必須事項をご記入ください</p>
<form action="index.php" method="post" enctype="multipart/form-data">
  <dl>
    <dt>ニックネーム<span class="required">必須</span></dt>
    <dd><input type="text" name="name" size="35" maxlength="255" /></dd>
    <dt>メールアドレス<span class="required">必須</span></dt>
    <dd><input type="text" name="email" size="35" maxlength="255" /></dd>
    <dt>パスワード<span class="required">必須</span></dt>
    <dd><input type="text" name="password" size="10" maxlength="20" /></dd>
    <dt>写真など</dt>
    <dd><input type="file" name="image" size="35" /></dd>
  </dl>
  <div><input type="submit" value="入力内容を確認する" /></div>

</form>
