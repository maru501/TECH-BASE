<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location:login.php");
}
$user_id=$_SESSION['user_id'];

$dsn = 'mysql:dbname=***;host=localhost';
$user = '***';
$password = '***';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

if(isset($_POST['submit'])){
    $title=$_POST['title'];
    $author=$_POST['author'];
    $cover=$_POST['cover'];
    $memo=$_POST['memo'];
   
    $sql="INSERT INTO tbbooks (title,author,cover,memo) VALUES (:title,:author,:cover,:memo)";
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(':title',$title,PDO::PARAM_STR);
    $stmt->bindParam(':author',$author,PDO::PARAM_STR); 
    $stmt->bindParam(':cover',$cover,PDO::PARAM_STR);
    $stmt->bindParam(':memo',$memo,PDO::PARAM_STR);
    $stmt->execute();
        
    echo "登録が完了しました！<a href='bookshelf.php'>My本棚に戻る</a><br>";
}

?>

<h2><span style="text-decoration:underline;text-decoration-color:lightcyan;">本を登録する</span></h2>
<form action="" method="post">
    <input type="text" name="title" placeholder="タイトル"><br>
    <input type="text" name="author" placeholder="著者"><br>  
    <input type="text" name="cover" placeholder="表紙画像URL(なくてもOK)"><br>
    <textarea name="memo" rows="5" cols="50" placeholder="メモ・感想など"></textarea><br>
    <button type="submit" name="submit">登録する</button>
</form>