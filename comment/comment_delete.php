<?php
$board_db = new PDO("mysql:host=localhost;dbname=board_db", "root", "12345678");

$comment_id = $_POST['comment_id'];
$post_id = $_POST['post_id'];

$delete_query = "
DELETE FROM comments
WHERE id = $comment_id;
";
$board_db->query($delete_query);

header("Location: ../board/view.php?id=$post_id");
?>