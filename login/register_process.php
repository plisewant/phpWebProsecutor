<?php
$name = $_POST['name'];
$password = $_POST['password'];
$password_check = $_POST['password-check'];
if(!($name && $password && $password_check)){
    // echo "asdfasdf";
    header("Location: ./register.php?empty");
    exit;
}

if($password != $password_check){
    header("Location: ./register.php?pwnotsame");
    exit;
}
// echo "$name, $password, $password_check";

$board_db = new PDO("mysql:host=localhost;dbname=board_db", "root", "12345678");

$search_samename = "
SELECT 1 FROM users WHERE name = '$name' LIMIT 1;
";
$result = $board_db->query($search_samename);
$is_samename = $result->fetch();
if($is_samename){
    header("Location: ./register.php?samename");
    exit;
}

$insert_query = "
INSERT INTO users (name, password)
    VALUES ('$name', '$password');
";
$result = $board_db->query($insert_query);
header("Location: ../index.php");
?>