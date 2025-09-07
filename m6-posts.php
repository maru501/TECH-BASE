<?php

require_once "db.php";



$sql="CREATE TABLE IF NOT EXISTS tbposts"
."("
."id INT AUTO_INCREMENT PRIMARY KEY,"
."user_id INT,"
."book_id INT,"
."post TEXT,"
."date DATETIME"
.");";

$stmt=$pdo->query($sql);