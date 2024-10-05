<?php
session_start();
require_once('funcs.php'); // DB接続関数をインクルード
$pdo = db_conn();

// 設定を取得する
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $threshold = $_POST['threshold']; // 閾値を取得
    $notifyEmail = $_POST['notifyEmail']; // 通知用のメールアドレスを取得

    // SQLクエリを実行して設定を保存
    $stmt = $pdo->prepare('UPDATE settings SET threshold = :threshold, notify_email = :notifyEmail WHERE id = 1');
    $stmt->bindValue(':threshold', $threshold, PDO::PARAM_INT);
    $stmt->bindValue(':notifyEmail', $notifyEmail, PDO::PARAM_STR);
    
    // クエリの実行
    if ($stmt->execute()) {
        $_SESSION['message'] = "設定が更新されました。";
    } else {
        $_SESSION['message'] = "設定の更新に失敗しました。";
    }

    // リダイレクト
    header('Location: setting.php');
    exit();
}

// 現在の設定を取得
$stmt = $pdo->prepare('SELECT * FROM settings WHERE id = 1');
$stmt->execute();
$currentSettings = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>設定ダッシュボード</title>
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
        .btn-secondary {
            background-color: #6c757d;
            color: #fff;
        }
        th {
            background-color: #fbbf24;
            color: #000;
        }
        tr:hover {
            background-color: #e2e2e2;
        }
        .max-w-4xl {
            max-width: 1200px;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden mt-10">
        <div class="px-4 py-2 bg-gray-200 flex items-center justify-between">
            <span class="text-lg font-semibold">設定</span>
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
                    <a href="feedback.php" class="flex items-center text-gray-700">
                        🔳フィードバック
                    </a>
                </div>
                <div>
                    <a href="setting.php" class="flex items-center text-gray-700 text-yellow-500 font-bold">
                        🔳設定
                    </a>
                </div>
            </div>
            <div class="w-3/4 p-5">
                <h2 class="text-xl font-bold mb-4">設定管理</h2>

                <!-- メッセージ表示 -->
                <?php if (isset($_SESSION['message'])): ?>
                    <div class="alert alert-info"><?= htmlspecialchars($_SESSION['message']) ?></div>
                    <?php unset($_SESSION['message']); ?>
                <?php endif; ?>

                <form method="POST" action="setting.php" class="bg-white p-5 shadow rounded-lg">
                    <div class="mb-4">
                        <label for="threshold" class="block text-gray-700 text-sm font-bold mb-2">失敗ログイン割合の閾値 (%)</label>
                        <input type="number" id="threshold" name="threshold" value="<?= htmlspecialchars($currentSettings['threshold']) ?>" class="form-control shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                        <label for="notifyEmail" class="block text-gray-700 text-sm font-bold mb-2">通知メールアドレス</label>
                        <input type="email" id="notifyEmail" name="notifyEmail" value="<?= htmlspecialchars($currentSettings['notify_email']) ?>" class="form-control shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <button type="submit" class="btn btn-primary bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">設定を保存</button>
                </form>

                <p class="mt-5"><a href="index.php" class="btn btn-secondary">ダッシュボードに戻る</a></p>
            </div>
        </div>
    </div>
</body>
</html>
