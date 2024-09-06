<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>掲示板</title>
</head>

<body>
    <?php
    // エラー表示
    ini_set('display_errors', "On");




    // コネクションを開く
    // ホスト名、ユーザー名、パスワード名、使用するデータベース名
    $link = mysqli_connect("localhost", "root", "mariadb", "Bord");

    // 文字コードを設定
    mysqli_set_charset($link, "utf8mb4");


    // INSERT文を作成(テンプレ)--------------------------------------------------------
    $stmt = mysqli_prepare(
        $link,
        "INSERT INTO CommentList (userID, username, comment)" .
            " VALUES (?, ?, ?);"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "iss",
        $_POST["userID"],
        $_POST["username"],
        $_POST["comment"],
    );
    // INSERT文を発行する
    mysqli_stmt_execute($stmt);

    // ---------------------------------------------------------------------------------

    echo "レコードを追加しました";
    ?>
<br>
    <a href="select.php">コメント一覧に戻る</a>

</body>

</html>