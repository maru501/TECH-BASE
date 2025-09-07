<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location:login.php");
}
$user_id=$_SESSION['user_id'];

require_once "db.php";
$id=$_POST['id']??$_GET['id'];

if($_SERVER['REQUEST_METHOD']=='POST'){
    $title=$_POST['title'];
    $author=$_POST['author'];
    $memo=$_POST['memo'];
    $cover=$_POST['cover'];

    $sql="UPDATE tbbooks SET title=:title, author=:author, memo=:memo, cover=:cover WHERE id=:id AND user_id=:user_id";
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(':title',$title,PDO::PARAM_STR);
    $stmt->bindParam(':author',$author,PDO::PARAM_STR);
    $stmt->bindParam(':memo',$memo,PDO::PARAM_STR);
    $stmt->bindParam(':cover',$cover,PDO::PARAM_STR);
    $stmt->bindParam(':id',$id,PDO::PARAM_INT);
    $stmt->bindParam(':user_id',$user_id,PDO::PARAM_INT);
    $stmt->execute();

    echo"更新しました！<a href='bookshelf.php'>My本棚に戻る</a>";
}

$sql="SELECT title,author,cover,memo FROM tbbooks WHERE id=:id AND user_id=:user_id";
$stmt=$pdo->prepare($sql);
$stmt->bindParam(':id',$id,PDO::PARAM_INT);
$stmt->bindParam(':user_id',$user_id,PDO::PARAM_INT);
$stmt->execute();
$book=$stmt->fetch();

?>

<h2><span style="text-decoration:underline;text-decoration-color:lightcyan;">本の情報を編集する</span></h2>
<form action="" method="post">
    <input type="hidden" name="id" value="<?php echo $id ?>">
    タイトル<input type="text" name="title" value="<?php echo htmlspecialchars($book['title']) ?>"><br>
    著者<input type="text" name="author" value="<?php echo htmlspecialchars($book['author']) ?>"><br>
    表紙画像URL<input type="text" name="cover" value="<?php echo htmlspecialchars($book['cover']) ?>"><br>
    メモ・感想など<br>
    <textarea name="memo" rows="5" cols="50"><?php echo htmlspecialchars($book['memo']) ?></textarea><br>
    <button type="submit">更新する</button>
</form>