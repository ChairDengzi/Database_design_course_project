<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url("Image/Login_Background.jpg");
            background-size: cover;
            background-position: center center;

            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px 50px 40px 40px;
            background-color: rgba(255, 255, 255, 0.7); /* 修改透明度，原始值为 #fff */
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(10px); /* 添加玻璃模糊效果 */
        }



        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error-message {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username">

            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <a href="register.php">注册</a>
            <input type="submit" value="Login">
        </form>
    </div>

    <script>
        // 获取username输入框的值
        var username = document.getElementById('username');

        // 将值赋给隐藏的input标签
        document.getElementById('UserName').value = username;
    </script>
</body>
</html>




<?php
// 连接到数据库
include 'database_config.php';

// 检查连接
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 获取提交的表单数据
$username = $_POST['username'];
$password = $_POST['password'];

// 设置 Cookie
setcookie("username", $username, time() + (86400 * 30), "/"); // 30 days expiration, change this as needed

// 查询普通用户表
$sql = "SELECT * FROM users WHERE UserName = '$username' AND Password = '$password'";
$result = $conn->query($sql);
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if ($result->num_rows > 0) {
        // 找到普通用户，跳转到 common_user.html
        header("Location: common_user.html");
        exit;
    } else {
        // 在管理员表中查找
        $sql = "SELECT * FROM administrators WHERE AdminUserName = '$username' AND AdminPassword = '$password'";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            // 找到管理员，跳转到 Administrator.html
            header("Location: Administrator.html");
            exit;
        } else {
            // 用户名或密码错误
            echo '<script>alert("Invalid username or password");</script>';
        }
    }
}


$conn->close();
?>
