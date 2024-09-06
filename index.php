<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>掲示板</title>
</head>

<body>
    <h2>コメント</h2>

    <form method="post" action="form.php">
        ユーザーID<input type="text" name="userID"><br>
        ユーザー名：<input type="text" name="username"><br>
        <textarea name="comment" rows="20" cols="120"></textarea><br>
        <input type="submit" value="投稿する">
    </form>

    
    <?php ?>
</body>

</html>