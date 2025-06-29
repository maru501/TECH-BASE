<?php

$dsn = 'mysql:dbname=***;host=localhost';
$user = '***';
$password = '***';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));



$sql="CREATE TABLE IF NOT EXISTS tbbooks"
."("
."id INT AUTO_INCREMENT PRIMARY KEY,"
."user_id INT,"
."title VARCHAR(150),"
."author VARCHAR(100),"
."genre_id INT,"
."memo TEXT,"
."cover VARCHAR(255)"
.");";

$stmt=$pdo->query($sql);

?>