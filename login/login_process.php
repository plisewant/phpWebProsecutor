<?php
$name = $_POST['name'];
$password = $_POST['password'];
if(!($name && $password)){
    header("Location: ./login.php?empty");
    exit;
}
echo "$name $password";

$board_db = new PDO("mysql:host=localhost;dbname=board_db", "root", "12345678");

$finduser_query = "
SELECT id, name, password, role FROM users WHERE name = '$name';
";

$result = $board_db->query($finduser_query);

$row = $result->fetch(PDO::FETCH_ASSOC);
if(!$row){
    // echo "유저가 없잖";
    header("Location: ./login.php?noUser");
    exit;
}

var_dump($row['password']);
if($password != $row['password']){
    // echo "비번이 다름";
    header("Location: ./login.php?notSamePw");
    exit;
}

session_start();

$_SESSION['id'] = $row['id'];
$_SESSION['name'] = $row['name'];
$_SESSION['role'] = $row['role'];
$_SESSION['loginTime'] = time();

// var_dump($row['id'],$row['password'],$row['name']);
// var_dump($_SESSION);
header("Location: ../index.php");
?>