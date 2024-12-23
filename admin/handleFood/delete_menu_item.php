<?php
include("../isLogin.php");
include("../db_connection.php");

if (isset($_GET['id'])) {
  $current_page = $_GET['page'];
  $id = intval($_GET['id']);
  $sql_delete = "DELETE FROM menu_items WHERE id = ?";
  $stmt_delete = $conn->prepare($sql_delete);
  $stmt_delete->bind_param("i", $id);
  if ($stmt_delete->execute()) {
    header("Location: ../manage_menu_items.php?page={$current_page}");
    exit();
  } else {
    echo "Lỗi: " . $stmt->error;
  }
  $stmt->close();
}
