<?php

include("../isLogin.php");
include("../db_connection.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $profession = $_POST['profession'];
  $content = $_POST['content'];
  $sql = "INSERT INTO reviews (name, profession, content) VALUES (?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sss", $username, $profession, $content);
  if ($stmt->execute()) {
    echo "Thêm đánh giá thành công";
    header("Location: ../manage_reviews.php");
    exit();
  } else {
    echo "Lỗi: " . $stmt->error;
  }
  $stmt->close();
}
$conn->close();
