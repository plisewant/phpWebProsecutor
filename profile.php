<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>프로필</title>
</head>
    <?php
    session_start();
    $board_db = new PDO("mysql:host=localhost;dbname=board_db", "root", "12345678");

    $name = $_SESSION['name'];

    $info_query = "
    SELECT name, role, created_at FROM users WHERE name = '$name'; 
    ";
    $result = $board_db->query($info_query);
    $row = $result->fetch();

    $name = $row['name'];
    $role = $row['role'];
    $created_at = $row['created_at'];
    ?>
<body>
<tr>
    <th>이름:</th>
    <td><?=$name?></td>
</tr>
<br>
<tr>
    <th>권한:</th>
    <td><?=$role?></td>
</tr>
<br>
<tr>
    <th>가입일:</th>
    <td><?=$created_at?></td>
</tr>
<br><br>
<a href="./index.php">돌아가기</a>
</body>
</html>