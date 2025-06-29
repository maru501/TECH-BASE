<?php

$dsn = 'mysql:dbname=***;host=localhost';
$user = '***';
$password = '***';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

if($_SERVER["REQUEST_METHOD"]=="POST" && !empty($_POST['name']) && !empty($_POST['password'])){
    $name=$_POST['name'];
    $password=$_POST['password'];
    $hashed_pass=password_hash($password,PASSWORD_DEFAULT);

    $sql="INSERT INTO tbusers (name,password,date) VALUES (:name,:password,NOW())";
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(':name',$name,PDO::PARAM_STR);
    $stmt->bindParam(':password',$hashed_pass,PDO::PARAM_STR);
    $stmt->execute();

    echo"<p>登録が完了しました！<a href='login.php'>ログインする</a></p>";
}

?>

<h2><span style="text-decoration:underline;text-decoration-color:lightcyan;">会員登録をする</span></h2>
<form action="" method="post">
    ユーザー名<input type="text" name="name"><br>
    パスワード<input type="password" name="password" placeholder="半角数字4ケタ"><br>
    <button type="submit">登録する</button>
</form>