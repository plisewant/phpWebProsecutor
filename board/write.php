<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>글 작성</title>
</head>
<body>
    <form action="write_process.php" method="post">

        <label for="title">제목</label><br>
        <input type="text" id="title" name="title">

        <br><br>

        <label for="content">내용</label><br>
        <textarea id="content" name="content" rows="10" cols="50"></textarea>

        <br><br>

        <button type="submit">작성</button>

    </form>
</body>
</html>