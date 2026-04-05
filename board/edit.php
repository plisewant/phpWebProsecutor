<?php
$post_id = $_GET['id'];

$board_db = new PDO("mysql:host=localhost;dbname=board_db", "root", "12345678");

$content_query = "
SELECT title, content
FROM posts
WHERE id = $post_id;
";
$result = $board_db->query($content_query);
$row = $result->fetch();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>글 수정</title>
</head>
<body>
    <form action="edit_process.php" method="post">

        <label for="title">제목</label><br>
        <input type="text" id="title" name="title" value="<?=$row['title']?>">

        <br><br>

        <label for="content">내용</label><br>
        <textarea id="content" name="content" rows="10" cols="50">
            <?=$row['content']?>
        </textarea>

        <br><br>
        <input type="hidden" name="post_id" value="<?=$post_id?>">
        <button type="submit">수정</button>

    </form>
</body>
</html>