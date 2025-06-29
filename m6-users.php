<?php

$dsn = 'mysql:dbname=***;host=localhost';
$user = '***';
$password = '***';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

$sql="CREATE TABLE IF NOT EXISTS tbusers"
."("
."id INT AUTO_INCREMENT PRIMARY KEY,"
."name VARCHAR(50),"
."password VARCHAR(255),"
."date DATETIME"
.");";

$stmt=$pdo->query($sql);

?>