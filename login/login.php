<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로그인</title>
</head>
<body>
    <form action="login_process.php" method="POST">
        
        <label for="username">이름</label> <br>
        <input type="text" name="name" id="username">
        <?php
        if(isset($_GET['noUser'])){
        ?><span style="color: red;">존재하지 않는 이름</span><?php
        } ?>
        <br><br>
    
        <label for="password">비밀번호</label><br>
        <input type="password" id="password" name="password">
        <?php
        if(isset($_GET['notSamePw'])){
        ?><span style="color: red;">틀린 비밀번호</span><?php
        } ?>
        <br><br>
    
        <button type="subbmit">로그인</button><br>
        <?php
        if(isset($_GET['empty'])){
        ?><span style="color: red;">값을 입력하세요</span><?php
        } ?>
    </form>
</body>
</html>