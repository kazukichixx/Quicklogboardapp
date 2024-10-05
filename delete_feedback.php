<?php
session_start();
require_once('funcs.php'); // DB接続関数をインクルード
$pdo = db_conn();

// IDが指定されているか確認
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // 削除用SQL文を準備
    $stmt = $pdo->prepare('DELETE FROM Feedback WHERE ID = :id');
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);

    // SQL実行
    if ($stmt->execute()) {
        $_SESSION['message'] = "フィードバックが正常に削除されました。";
    } else {
        $_SESSION['message'] = "削除中にエラーが発生しました。";
    }
} else {
    $_SESSION['message'] = "削除するためのIDが指定されていません。";
}

// feedback.php にリダイレクト
header('Location: feedback.php');
exit();
?>
