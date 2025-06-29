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

$sql="SELECT id,user_id,title,author,memo,cover FROM tbbooks WHERE user_id=:user_id";
$stmt=$pdo->prepare($sql);
$stmt->bindParam(':user_id',$user_id,PDO::PARAM_INT);
$stmt->execute();
$books=$stmt->fetchAll();

?>

<h2><span style="background-color:lightcyan">My本棚</span></h2>
<p><?php echo htmlspecialchars($_SESSION['user_name']) ?> さん</p>
<p><a href="book_add.php">本を登録する</a> | <a href="timeline.php">つながる読書掲示板</a></p>

<?php

foreach($books as $book){
    echo'<div style="border:5px solid lightcyan">';
    echo'<h3>'.htmlspecialchars($book['title']).'('.htmlspecialchars($book['author']).')</h3>';
    echo'<img src="'.htmlspecialchars($book['cover']).'" alt="表紙" width="100"><br>';
    echo'<strong>メモ・感想など</strong><br>';
    echo'<p>'.nl2br(htmlspecialchars($book['memo'])).'</p>';
    echo'<a href="book_edit.php?id='.$book['id'].'">編集</a>|';
    echo'<a href="book_delete.php?id='.$book['id'].'">削除</a>|';
    echo'<a href="book_post.php?book_id='.$book['id'].'">投稿を見る/書く</a>';
    echo'</div>';
}

?>

<p><a href="homepage.php">トップページに戻る</a></p>
<p><a href="logout.php">ログアウトする</a></p>