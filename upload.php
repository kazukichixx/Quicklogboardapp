<?php
session_start();
require_once('funcs.php'); // データベース接続関数をインクルード
$pdo = db_conn();

if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['file']['tmp_name'];
    $csvFile = fopen($fileTmpPath, 'r');

    if ($csvFile !== FALSE) {
        // ヘッダーをスキップ
        fgetcsv($csvFile);

        $isError = false; // エラー検出用フラグ
        while (($data = fgetcsv($csvFile, 1000, "\t")) !== FALSE) {
            if (count($data) < 3) { // データ形式の検証: 必要であればカラム数を確認
                $isError = true;
                $_SESSION['message'] = "データ形式が正しくありません。";
                break;
            }
            
            // SQLクエリ準備
            $stmt = $pdo->prepare('INSERT INTO UserActions (UserID, Timestamp, Action) VALUES (:UserID, :Timestamp, :Action)');
            $stmt->bindValue(':UserID', $data[0], PDO::PARAM_STR);
            $stmt->bindValue(':Timestamp', $data[1], PDO::PARAM_STR);
            $stmt->bindValue(':Action', $data[2], PDO::PARAM_STR);

            // クエリ実行とエラーチェック
            if (!$stmt->execute()) {
                $isError = true;
                $errorInfo = $stmt->errorInfo();
                $_SESSION['message'] = "データ登録失敗: " . $errorInfo[2]; // エラーメッセージをセッションに保存
                break;
            }
        }

        fclose($csvFile);

        if (!$isError) {
            $_SESSION['message'] = "CSVが正常にアップロードされ、データベースに登録されました。";
        }
    } else {
        $_SESSION['message'] = "CSVファイルを開くことができませんでした。";
    }
} else {
    $_SESSION['message'] = "CSVファイルのアップロードに失敗しました。";
}

header('Location: index.php'); // index.phpにリダイレクト
exit();
?>
