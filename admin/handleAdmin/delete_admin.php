<?php

include("../db_connection.php");
include("../isLogin.php");
if ($_SESSION['user_role'] !== 'superadmin') {
  echo "Bạn không có quyền thực hiện hành động này!";
  exit();
}
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  // xoa admin dua tren id
  $sql = "DELETE FROM admins WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  if ($stmt->execute()) {
    echo "Xóa thành công";
    header("Location: ../manage_admins.php");
  } else {
    echo "Lỗi khi xóa: " . $stmt->error;
  }
}
