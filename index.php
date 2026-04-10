<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판</title>
</head>
<body>
    <h2> 게시판 </h2>
        <?php
        session_start();

        if($_SESSION){
            
            ?>

            <a href="./login/logout.php">로그아웃</a>
            <!-- <br><br> -->
            <a href="profile.php">프로필(<?= $_SESSION['name']; ?>)(<?= $_SESSION['role']; ?>)</a>
            <br>
            <?php
            if($_SESSION['role'] == 'admin'){
                ?> <a href="./admin.php">관리자 페이지</a> <?php
            }
            ?>
            <br>
            <a href="./board/write.php">글 작성</a>

            <?php
            
        }
        if(!$_SESSION){
            ?>

            <a href="./login/login.php">로그인</a>
            <a href="./login/register.php">회원가입</a>
            
            <?php
        }
        ?>
    <br><br>
    <a href="./board/board.php">게시글 전체보기</a>
    <br>
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
        ORDER BY created_at desc
        LIMIT 10;
        ";

        $result = $board_db->query($search_quary);

        ?>
    <label>최근 개시글</label>
    <table>
        <?php
        while($row = $result->fetch()){
        ?>
        <tr>
            <th>
                <a href="./board/view.php?id=<?= $row['id'] ?>" >
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