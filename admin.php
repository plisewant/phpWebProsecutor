<?php
// fuck1ngh4rdestp4ssw0rd
session_start();
$board_db = new PDO("mysql:host=localhost;dbname=board_db", "root", "12345678");

$role = $_SESSION['role'];
echo "hello $role";

if($role != 'admin'){
    header("Location: ./index.php");
}?>

<a href="./index.php">돌아가기</a>  

<h2>유저</h2>
<table>
    <tr>
        <th>유저 id</th>
        <th>이름</th>
        <th>비번</th>
        <th>권한</th>
        <th>생성일</th>
        <th>삭제</th>
    </tr>
    <?php
        $user_query = "
        SELECT 
            id,
            name,
            password,
            role,
            created_at
        FROM users
        ORDER BY id ASC;
        ";
        $result = $board_db->query($user_query);
        while($row = $result->fetch()){
            ?>
            <tr>
                <th><?= $row['id'] ?></th>
                <th><?= $row['name'] ?></th>
                <th><?= $row['password'] ?></th>
                <th><?= $row['role'] ?></th>
                <th><?= $row['created_at'] ?></th>
                <th>
                    <form action="./login/delete.php" method="POST">
                        <input type="hidden" name="user_id" value="<?= $row['id'] ?>">
                        <input type="submit" value="삭제">
                    </form>
                </th>
            </tr>
            <?php
        }
    ?>
</table>
<br><br>
<h2>계시판</h2>

<table>
    <tr>
        <th>계시글 id</th>
        <th>제목</th>
        <th>id</th>
        <th>유저 이름</th>
        <th>조회수</th>
        <th>생성일</th>
        <th>삭제</th>
    </tr>
    <?php
        $user_query = "
        SELECT 
            posts.id,
            posts.title,
            users.name,
            posts.author_id,
            posts.views,
            posts.created_at
        FROM posts
        JOIN users on posts.author_id = users.id
        ORDER BY posts.created_at DESC;
        ";
        $result = $board_db->query($user_query);
        while($row = $result->fetch()){
            ?>
            <tr>
                <th><?= $row['id'] ?></th>
                <th><a href="./board/view.php?id=<?=$row['id']?>"><?= $row['title'] ?></a></th>
                <th><?= $row['author_id'] ?></th>
                <th><?= $row['name'] ?></th>
                <th><?= $row['views'] ?></th>
                <th><?= $row['created_at'] ?></th>
                <th>
                    <form action="./board/delete.php" method="POST">
                        <input type="hidden" name="post_id" value="<?= $row['id'] ?>">
                        <input type="submit" value="삭제">
                    </form>
                </th>
            </tr>
            <?php
        }
    ?>
</table>
<br><br>
<h2>댓글</h2>
<table>
    <tr>
        <th>댓글 id</th>
        <th>내용</th>
        <th>id</th>
        <th>계시글</th>
        <th>id</th>
        <th>유저</th>
        <th>생성일</th>
        <th>삭제</th>
    </tr>
    <?php
        $user_query = "
        SELECT 
            comments.id,
            comments.content,
            comments.post_id,
            posts.title,
            comments.author_id,
            users.name,
            comments.created_at
        FROM comments
        JOIN users on comments.author_id = users.id
        JOIN posts on comments.post_id = posts.id
        ORDER BY comments.created_at DESC;
        ";
        $result = $board_db->query($user_query);
        while($row = $result->fetch()){
            ?>
            <tr>
                <th><?= $row['id'] ?></th>
                <th><?= $row['content'] ?></th>
                <th><?= $row['post_id'] ?></th>
                <th><?= $row['title'] ?></th>
                <th><?= $row['author_id'] ?></th>
                <th><?= $row['name'] ?></th>
                <th><?= $row['created_at'] ?></th>
                <th>
                    <form action="./comment/comment_delete.php" method="POST">
                        <input type="hidden" name="comment_id" value="<?= $row['id'] ?>">
                        <input type="hidden" name="post_id" value="<?= $row['post_id'] ?>">
                        <input type="submit" value="삭제">
                    </form>
                </th>
            </tr>
            <?php
        }
    ?>
</table>

