<?php
session_start();
require_once('funcs.php'); // DB接続関数をインクルード
loginCheck(); // ログイン状態をチェック

// データベース接続
$pdo = db_conn();

// ユーザーアクションの取得
$stmt = $pdo->prepare('SELECT * FROM UserActions');
$status = $stmt->execute();

// データ表示
$actionData = '';
if ($status === false) {
    sql_error($stmt); // SQLエラー処理
} else {
    while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $actionData .= '<tr>';
        $actionData .= '<td>' . htmlspecialchars($r['UserID']) . '</td>';
        $actionData .= '<td>' . htmlspecialchars($r['Timestamp']) . '</td>';
        $actionData .= '<td>' . htmlspecialchars($r['Action']) . '</td>';
        $actionData .= '<td>';
        // 削除ボタン
        $actionData .= '<a href="delete_action.php?id=' . htmlspecialchars($r['ID']) . '" class="btn btn-danger btn-sm">削除</a>'; // 注意: IDがPRIMARY KEYのカラムを仮定
        $actionData .= '</td>';
        $actionData .= '</tr>';
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アクションデータダッシュボード</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f7f7f7;
        }
        .navbar {
            background-color: #f6f6f6;
        }
        .btn-primary {
            background-color: #fbbf24;
            border-color: #fbbf24;
            color: #fff;
        }
        .btn-primary:hover {
            background-color: #f6cf56;
            border-color: #f6cf56;
        }
        .btn-danger {
            background-color: #e3342f;
            border-color: #e3342f;
            color: #fff;
        }
        .btn-danger:hover {
            background-color: #c5261f;
            border-color: #c5261f;
        }
        th {
            background-color: #fbbf24;
            color: #000;
        }
        tr:hover {
            background-color: #e2e2e2;
        }
        .container {
            max-width: 1200px;
            margin-top: 50px;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="max-w-5xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden mt-10">
        <div class="px-4 py-2 bg-gray-200 flex items-center justify-between">
            <span class="text-lg font-semibold">アクションデータ</span>
            <div>
                <a href="logout.php" class="btn btn-danger px-3">ログアウト</a>
            </div>
        </div>
        <div class="flex">
            <div class="w-1/4 bg-gray-300 p-4">
                <div class="mb-4">
                    <a href="index.php" class="flex items-center text-gray-700">
                        🔳ダッシュボード
                    </a>
                </div>
                <div class="mb-4">
                    <a href="select.php" class="flex items-center text-gray-700 text-yellow-500 font-bold">
                        🔳アクションデータ
                    </a>
                </div>
                <div class="mb-4">
                    <a href="feedback.php" class="flex items-center text-gray-700">
                        🔳フィードバック
                    </a>
                </div>
                <div>
                    <a href="setting.php" class="flex items-center text-gray-700">
                        🔳設定
                    </a>
                </div>
            </div>
            <div class="w-3/4 p-5">
                <h2 class="text-xl font-bold mb-4">アクションデータ一覧</h2>
                <button id="toggleButton" class="btn btn-secondary mb-3" onclick="toggleTable()">アクションデータ表示/非表示</button>

                <div style="overflow-x:auto;">
                    <table class="table table-bordered table-striped toggle-table" id="actionTable">
                        <thead>
                            <tr>
                                <th>UserID</th>
                                <th>Timestamp</th>
                                <th>Action</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?= $actionData ?>
                        </tbody>
                    </table>
                </div>

                <h3 class="mt-8">ファイルアップロード</h3>
                <form method="post" action="upload.php" enctype="multipart/form-data">
                    <label for="file">CSVファイルを選択:</label>
                    <input type="file" name="file" id="file" accept=".csv" required class="form-control mb-2">
                    <button type="submit" class="btn btn-primary">アップロード</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        function toggleTable() {
            const table = document.getElementById('actionTable');
            if (table.style.display === 'none') {
                table.style.display = 'table';
            } else {
                table.style.display = 'none';
            }
        }
    </script>
</body>
</html>
