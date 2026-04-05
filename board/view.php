<?php
if(isset($_GET['id'])){

session_start();

$user_id = false;
if(isset($_SESSION['id'])){
    $user_id = $_SESSION['id'];
}

$board_db = new PDO("mysql:host=localhost;dbname=board_db", "root", "12345678");
$post_id = $_GET['id'];

$posts_query = "
SELECT posts.title, 
    users.name, 
    DATE(posts.created_at) as created_at,
    posts.views,
    posts.content,
    posts.author_id
FROM posts
JOIN users ON posts.author_id = users.id
WHERE posts.id = '$post_id'
";

$result = $board_db->query($posts_query);
$row = $result->fetch();

// var_dump($row);
$view_query = "
UPDATE posts
SET views = views + 1
WHERE id = $post_id;
";
$board_db->query($view_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $row['title'] ?></title>
</head>

<body>
    <h2><?= $row['title'] ?></h2>
<p>
작성자: <?= $row['name'] ?> |
작성일: <?= $row['created_at'] ?> |
조회수: <?= $row['views'] ?>
</p>

<hr>

<!-- <h3>내용</h3> -->

<div>
<?= nl2br($row['content']) ?>
</div>

<hr>

<h3>댓글</h3>

<table>
    <tr>
        <th>작성자</th>
        <th>내용</th>
        <th>작성일</th>
    </tr>

        <?php
        $comment_query = "
        SELECT 
            comments.id,
            users.name,
            comments.author_id,
            comments.content,
            comments.created_at
        FROM comments
        JOIN users ON comments.author_id = users.id
        WHERE comments.post_id = $post_id
        ORDER BY comments.created_at DESC;
        ";
        $co_result = $board_db->query($comment_query);

        while($co_row = $co_result->fetch()){
        ?>
            <tr>
                <td><?= $co_row['name'] ?> :</td>
                <td><?= nl2br($co_row['content']) ?></td>
                <td><?= $co_row['created_at'] ?></td>
                
                <?php
                if($user_id && $co_row['author_id'] == $user_id || $row['author_id'] == $user_id){
                ?>
                <td>
                    <form action="../comment/comment_delete.php" method="POST">
                        <input type="hidden" name="comment_id" value="<?= $co_row['id'] ?>">
                        <input type="hidden" name="post_id" value="<?=$post_id?>">
                        <input type="submit" value="삭제">
                    </form>
                </td>
                <?php } ?>
            </tr>
        <?php } ?>
</table>

<h4>댓글 작성</h4>

<form action='../comment/comment_write.php' method="POST">
<textarea name="comment" rows="4" cols="60" placeholder="댓글을 입력하세요"></textarea>
<input type="hidden" name="post_id" value="<?=$post_id?>">
<br>
<button type="submit">댓글 작성</button>
</form>

<hr>

<a href="./board.php">돌아가기</a>
    <?php
    if($row['author_id'] == $user_id){
    ?>
        <br><a href="./edit.php?id=<?= $post_id ?>">글 수정</a>
        <form action="./delete.php" method="post">
            <input type="hidden" name="post_id" value="<?= $post_id ?>">
            <input type="submit" value="글 삭제">
        </form>
    <?php } ?>
</body>
</html>
<?php } ?>