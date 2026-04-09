<?php
$post_id = $_POST['post_id'];

$board_db = new PDO("mysql:host=localhost;dbname=board_db", "root", "12345678");

$delete_query = "
DELETE FROM posts
WHERE id = $post_id;
";
$board_db->query($delete_query);

header("Location: ./board.php");
?>