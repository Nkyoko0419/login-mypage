<?php 
//ログイン時にアクセスした場合は、マイページにリダイレクトできるようにする
session_start();
if(isset($_SESSION['id'])){
    header("location:mypage.php");}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>エラー画面</title>
<link rel="stylesheet" type="text/css" href="login_error.css">
</head>

<body>
    <header>
        <img src="4eachblog_logo.jpg">
        <div class="login"><a href="">ログイン</a></div>
    </header>
    
    <main>
        <form action="mypage.php" method="post" class="hensyu">
            <div class="keikoku">
                <p>メールアドレスまたはパスワードが間違っています。</p>
            </div>
           
            <div class="mail"><label>メールアドレス</label><br>
                <input type="text" name="mail" size="40">
                </div>
            
            <div class="password"><label>パスワード</label><br>
                <input type="password" name="password"size="40">
                </div>
                
        
        <div class="button">
            <input type="submit" class="logion" value="ログイン">
        </div>
            
        </form>
        
    </main>
     <footer>
         ©2018 InterNous.inc. All rights reserved
    </footer>
</body>    
    
</html>

