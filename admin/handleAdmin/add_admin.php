<?php
include("../db_connection.php");
include("../isLogin.php");
if ($_SESSION['user_role'] !== 'superadmin') {
  echo "Bạn không có quyền thực hiện hành động này!";
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Mã hóa mật khẩu
  $phone = $_POST['phone'];
  $role = $_POST['role'];

  $sql = "INSERT INTO admins (username, email, password, phone, role) VALUES (?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sssss", $username, $email, $password, $phone, $role); // Lưu mật khẩu đã mã hóa
  if ($stmt->execute()) {
    echo "Thêm admin thành công";
    header("Location: ../manage_admins.php");
    exit();
  } else {
    echo "Lỗi: " . $stmt->error;
  }

  $stmt->close();
}
$conn->close();
