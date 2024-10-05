<?php
session_start();
require_once('funcs.php');
loginCheck(); // ログイン状態をチェック

// データベース接続
$pdo = db_conn();

// フィードバックの取得
$stmt = $pdo->prepare('SELECT * FROM Feedback ORDER BY CreatedDate DESC');
$status = $stmt->execute();

// データ表示
$feedbackData = '';
if ($status === false) {
    sql_error($stmt); // SQLエラー処理
} else {
    while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $feedbackData .= '<tr>';
        $feedbackData .= '<td>' . htmlspecialchars($r['Username']) . '</td>';
        $feedbackData .= '<td>' . htmlspecialchars($r['Cause']) . '</td>';
        $feedbackData .= '<td>' . htmlspecialchars($r['Countermeasure']) . '</td>';
        $feedbackData .= '<td>' . htmlspecialchars($r['CreatedDate']) . '</td>';
        $feedbackData .= '<td>';
        // 削除ボタン追加
        $feedbackData .= '<a href="delete_feedback.php?id=' . htmlspecialchars($r['ID']) . '" class="btn btn-danger btn-sm">削除</a>';
        $feedbackData .= '</td>';
        $feedbackData .= '</tr>';
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>フィードバックダッシュボード</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f7f7f7;
            color: #333;
        }
        .navbar, .footer {
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
    </style>
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="max-w-5xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden mt-10">
        <div class="px-4 py-2 bg-gray-200 flex items-center justify-between">
            <span class="text-lg font-semibold">フィードバック</span>
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
                    <a href="select.php" class="flex items-center text-gray-700">
                        🔳アクションデータ
                    </a>
                </div>
                <div class="mb-4">
                    <a href="feedback.php" class="flex items-center text-gray-700 text-yellow-500 font-bold">
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
                <h2 class="text-xl font-bold mb-4">フィードバック一覧</h2>

                <!-- メッセージの表示 -->
                <?php if (isset($_SESSION['message'])): ?>
                    <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
                    <?php unset($_SESSION['message']); ?>
                <?php endif; ?>

                <div style="overflow-x:auto;">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ユーザー名</th>
                                <th>想定原因</th>
                                <th>対策</th>
                                <th>登録日時</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?= $feedbackData ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
