<?php
include("../db_connection.php"); // Kết nối cơ sở dữ liệu

// Kiểm tra dữ liệu POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $id = intval($_POST['id']);
  $page = intval($_POST['page']); // Lấy giá trị page từ POST
  $name = $_POST['name'];
  $price = $_POST['price'];
  $subContent = $_POST['subContent'];
  $mainContent = $_POST['mainContent'];
  $category = $_POST['category'];
  $display = isset($_POST['display']) ? 1 : 0;
  $feature = isset($_POST['feature']) ? 1 : 0;

  // Xử lý ảnh nếu có ảnh mới được upload
  if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $image_name = basename($_FILES['image']['name']);
    $target_dir = "../uploads/";
    $target_file = $target_dir . $image_name;

    // Di chuyển file ảnh vào thư mục uploads
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
      $image_sql = ", image = ?";
    } else {
      echo "Lỗi khi tải lên ảnh!";
      exit();
    }
  } else {
    $image_sql = ""; // Không cập nhật ảnh nếu không có ảnh mới
  }

  // Cập nhật thông tin món ăn
  $sql = "UPDATE menu_items SET 
                name = ?, 
                price = ?, 
                subContent = ?, 
                mainContent = ?, 
                category = ?, 
                display = ?, 
                feature = ? 
                $image_sql 
            WHERE id = ?";

  $stmt = $conn->prepare($sql);

  if ($image_sql) {
    $stmt->bind_param("sdsssiisi", $name, $price, $subContent, $mainContent, $category, $display, $feature, $image_name, $id);
  } else {
    $stmt->bind_param("sdsssiii", $name, $price, $subContent, $mainContent, $category, $display, $feature, $id);
  }

  if ($stmt->execute()) {
    // Chuyển hướng về đúng trang sản phẩm dựa vào biến `page`
    header("Location: ../manage_menu_items.php?page={$page}");
    exit();
  } else {
    echo "Lỗi: " . $stmt->error;
  }
} else {
  // Nếu truy cập trực tiếp vào link chỉnh sửa
  header("Location: ../manage_menu_items.php");
  exit();
}
