<?php
$board_db = new PDO("mysql:host=localhost;dbname=board_db", "root", "12345678");

$user_id = $_POST['user_id'];

$delete_query = "
DELETE 
FROM users
WHERE id = $user_id;
";

$board_db->query($delete_query);

header("Location: ../index.php");
?>