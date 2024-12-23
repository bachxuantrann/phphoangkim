<?php

include("../isLogin.php");
include("../db_connection.php");
if ($_SESSION['user_role'] !== 'superadmin') {
  echo "Bạn không có quyền thực hiện hành động này!";
  exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $role = $_POST['role'];
  $password = $_POST['password'];

  if (isset($password) && $password !== "") {
    // Mã hóa mật khẩu mới nếu có nhập
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE admins SET username = ?, email = ?, phone = ?, role = ?, password = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $username, $email, $phone, $role, $hashed_password, $id);
  } else {
    // Không thay đổi mật khẩu nếu không nhập mật khẩu mới
    $sql = "UPDATE admins SET username = ?, email = ?, phone = ?, role = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $username, $email, $phone, $role, $id);
  }

  // Thực thi câu lệnh
  if ($stmt->execute()) {
    echo "Cập nhật tài khoản thành công!";
    header("Location: ../manage_admins.php");
    exit();
  } else {
    echo "Lỗi khi cập nhật: " . $stmt->error;
  }

  $stmt->close();
}
$conn->close();
