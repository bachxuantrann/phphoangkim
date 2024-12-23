<?php
session_start();
include("db_connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Kiểm tra tài khoản trong cơ sở dữ liệu
  $sql = "SELECT * FROM admins WHERE username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    // Kiểm tra mật khẩu
    if (password_verify($password, $user['password'])) {
      // Lưu thông tin vào session
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['user_role'] = $user['role'];
      $_SESSION['username'] = $user['username'];

      // Chuyển hướng tới trang admin dashboard
      header("Location: index.php");
      exit();
    } else {
      // Sai mật khẩu
      header("Location: login.php?error=1");
      exit();
    }
  } else {
    // Không tìm thấy tài khoản
    header("Location: login.php?error=1");
    exit();
  }
}
