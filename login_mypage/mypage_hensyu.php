<?php 
mb_internal_encoding("utf8");

//セッションスタート
session_start();

//mypage.phpからの導線以外は、『login_error.php』へリダイレクト
if(empty($_POST['from_mypage'])){
    header("Location:login_error.php");
}
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
    <meta charset="UTF-8">
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
        <div class="aisatu">こんにちは！<?php echo $_SESSION['name'];?>さん</div>
           <form action="mypage_update.php" method="post">
            <div class="picture">
            <img src="<?php echo $_SESSION['picture'];?>" class="pic">
            </div>
            
            <div class="profilehensyu">
                <div class="name"><label>氏名:</label>
                <input type="text" name="name"  size="30">
                </div>
                
                <div class="mail"><label>メール:</label>
                <input type="text" name="mail"  size="30">
                </div>
                
                <div class="password"><label>パスワード:</label>
                <input type="password" name="password"  size="30">
                </div>
                
                <div class="comments">
                <textarea name="comments" rows="4" cols="77"></textarea>
                </div>
                
                <div class="button">
                <input type="submit" class="hensyubutton" value="この内容に編集する"/>
                </div>
    
            </div>
        </form>
        </div>
    </main>
        <footer>
        © 2018 InterNous.inc. All rights reserved
    </footer>
    </body>
</html>