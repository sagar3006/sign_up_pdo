<?php

require __DIR__ . '/library.php';
$app = new Library;

if(isset($_GET['email'])) {
	if ($app->isEmail($_GET['email']))
		echo 'invalid';
	else
		echo 'valid';
}

if(isset($_GET['username'])) {
	if ($app->isUsername($_GET['username']))
		echo 'invalid';
	else
		echo 'valid';
}

?>