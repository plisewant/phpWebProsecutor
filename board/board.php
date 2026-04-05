<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>전체 계시글</title>
</head>
<?php
$board_db = new PDO("mysql:host=localhost;dbname=board_db", "root", "12345678");

$search_quary = "
SELECT 
    posts.id, 
    posts.title, 
    users.name, 
    posts.views, 
    posts.created_at
FROM posts
JOIN users ON posts.author_id = users.id
ORDER BY created_at desc;
";

$result = $board_db->query($search_quary);
?>

<body>
    <label>전체 계시글</label><br><a href="../index.php">돌아가기</a>
    <table>
        <?php
        while($row = $result->fetch()){
        ?>
        <tr>
            <th>
                <a href="./view.php?id=<?= $row['id'] ?>" >
                    <?= $row['title']; ?>
                </a>
            </th>
            <th><?= $row['name']; ?></th>
            <th><?= substr($row['created_at'], 0, 10); ?></th>
            <th>조회수: <?= $row['views']; ?></th>
        </tr>
        <?php } ?>
    </table>
</body>
</html>