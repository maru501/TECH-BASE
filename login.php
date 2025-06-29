<h2><span style="text-decoration:underline;text-decoration-color:lightcyan;">ログインする</span></h2>

<?php
session_start();

$dsn = 'mysql:dbname=***;host=localhost';
$user = '***';
$password = '***';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name=$_POST['name'];
    $password=$_POST['password'];

    $sql="SELECT id,name,password FROM tbusers WHERE name=:name";
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(':name',$name,PDO::PARAM_STR);
    $stmt->execute();
    $user=$stmt->fetch();

    if(password_verify($password,$user['password'])){
        $_SESSION['user_id']=$user['id'];
        $_SESSION['user_name']=$user['name'];
        header("Location:bookshelf.php");
    }else{
        echo"<p style='color:red;'>ログインできません。</p>";
    }
}
?>

<form action="" method="post">
    ユーザー名<input type="text" name="name"><br>
    パスワード<input type="password" name="password"><br>
    <button type="submit">ログイン</button>
</form>

<p><a href="homepage.php">トップページに戻る</a></p>