<?php
$post_id = $_POST['post_id'];
$title = $_POST['title'];
$content = $_POST['content'];

if(!($title && $content && $post_id)){
    header("Location: ./edit.php?id=$post_id&empty");
    exit;
}

$board_db = new PDO("mysql:host=localhost;dbname=board_db", "root", "12345678");

$edit_query = "
UPDATE posts
SET title = '$title', content = '$content', created_at = now()
WHERE id = $post_id;
";

$board_db->query($edit_query);

header("Location: ./board.php");
?>