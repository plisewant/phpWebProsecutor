<?php
session_start();
$title = $_POST['title'];
$content = $_POST['content'];
// $name = $_SESSION['name'];
$user_id = $_SESSION['id'];
// var_dump($title, $content);
// var_dump($name, $user_id);
if(!($title && $content && $user_id)){
    header("Location: ./write.php?empty");
    exit;
}

$board_db = new PDO("mysql:host=localhost;dbname=board_db", "root", "12345678");

$write_query = "
INSERT INTO posts (title, content, author_id)
VALUE ('$title', '$content', $user_id);
";

$board_db->query($write_query);

header("Location: ./board.php");
?>