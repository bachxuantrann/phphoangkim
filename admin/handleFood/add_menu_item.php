<?php
include("../db_connection.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $price = $_POST['price'];
  $subContent = $_POST['subContent'];
  $mainContent = $_POST['mainContent'];
  $category = $_POST['category'];
  $display = isset($_POST['display']) ? 1 : 0;
  $feature = isset($_POST['feature']) ? 1 : 0;

  // Xử lý upload hình ảnh
  $target_dir = "../uploads/";
  $target_file = $target_dir . basename($_FILES["image"]["name"]);

  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    $sql = "INSERT INTO menu_items (name, price, subContent, mainContent, image, category, display, feature) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdssssii", $name, $price, $subContent, $mainContent, $target_file, $category, $display, $feature);

    if ($stmt->execute()) {
      header("Location: ../manage_menu_items.php");
      exit();
    } else {
      echo "Lỗi: " . $stmt->error;
    }

    $stmt->close();
  } else {
    echo "Lỗi khi tải lên hình ảnh.";
  }
}
$conn->close();
