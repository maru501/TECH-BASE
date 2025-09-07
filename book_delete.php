<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location:login.php");
}
$user_id=$_SESSION['user_id'];

require_once "db.php";

$id=$_GET['id'];

$sql="DELETE FROM tbbooks WHERE id=:id AND user_id=:user_id";
$stmt=$pdo->prepare($sql);
$stmt->bindParam(':id',$id,PDO::PARAM_INT);
$stmt->bindParam(':user_id',$user_id,PDO::PARAM_INT);
$stmt->execute();

header("Location:bookshelf.php");