<?php
session_start();
require_once('funcs.php'); // DB接続関数をインクルード
$pdo = db_conn();

// IDパラメータが設定されているか確認
if (isset($_GET['id'])) {
    // IDを取得
    $id = $_GET['id'];
    
    // 削除用SQL文を準備
    $stmt = $pdo->prepare('DELETE FROM UserActions WHERE ID = :id'); // IDがプライマリーキーのカラム名
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    
    // SQL実行
    if ($stmt->execute()) {
        $_SESSION['message'] = "アクションが正常に削除されました。";
    } else {
        $_SESSION['message'] = "削除中にエラーが発生しました。";
    }
} else {
    $_SESSION['message'] = "削除のためのIDが指定されていません。";
}

// select.php にリダイレクト
header('Location: select.php');
exit();
