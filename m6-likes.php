<?php

$dsn = 'mysql:dbname=***;host=localhost';
$user = '***';
$password = '***';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));



$sql="CREATE TABLE IF NOT EXISTS tblikes"
."("
."id INT AUTO_INCREMENT PRIMARY KEY,"
."user_id INT,"
."post_id INT,"
."date DATETIME"
.");";

$stmt=$pdo->query($sql);

?>