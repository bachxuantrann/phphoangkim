<?php
include("../isLogin.php"); // Kiểm tra đăng nhập
include("../partials/navbar.php"); // Giao diện thanh điều hướng
include("../db_connection.php"); // Kết nối cơ sở dữ liệu
?>
<link rel="stylesheet" href="../css/reset.css" />
<link rel="stylesheet" href="../css/style.css" />
<style>
  h1 {
    margin-bottom: 20px;
    color: #333;
  }

  form {
    display: flex;
    flex-direction: column;
    gap: 15px;
  }

  form label {
    font-weight: bold;
  }

  form input,
  form select,
  form textarea,
  form button {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    width: 100%;
  }

  form button {
    background-color: #3498db;
    color: #fff;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  form button:hover {
    background-color: #2980b9;
  }
</style>

<main class="content">
  <h1>Sửa món ăn</h1>
  <?php
  // Lấy ID món ăn từ URL
  $id = $_GET['id'];
  $current_page = $_GET['page'];
  // Truy vấn thông tin món ăn
  $sql = "SELECT * FROM menu_items WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $menu_item = $result->fetch_assoc();
  } else {
    echo "Không tìm thấy món ăn!";
    exit();
  }
  ?>
  <form action="update_menu_item.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $menu_item['id']; ?>">
    <input type="hidden" name="page" value="<?php echo $current_page ?>">
    <label for="name">Tên món ăn:</label>
    <input type="text" name="name" value="<?php echo $menu_item['name']; ?>" required>

    <label for="price">Giá:</label>
    <input type="number" step="0.01" name="price" value="<?php echo $menu_item['price']; ?>" required>

    <label for="subContent">Mô tả ngắn:</label>
    <input type="text" name="subContent" value="<?php echo $menu_item['subContent']; ?>" required>

    <label for="mainContent">Nội dung chi tiết:</label>
    <textarea name="mainContent" required><?php echo $menu_item['mainContent']; ?></textarea>

    <label for="category">Loại món ăn:</label>
    <select name="category" required>
      <option value="Khai Vị" <?php if ($menu_item['category'] === 'Khai Vị') echo 'selected'; ?>>Khai vị</option>
      <option value="Món Chính" <?php if ($menu_item['category'] === 'Món Chính') echo 'selected'; ?>>Món chính</option>
      <option value="Tráng Miệng" <?php if ($menu_item['category'] === 'Tráng Miệng') echo 'selected'; ?>>Tráng miệng</option>
    </select>

    <label for="display">Hiển thị:</label>
    <input type="checkbox" name="display" <?php if ($menu_item['display']) echo 'checked'; ?>>

    <label for="feature">Nổi bật:</label>
    <input type="checkbox" name="feature" <?php if ($menu_item['feature']) echo 'checked'; ?>>

    <label for="image">Hình ảnh (Giữ nguyên nếu không cập nhật):</label>
    <input type="file" name="image">

    <button type="submit">Cập nhật</button>
  </form>
</main>
</body>

</html>