<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location:login.php");
}
$user_id=$_SESSION['user_id'];
$post_id=$_GET['post_id'];
$book_id=$_GET['book_id'];

require_once "db.php";

$sql="INSERT INTO tblikes (user_id,post_id,date) VALUES (:user_id,:post_id,NOW())";
$stmt=$pdo->prepare($sql);
$stmt->bindParam(':user_id',$user_id,PDO::PARAM_INT);
$stmt->bindParam(':post_id',$post_id,PDO::PARAM_INT);
$stmt->execute();

header("Location:timeline.php");

?>