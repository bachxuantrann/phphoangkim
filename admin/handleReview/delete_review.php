<?php
include("../isLogin.php");
include("../db_connection.php");
if (isset($_GET['id'])) {
  $id = intval($_GET['id']);

  // Xóa đánh giá
  $sql = "DELETE FROM reviews WHERE id = $id";
  if (mysqli_query($conn, $sql)) {
    header("Location: ../manage_reviews.php");
    exit();
  } else {
    echo "Lỗi: " . mysqli_error($conn);
  }
}
