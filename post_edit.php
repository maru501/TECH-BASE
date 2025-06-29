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

$id=$_POST['id']??$_GET['id'];
$book_id=$_POST['book_id']??$_GET['book_id'];

$sql="SELECT post FROM tbposts WHERE id=:id AND user_id=:user_id";
$stmt=$pdo->prepare($sql);
$stmt->bindParam(':id',$id,PDO::PARAM_INT);
$stmt->bindParam(':user_id',$user_id,PDO::PARAM_INT);
$stmt->execute();
$data=$stmt->fetch();

if($_SERVER['REQUEST_METHOD']=='POST'){
    $post=$_POST['post'];
    $sql="UPDATE tbposts SET post=:post WHERE id=:id AND user_id=:user_id";
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(':post',$post,PDO::PARAM_STR);
    $stmt->bindParam(':id',$id,PDO::PARAM_INT);
    $stmt->bindParam(':user_id',$user_id,PDO::PARAM_INT);
    $stmt->execute();
    echo"投稿を更新しました！<a href='book_post.php?book_id=$book_id'>投稿一覧に戻る</a>";
}
?>

<h2><span style="text-decoration:underline;text-decoration-color:lightcyan;">投稿を編集する</span></h2>
<form action="" method="post">
    <input type="hidden" name="id" value="<?php echo $id ?>">
    <input type="hidden" name="book_id" value="<?php echo $book_id ?>">
    <textarea name="post" rows="8" cols="50"><?php echo htmlspecialchars($data['post']) ?></textarea><br>
    <button type="submit">更新する</button>
</form>