<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입</title>
</head>
<body>
    <form action="register_process.php" method="POST">
    
        <label for="username">이름</label> <br>
        <input type="text" name="name" id="username">
        <?php
        if(isset($_GET['samename'])){
        ?><span style="color: red;">중복된 이름</span><?php
        } ?>
        <br><br>

        <label for="password">비밀번호</label><br>
        <input type="password" id="password" name="password">
        <br><br>

        <label for="password-check">비밀번호 확인</label><br>
        <input type="password" id="password-check" name="password-check">
        <?php
        if(isset($_GET['pwnotsame'])){
        ?><span style="color: red;">비밀번호가 다릅니다</span><?php
        } ?>
        <br><br>
        
        <button type="subbmit">회원가입</button>
        <br>
        <?php
        if(isset($_GET['empty'])){
            ?><span style="color: red;">값을 입력해 주새요</span><?php
        } ?>
    </form>
</body>
</html>