<?php

require_once "db.php";



$sql="CREATE TABLE IF NOT EXISTS tblikes"
."("
."id INT AUTO_INCREMENT PRIMARY KEY,"
."user_id INT,"
."post_id INT,"
."date DATETIME"
.");";

$stmt=$pdo->query($sql);

?>