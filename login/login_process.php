<?php
$name = $_POST['name'];
$password = $_POST['password'];
if(!($name && $password)){
    header("Location: ./login.php?empty");
    exit;
}

$board_db = new PDO("mysql:host=localhost;dbname=board_db", "root", "12345678");

$finduser_query = "
SELECT id, name, password, role FROM users WHERE name = '$name';
";

$result = $board_db->query($finduser_query);

$row = $result->fetch(PDO::FETCH_ASSOC);
if(!$row){
    header("Location: ./login.php?noUser");
    exit;
}

if($password != $row['password']){
    header("Location: ./login.php?notSamePw");
    exit;
}

session_start();

$_SESSION['id'] = $row['id'];
$_SESSION['name'] = $row['name'];
$_SESSION['role'] = $row['role'];
$_SESSION['loginTime'] = time();

header("Location: ../index.php");
?>