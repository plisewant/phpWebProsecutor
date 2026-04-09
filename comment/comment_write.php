<?php
session_start();

$user_id = 0;
if(isset($_SESSION['id'])){
    $user_id = $_SESSION['id'];
}
$post_id = $_POST['post_id'];
$comment = $_POST['comment'];

if(!$comment){
    header("Location: ../board/view.php?id=$post_id");
    exit;
}

$board_db = new PDO("mysql:host=localhost;dbname=board_db", "root", "12345678");

$comment_query = "
INSERT INTO comments (post_id, author_id, content)
VALUES ($post_id, $user_id, '$comment');
";
$board_db->query($comment_query);

header("Location: ../board/view.php?id=$post_id");
?>