<?php

//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続
function db_conn()
{
$prod_db = "xx;
$prod_host = "xx";
$prod_id = "xx";
$prod_pw = "xx";
    try {
        $pdo = new PDO('mysql:dbname=' . $prod_db . ';charset=utf8;host=' . $prod_host, $prod_id, $prod_pw);
        return $pdo;
    } catch (PDOException $e) {
        exit('DB Connection Error:' . $e->getMessage());
    }
}

//SQLエラー
function sql_error($stmt)
{
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit('SQLError:' . $error[2]);
}

//リダイレクト
function redirect($file_name)
{
    header('Location: ' . $file_name);
    exit();
}


// ログインチェク処理 loginCheck()
function loginCheck()
{
    if (!isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid'] !== session_id()) {
        exit('LOGIN ERROR');
    }
    session_regenerate_id(true);
    $_SESSION['chk_ssid'] = session_id();
}

// メール送信機能
function send_notification_email($to, $subject, $message) {
    $headers = "From: no-reply@example.com\r\n";  // 送信者のメールアドレス（適宜変更）
    $headers .= "Reply-To: no-reply@example.com\r\n"; // 返信用のメールアドレス（必要に応じて）

    // mail関数を使用してメールを送信
    return mail($to, $subject, $message, $headers);
}
?>
