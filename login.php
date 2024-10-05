<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">  <!-- カスタムCSSの読み込み -->
    <link href="css/bootstrap.min.css" rel="stylesheet">  <!-- Bootstrap CSS -->
    <script src="https://cdn.tailwindcss.com"></script>  <!-- Tailwind CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">  <!-- Google Fonts -->
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
    <title>ログイン</title>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg p-6 w-80">
        <div class="flex justify-between items-center mb-4">
            <div class="flex space-x-1">
                <!-- <div class="w-2 h-2 bg-gray-500 rounded-full"></div>
                <div class="w-2 h-2 bg-gray-500 rounded-full"></div>
                <div class="w-2 h-2 bg-gray-500 rounded-full"></div> -->
            </div>
        </div>
        <div class="flex flex-col items-center">
            <div class="relative mb-6">
                <div class="flex space-x-2 items-end">
                    <div class="w-6 h-16 bg-black"></div>
                    <div class="w-6 h-20 bg-black"></div>
                    <div class="w-6 h-24 bg-black"></div>
                    <div class="w-6 h-28 bg-black"></div>
                </div>
                <svg class="absolute top-0 left-0 w-full h-full" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <polyline points="10,90 30,70 50,50 70,30" stroke="black" stroke-width="2" fill="none" />
                    <polygon points="70,30 75,25 80,30 75,35" fill="yellow" stroke="black" stroke-width="2" />
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-yellow-500 mb-4">QuickLogBoard</h1>
            <p class="text-gray-700 mb-6">Easily Manage Your Log Data</p>

            <!-- ログインフォーム -->
            <form name="form1" action="login_act.php" method="post" class="w-full mb-4">
                <input type="text" name="lid" placeholder="ID" required class="border p-2 mb-2 w-full" />
                <input type="password" name="lpw" placeholder="PW" required class="border p-2 mb-4 w-full" />
                <button type="submit" class="bg-yellow-500 text-white font-bold py-2 px-4 rounded w-full">LOGIN</button>
            </form>

            <!-- ユーザー登録フォーム -->
            <form method="POST" action="register.php" class="w-full mb-4">
                <input type="text" name="username" placeholder="Username" required class="border p-2 mb-2 w-full" />
                <input type="email" name="email" placeholder="Email" required class="border p-2 mb-2 w-full" />
                <input type="password" name="password" placeholder="Password" required class="border p-2 mb-4 w-full" />
                <button type="submit" name="register" class="bg-blue-500 text-white font-bold py-2 px-4 rounded w-full">Sign Up</button>
            </form>
        </div>
    </div>
</body>

</html>
