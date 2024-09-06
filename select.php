<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>コメント一覧</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>



<body>
    <h2>○×△掲示板</h2>
    <table class="table table-striped">
        <tr>
            <th class="table-success" style="width: 50px;">ID</th>
            <th class="table-success" style="width: 100px;">ユーザー名</th>
            <th class="table-success" style="width: 150px;">日付</th>
            <th class="table-success" style="width: 550px;">コメント</th>
        </tr>
        <?php
        session_start();

        ini_set('display_errors', "On");

        // ----------------------------------------------------------------------------------------------
        // コネクションを開く(データベースにログイン)
        // ホスト名、ユーザー名、パスワード、使用するデータベース名
        $link = mysqli_connect("localhost", "root", "mariadb", "Bord");

        // 文字コードを設定
        mysqli_set_charset($link, "utf8mb4");

        // SELECT文を発行する
        $result = mysqli_query($link, "SELECT * FROM CommentList");


        // レコードセットを繰り返し取得する
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["comment-ID"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["username"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["time"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["comment"]) . "</td>";
            echo "<tr>";
        }

        // レコードセットを解放する
        mysqli_free_result($result);

        // コネクションを閉じる
        mysqli_close(($link));


        // ログイン情報が合っているかのチェック------------------------------------------
        // データが両方にセットされている時
        if (isset($_POST["id"]) && isset($_POST["password"])) {
            // データの定数設定
            $userID = $_POST["id"];
            $pass = $_POST["password"];

            //IDとpassが[test]と[pass]だったらログイン可。間違えていればやり直し。
            // 空欄があれば「情報を入力してください」
            if (($userID == "test") && ($pass == "pass")) {
                echo "ようこそ！";
                echo  "<div class><a href='index.php'>コメント入力フォームはこちら</a></div>";

                // セッションを使う
                if (!isset($_POST["username"])) {
                    //選択されていないとき、削除する
                    unset($_SESSION["username"]);
                } else {
                    // 選択されているとき
                    $_uservalue = $_POST["username"];
                    $_SESSION["username"] = $_uservalue;
                }
            } elseif (($userID != "test") || ($pass != "pass")) {
                echo "IDもしくはpassが間違えています。<br>コメント投稿はログイン後可能です";
            }
        }

        ?>
    </table>

    <style>
        body {
            max-width: 1000px;
            margin: 0 auto;
            width: 80%;
            background-color: #ACC3D6;
            color: #fff;
        }

        h2 {
            border: 5px double black;
            width: 50%;
            margin: auto;
            padding: 10px;
            margin-bottom: 1rem;
            border-radius: 15px;
            border-color: black;
            text-align: center;
            background-color: #E1CCCC;
        }

        tr {
            color: red;
        }
    </style>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>