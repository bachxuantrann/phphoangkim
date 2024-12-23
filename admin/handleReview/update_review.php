<?php
include("../db_connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $username = $_POST['username'];
  $profession = $_POST['profession'];
  $content = $_POST['content'];

  $sql = "UPDATE reviews SET name = ?, profession = ?, content = ? WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sssi", $username, $profession, $content, $id);

  if ($stmt->execute()) {
    echo "Cập nhật đánh giá thành công";
    header("Location: ../manage_reviews.php");
    exit();
  } else {
    echo "Lỗi: " . $stmt->error;
  }

  $stmt->close();
}
$conn->close();
