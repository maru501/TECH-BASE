<?php

require_once "db.php";

$sql="CREATE TABLE IF NOT EXISTS tbusers"
."("
."id INT AUTO_INCREMENT PRIMARY KEY,"
."name VARCHAR(50),"
."password VARCHAR(255),"
."date DATETIME"
.");";

$stmt=$pdo->query($sql);

?>