<?php
// PHPセッションの開始とデータベース接続
session_start();
require_once('funcs.php');
$pdo = db_conn();

// フィードバックフォームのデータ送信処理
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $cause = $_POST['cause'];
    $countermeasure = $_POST['countermeasure'];

    // フィードバックのデータベースへの挿入
    $stmt = $pdo->prepare('INSERT INTO Feedback (Username, Cause, Countermeasure) VALUES (:username, :cause, :countermeasure)');
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->bindValue(':cause', $cause, PDO::PARAM_STR);
    $stmt->bindValue(':countermeasure', $countermeasure, PDO::PARAM_STR);

    if ($stmt->execute()) {
        $_SESSION['message'] = "フィードバックが正常に送信されました。";
    } else {
        $_SESSION['message'] = "フィードバックの送信に失敗しました。";
    }

    header('Location: index.php');
    exit();
}

// メッセージ管理
$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
unset($_SESSION['message']);

// データの取得
$query = $pdo->prepare('SELECT Action, COUNT(*) as count FROM UserActions GROUP BY Action');
$query->execute();
$dataPoints = $query->fetchAll(PDO::FETCH_ASSOC);

// ログインアクションの集計
$loginCount = 0;
$failedLoginCount = 0;
$logoutCount = 0;

// ログインに失敗したユーザー
$failedLoginUsersQuery = $pdo->prepare('SELECT UserID, COUNT(*) as count FROM UserActions WHERE Action = :action GROUP BY UserID');
$failedLoginUsersQuery->execute([':action' => 'Failed Login Attempt']);
$failedLoginUsers = $failedLoginUsersQuery->fetchAll(PDO::FETCH_ASSOC);

// アクションのカウント
foreach ($dataPoints as $row) {
    if ($row['Action'] == 'Login') {
        $loginCount = $row['count'];
    } elseif ($row['Action'] == 'Failed Login Attempt') {
        $failedLoginCount = $row['count'];
    } elseif ($row['Action'] == 'Logout') {
        $logoutCount = $row['count'];
    }
}

// 失敗率の計算
$failedLoginPercentage = 0;
if ($loginCount > 0) {
    $failedLoginPercentage = ($failedLoginCount / $loginCount) * 100;
}

// 設定されたしきい値を取得
$settingsQuery = $pdo->prepare('SELECT threshold FROM settings WHERE id = 1');
$settingsQuery->execute();
$currentSettings = $settingsQuery->fetch(PDO::FETCH_ASSOC);
$threshold = $currentSettings['threshold'];

$isAlert = $failedLoginPercentage >= $threshold;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ダッシュボード</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
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
        .alert {
            color: #e3342f;
            background-color: #ffebee;
            border-color: #f5c6cb;
            padding: 10px;
            margin-top: 20px;
            border-radius: 5px;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden mt-10">
        <div class="px-4 py-2 bg-gray-200 flex items-center justify-between">
            <span class="text-lg font-semibold">ダッシュボード</span>
            <div>
                <a href="logout.php" class="btn btn-danger px-3">ログアウト</a>
            </div>
        </div>
        <div class="flex">
            <div class="w-1/4 bg-gray-300 p-4">
                <div class="mb-4">
                    <a href="index.php" class="flex items-center text-gray-700 text-yellow-500 font-bold">
                        🔳ダッシュボード
                    </a>
                </div>
                <div class="mb-4">
                    <a href="select.php" class="flex items-center text-gray-700">
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
              
                <?php if ($isAlert): ?>
                    <div class="alert">
                        警告: 失敗ログイン率が設定されたしきい値 <?= htmlspecialchars(number_format($threshold, 2)) ?>% を超えています。
                    </div>
                <?php endif; ?>

                <div class="mb-8">
                    <h2 class="text-xl font-bold mb-2">ユーザーアクションロググラフ</h2>
                    <canvas id="actionChart"></canvas>
                </div>
                <div class="mb-8">
                    <h2 class="text-xl font-bold mb-2">失敗ログイン率: <?= number_format($failedLoginPercentage, 2) ?>%</h2>
                    <ul>
                        <?php foreach ($failedLoginUsers as $user): ?>
                            <li><?= htmlspecialchars($user['UserID']) ?>: <?= $user['count'] ?>回</li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div>
                    <h2 class="text-xl font-bold mb-2 text-gray-800">フィードバックフォーム</h2>
                    <?php if ($message): ?>
                        <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
                    <?php endif; ?>
                    <form method="POST" action="index.php" class="bg-white p-5 shadow rounded-lg">
                        <div class="mb-4">
                            <label for="username" class="block text-gray-700 text-sm font-bold mb-2">ユーザー名</label>
                            <input type="text" id="username" name="username" required class="form-control shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="mb-4">
                            <label for="cause" class="block text-gray-700 text-sm font-bold mb-2">想定原因</label>
                            <input type="text" id="cause" name="cause" required class="form-control shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="mb-4">
                            <label for="countermeasure" class="block text-gray-700 text-sm font-bold mb-2">対策</label>
                            <input type="text" id="countermeasure" name="countermeasure" required class="form-control shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <button type="submit" class="btn btn-primary bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">送信</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('actionChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Failed Login Attempts', 'Login', 'Logout'],
                    datasets: [{
                        label: 'Count',
                        data: [<?= json_encode($failedLoginCount) ?>, <?= json_encode($loginCount) ?>, <?= json_encode($logoutCount) ?>], // 例）
                        backgroundColor: ['#e3342f', '#4A5568', '#4A5568'], // Failed Login Attemptsを赤色に
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100, // Y軸の上限を100に設定
                            ticks: {
                                stepSize: 5 // 5単位でメモリを表示
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>
