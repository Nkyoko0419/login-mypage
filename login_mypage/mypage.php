<?php
mb_internal_encoding("utf8");
session_start();

if(empty($_SESSION['id'])){

try{
    //try catch文。DBに接続できなければエラーメッセージを表示
    $pdo= new PDO("mysql:dbname=lesson1;host=localhost;","root","");
}catch(PDOException $e){
    die("<p>申し訳ございません。現在サーバーが込み合っており一時的にアクセスが出来ません。<br>しばらくしてから再度ログインをしてください。</p>
    <a href='http://localhost/login_mypage/login.php'>ログイン画面へ</a>"
       );
}

//プリペアードステートメントでSQL文の型を作る。（DBとpostデータを照合させる。select文とwhere句を使用。）
//→”データベースに格納する役割”の型
$stmt = $pdo->prepare("select * from login_mypage where mail = ? && password = ?");

//bindValueメソッドでパラメータをセット
//→上記で作成した”型”にあてはめるためのもの
$stmt->bindValue(1,$_POST["mail"]);
$stmt->bindValue(2,$_POST["password"]);


//executeでクエリを実行
$stmt->execute();

//データベースを切断
$pdo = NULL;

//fetch・while文でデータ取得し、sessionに代入
//→上記で正しい情報が取得できていればデータを取得する（だけ）、という意味
//→入力されたメールアドレスとパスワードに一致するIDがあるかをここで確かめる
while($row=$stmt->fetch()){
    $_SESSION['id']=$row['id'];
    $_SESSION['name']=$row['name'];
    $_SESSION['mail']=$row['mail'];
    $_SESSION['password']=$row['password'];
    $_SESSION['picture']=$row['picture'];
    $_SESSION['comments']=$row['comments'];
}
//データ取得ができずに（emptyを使用して判定）sessionがなければ、リダイレクト（エラー画面へ）
if(empty($_SESSION['id'])){
    header("Location:login_error.php");
}
    
if(!empty($_POST['login_keep'])){
    $_SESSION['login_keep']=$_POST['login_keep'];
  }    
}
if(!empty($_SESSION['id']) && !empty($_SESSION['login_keep'])){
    setcookie('mail',$_SESSION['mail'],time()+60*60*24*7);
    setcookie('password',$_SESSION['password'],time()+60*60*24*7);
    setcookie('login_keep',$_SESSION['login_keep'],time()+60*60*24*7);
}else if(empty($_SESSION['login_keep'])){
    setcookie('mail','',time()-1);
    setcookie('password','',time()-1);
    setcookie('login_keep','',time()-1);
}
?>

<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>マイページ登録</title>
<link rel="stylesheet" type="text/css" href="mypage.css">
</head>
    <body>
    <header>
        <img src="4eachblog_logo.jpg">
        <div class="logout"><a href="log_out.php">ログアウト</a></div>
    </header>
        
    <main>
        <div class="box">
        <h1>会員情報</h1>
        <div class="aisatu"><?php echo "こんにちは!　".$_SESSION['name']."さん";  ?></div>
        <div class="picture">
            <img src="<?php echo $_SESSION['picture'];?>" class="pic">
        </div>
            
        <div class="profile">
            <div class="name">氏名：<?php echo $_SESSION['name'];?></div>
            <div class="mail">メール：<?php echo $_SESSION['mail'];?></div>
            <div class="password">パスワード：<?php echo $_SESSION['password'];?></div>
        </div>
        
        <div class="comments">
            <?php echo $_SESSION['comments'];?>
        </div>
        <form action="mypage_hensyu.php" method="post" class="form_center">
            <input type="hidden" value="<?php echo rand(1,10);?>" name="from_mypage">
        
        <div class="button">
            <input type="submit" class="hensyubutton" value="編集する"/>
        </div>
            
        </form>
            </div>
    </main>
    <footer>
		© 2021 InterNous.inc. All rights reserved
	</footer>
    
    </body>
</html>






























