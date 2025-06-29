<?php

$dsn = 'mysql:dbname=***;host=localhost';
$user = '***';
$password = '***';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));



$sql="CREATE TABLE IF NOT EXISTS tbposts"
."("
."id INT AUTO_INCREMENT PRIMARY KEY,"
."user_id INT,"
."book_id INT,"
."post TEXT,"
."date DATETIME"
.");";

$stmt=$pdo->query($sql);