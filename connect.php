<?php

$user = 'root';
$pass = '';
$db = 'myDB';

$db = new mysqli('localhost', $user, $pass, $db) or die("Unable to Connect!");

echo "Great work!!";

?>