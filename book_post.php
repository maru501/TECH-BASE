<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location:login.php");
}
$book_id=$_GET['book_id'];
$user_id=$_SESSION['user_id'];

require_once "db.php";
if($_SERVER['REQUEST_METHOD']=='POST'){
    $post=$_POST['post'];

    $sql="INSERT INTO tbposts (user_id,book_id,post,date) VALUES (:user_id,:book_id,:post,NOW())";
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(':user_id',$user_id,PDO::PARAM_INT);
    $stmt->bindParam(':book_id',$book_id,PDO::PARAM_INT);
    $stmt->bindParam(':post',$post,PDO::PARAM_STR);
    $stmt->execute();

    echo"投稿しました！";
}

$sql="SELECT id,user_id,post,date FROM tbposts WHERE book_id=:book_id ORDER BY date DESC";
$stmt=$pdo->prepare($sql);
$stmt->bindParam(':book_id',$book_id,PDO::PARAM_INT);
$stmt->execute();
$posts=$stmt->fetchAll();

$sql="SELECT title,author,cover FROM tbbooks WHERE id=:id";
$stmt=$pdo->prepare($sql);
$stmt->bindParam(':id',$book_id,PDO::PARAM_INT);
$stmt->execute();
$book=$stmt->fetch();
?>

<h2><span style="text-decoration:underline;text-decoration-color:lightcyan;"><?php echo htmlspecialchars($book['title']) ?> について投稿する</span></h2>
<p>著者：<?php echo htmlspecialchars($book['author']) ?></p>
<img src="<?php echo htmlspecialchars($book['cover']) ?>" width="100">
<form action="" method="post">
    <textarea name="post" rows="8" cols="50" placeholder="感想やおすすめポイントなど、自由に書いてみよう！"></textarea><br>
    <button type="submit">投稿する</button>
</form>

<p><a href="bookshelf.php">My本棚に戻る</a></p>

<h3><span style="text-decoration:underline;text-decoration-color:lightcyan;">投稿一覧</span></h3>

<?php
echo"<ul>";
foreach($posts as $p){  
    $sql="SELECT name FROM tbusers WHERE id=:id";
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(':id',$p['user_id'],PDO::PARAM_INT);
    $stmt->execute();
    $user=$stmt->fetch();

    $sql="SELECT COUNT(*) FROM tblikes WHERE post_id=:post_id";
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(':post_id',$p['id'],PDO::PARAM_INT);
    $stmt->execute();
    $likes=$stmt->fetchColumn();

    echo"<li>";
    echo'<strong>'.htmlspecialchars($user['name']).'</strong><br>';
    echo nl2br(htmlspecialchars($p['post']))."(".$p['date'].")<br>";
    echo"🧡 {$likes}件<br>";
    if($p['user_id']==$user_id){
        echo"<a href='post_edit.php?id=".$p['id']."&book_id=".$book_id."'>編集</a>|";
        echo"<a href='post_delete.php?id=".$p['id']."&book_id=".$book_id."'>削除</a>";
    }
    echo"</li>";

    
}
echo"</ul>";
?>