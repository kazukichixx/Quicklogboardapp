# ①課題番号-プロダクト名

・ログイン認証管理ツール

## ②課題内容（どんな作品か）

・このアプリケーションは、ユーザーのログイン試行を管理し、成功および失敗の試行を可視化するツールです。ユーザーがCSVファイルをアップロードすることで、ログインアクションデータをデータベースに登録し、それを基に様々な情報を表示します。ログイン失敗率を算出し、それに基づいた対策を検討し、セキュリティの強化を図ります。


## ③主な機能
## 主な機能

- **CSVファイルのアップロード**: 
  - ユーザーはログイン試行データを含むCSVファイルをアップロードできます。
  - CSV形式は以下の通りです:
    ```
    UserID	Timestamp	Action
    user012	2024-09-16 21:08:15	Login
    user018	2024-08-24 15:42:15	Failed Login Attempt
    ```
 
- **ログイン成功/失敗の可視化**:
  - アップロードされたデータを分析し、成功したログイン試行と失敗したログイン試行の数を可視化します。
  - 表示形式はグラフを使用し、視覚的に理解しやすくします。

- **ログイン失敗率の計算**:
  - 成功したログイン試行の比率に対する失敗したログイン試行の割合を算出し、ダッシュボードに表示します。

- **セキュリティ管理の提案**:
  - ログイン失敗率が設定した閾値を超えた場合、ダッシュボード上に警告や、指定されたメールアドレスに通知を送信します。これにより、リアルタイムでセキュリティリスクに対応できます。

- **セキュリティ対策の検討**:
  - ログインに失敗したユーザーを表示し、すぐにフィードバック、検討した想定原因や対策を管理することができます。


## ④サーバーの設定
1. **データベースの作成**:
   - MySQLに新しいデータベースを作成し、必要なテーブル（`UserActions`, `Feedback`, `settings`）を作成してください。

2. **ファイルの配置**:
   - 本プロジェクトのファイルをサーバーのルートディレクトリに配置します。

3. **依存ライブラリのインストール**:
   - 使用しているCSSやJavaScriptのライブラリを適切に読み込んでください。

## ⑤使用方法
**ユーザーの登録**:
   - 必要に応じてユーザーアカウントを作成してください。

2. **ログイン試行データのアップロード**:
   - ログイン試行のデータを含むCSVファイルを選択し、アップロードしてください。

3. **操作ダッシュボードの確認**:
   - アップロード後、ダッシュボードでログイン試行の統計情報を確認してください。

4. **セキュリティの確認**:
   - ログイン失敗率が高いユーザーアクションを検出し、対策を検討してください。

