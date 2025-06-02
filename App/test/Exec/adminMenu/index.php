<?php

//index.

//echo(Token::uidOriginal("id"));

require_once(tyPath."Login.php");

$id = Login::check();

echo <<<EOF
Menu:{$id}:
EOF;
