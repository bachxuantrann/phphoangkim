<?php
include("../isLogin.php");
include("../db_connection.php");
if (isset($_GET['id'])) {
  $id = intval($_GET['id']);

  $sql = "DELETE FROM tables WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);

  if ($stmt->execute()) {
    header("Location: ../manage_tables.php");
    exit();
  } else {
    echo "Lỗi: " . $stmt->error;
  }
  $stmt->close();
} else {
  $stmt->close();
  echo "ID không hợp lệ.";
}
