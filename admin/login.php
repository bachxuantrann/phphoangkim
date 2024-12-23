<?php
session_start();
if (isset($_SESSION['user_id'])) {
  header("Location: index.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng nhập</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap">
  <link rel="stylesheet" href="login.css">
  <style>
    /* Đặt lại CSS cơ bản */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Lato', sans-serif;
    }

    body {
      background-color: #f4f4f4;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .login-container {
      background-color: #ffffff;
      padding: 30px 40px;
      border-radius: 10px;
      box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
      width: 400px;
      text-align: center;
    }

    .login-container h2 {
      font-size: 28px;
      color: #333;
      margin-bottom: 25px;
    }

    .login-container form {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .login-container input[type="text"],
    .login-container input[type="password"] {
      padding: 12px;
      border: 1px solid #ddd;
      border-radius: 5px;
      font-size: 16px;
      width: 100%;
      box-sizing: border-box;
    }

    .login-container button {
      padding: 12px 20px;
      background-color: #3498db;
      color: #ffffff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 18px;
      transition: background-color 0.3s ease;
    }

    .login-container button:hover {
      background-color: #2980b9;
    }

    .error {
      color: red;
      font-size: 14px;
      margin-top: -10px;
    }
  </style>
</head>

<body>
  <div class="login-container">
    <h2>Đăng nhập</h2>
    <?php
    if (isset($_GET['error'])) {
      echo '<p class="error">Sai tài khoản hoặc mật khẩu!</p>';
    }
    ?>
    <form action="login_process.php" method="POST">
      <input type="text" name="username" placeholder="Tên tài khoản" required>
      <input type="password" name="password" placeholder="Mật khẩu" required>
      <button type="submit">Đăng nhập</button>
    </form>
  </div>
</body>

</html>