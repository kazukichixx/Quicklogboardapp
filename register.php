<?php
// 1. POSTデータ取得
$username = $_POST['username']; // ユーザー名を取得
$email    = $_POST['email'];    // メールアドレスを取得
$password = $_POST['password']; // パスワードを取得（ハッシュ化する前の実際の値）

// 2. DB接続します
require_once('funcs.php');
$pdo = db_conn();

// 3. データ登録SQL作成
$stmt = $pdo->prepare('INSERT INTO users (Username, PasswordHash, Email, CreatedDate) VALUES (:username, :passwordHash, :email, CURRENT_TIMESTAMP)');

// パスワードをハッシュ化
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// バインド変数の設定
$stmt->bindValue(':username',    $username, PDO::PARAM_STR);
$stmt->bindValue(':passwordHash', $passwordHash, PDO::PARAM_STR);
$stmt->bindValue(':email',        $email, PDO::PARAM_STR);

// 4. 実行
$status = $stmt->execute(); // 実行


// 5. データ登録処理後
if ($status === false) {
    // エラーハンドリング（エラー関数を定義していることを前提）
    sql_error($stmt); 
} else {
    redirect('login.php'); // 登録後にログインページへリダイレクト
}
echo '<script>alert("登録完了！ログインページに移動します。");</script>';