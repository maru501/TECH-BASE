<?php
session_start();
$user_id=$_SESSION['user_id']??null;

require_once "db.php";
$sql="SELECT id,user_id,book_id,post,date FROM tbposts ORDER BY date DESC";
$stmt=$pdo->query($sql);
$posts=$stmt->fetchAll();
?>

<h2><span style="background-color:lightcyan">つながる読書掲示板</span></h2>
<p><a href="bookshelf.php">My本棚に戻る</a></p>

<?php
echo"<ul>";
foreach($posts as $post){
    $sql="SELECT name FROM tbusers WHERE id=:id";
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(':id',$post['user_id'],PDO::PARAM_INT);
    $stmt->execute();
    $user=$stmt->fetch();

    $sql="SELECT title,author,cover FROM tbbooks WHERE id=:id";
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(':id',$post['book_id'],PDO::PARAM_INT);
    $stmt->execute();
    $book=$stmt->fetch();

    $sql="SELECT COUNT(*) FROM tblikes WHERE post_id=:post_id";
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(':post_id',$post['id'],PDO::PARAM_INT);
    $stmt->execute();
    $likes=$stmt->fetchColumn();

    echo'<li>';
    echo'<strong>'.htmlspecialchars($user['name']).'</strong>('.$post['date'].')<br>';
    echo htmlspecialchars($book['title']).'('.htmlspecialchars($book['author']).')<br>';
    echo'<img src="'.htmlspecialchars($book['cover']).'" width="80"><br>';
    echo nl2br(htmlspecialchars($post['post'])).'<br>';
    if($user_id){
        echo'🧡<a href="like_add.php?post_id='.$post['id'].'">いいね</a> '.$likes.'件<br>';
    }
    if($post['user_id']==$user_id){
        echo'<a href="post_edit.php?id='.$post['id'].'&book_id=0">編集</a>|';
        echo'<a href="post_delete.php?id='.$post['id'].'&book_id=0">削除</a>';
    }
    echo'</li>';
}
echo"</ul>";
?>