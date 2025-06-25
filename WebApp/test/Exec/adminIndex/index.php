<?php

//index.

//echo(Token::uidOriginal("id"));

require_once(tyPath."Form.php");
require_once(tyPath."Login.php");
require_once(tyPath."Value.php");

if (Form::mode("login")) {
	if (Form::check($_POST['token'])) {
		//
		$error = Value::set($_POST['email'])->deleter("trim")->close();
		$email = $error["SYSTEM"]["value"];
		
		$error = Value::set($_POST['password'])->deleter("trim")->close();
		$password = $error["SYSTEM"]["value"];
		
		//
		if ($email === "kubohisa@gmail.com"
			&& $password === "password") {
				Login::start($_POST['email']);
				Login::move("./menu");
				exit;
		}
	}
}

$token = Form::start();

echo <<<EOF
<br />
<form method="POST" action="./">
  <input type="hidden" name="mode" value="login">
  <input type="hidden" name="token" value="{$token}">
  <p>メールアドレス：<input type="text" name="email"></p>
  <p>password：<input type="password" name="password"></p>
  <p><input type="submit" value="送信する">
  <input type="reset" value="取消する"></p>
</form>
EOF;