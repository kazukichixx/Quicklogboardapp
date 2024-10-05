<?php
require 'sessions/session_manager.php'; // セッション管理をチェック
checkSession();
require 'includes/db.php'; // DB接続ファイルのインクルード

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['previewData'])) {
    // プレビューで表示したデータを復元
    $validData = unserialize(htmlspecialchars_decode($_POST['previewData']));

    // DB接続を取得
    $pdo = db_conn();
    $sql = "INSERT INTO LoginAttempts (UserID, Timestamp, Action) VALUES (:userID, :timestamp, :action)";
    $stmt = $pdo->prepare($sql);

    try {
        foreach ($validData as $entry) {
            if (validateData($entry)) { // バリデーション
                $stmt->bindValue(':userID', $entry[0], PDO::PARAM_STR); // UserID
                $stmt->bindValue(':timestamp', $entry[1], PDO::PARAM_STR); // Timestamp
                $stmt->bindValue(':action', $entry[2], PDO::PARAM_STR); // Action
                $stmt->execute(); // データ挿入
            } else {
                echo "無効なデータが含まれています。データ: " . h(implode(', ', $entry)) . "<br>";
            }
        }

        echo "データの保存が完了しました。<a href='dashboard.php'>戻る</a>";
    } catch (PDOException $e) {
        die("SQL Error: " . $e->getMessage()); // SQLエラーが発生した場合
    }
} else {
    die("無効なリクエストです。<a href='dashboard.php'>戻る</a>");
}

// データの検証関数
function validateData($data) {
    $validActions = ['Login', 'Failed Login Attempt', 'Logout'];
    $userIdPattern = '/^user[0-9]{3}$/';

    if (count($data) < 3) {
        return false; // データが不足している場合は無効
    }

    if (preg_match($userIdPattern, $data[0]) &&
        validateTimestamp($data[1]) &&
        in_array($data[2], $validActions)) {
        return true;
    }

    return false;
}

// タイムスタンプの検証関数
function validateTimestamp($timestamp) {
    $date = DateTime::createFromFormat('Y-m-d H:i:s', $timestamp); // 正しい形式であるか確認
    return $date && $date->format('Y-m-d H:i:s') === $timestamp;
}
?>
