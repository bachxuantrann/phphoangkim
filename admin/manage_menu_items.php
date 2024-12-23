<?php
include("isLogin.php");
include("./partials/navbar.php");
include("./db_connection.php");


// Thiết lập số lượng món ăn trên mỗi trang
$items_per_page = 3;

// Lấy trang hiện tại từ URL, mặc định là trang 1
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $items_per_page;

// Lấy tổng số món ăn
$total_items_sql = "SELECT COUNT(*) AS total FROM menu_items";
$total_items_result = mysqli_query($conn, $total_items_sql);
$total_items_row = mysqli_fetch_assoc($total_items_result);
$total_items = $total_items_row['total'];

// Tính tổng số trang
$total_pages = ceil($total_items / $items_per_page);

// Lấy danh sách món ăn cho trang hiện tại
$sql = "SELECT * FROM menu_items ORDER BY id ASC LIMIT $items_per_page OFFSET $offset";
$result = mysqli_query($conn, $sql);
?>

<link rel="stylesheet" href="./css/food.css">
<link rel="stylesheet" href="./css/style.css">
<!-- Main content -->
<main class="content">
  <h1>Quản lý món ăn</h1>

  <!-- Bảng hiển thị danh sách món ăn -->
  <div class="menu-table">
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Hình ảnh</th>
          <th>Tên món ăn</th>
          <th>Giá</th>
          <th>Mô tả ngắn</th>
          <th>Loại món ăn</th>
          <th>Hiển thị</th>
          <th>Nổi bật</th>
          <th>Hành động</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td><img src='uploads/{$row['image']}' alt='{$row['name']}' class='menu-image'></td>
                    <td>{$row['name']}</td>
                    <td>{$row['price']}</td>
                    <td>{$row['subContent']}</td>
                    <td>{$row['category']}</td>
                    <td>" . ($row['display'] ? 'Có' : 'Không') . "</td>
                    <td>" . ($row['feature'] ? 'Có' : 'Không') . "</td>
                    <td class='menu-action'>
                      <a href='/hoangkim/admin/handleFood/edit_menu_item.php?id={$row['id']}&page={$current_page}' class='edit-btn'>Sửa</a>
                      <a href='/hoangkim/admin/handleFood/delete_menu_item.php?id={$row['id']}&page={$current_page}' class='delete-btn'>Xóa</a>
                    </td>
                  </tr>";
          }
        } else {
          echo "<tr><td colspan='9'>Chưa có món ăn nào.</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

  <!-- Phân trang -->
  <div class="pagination">
    <?php
    if ($current_page > 1) {
      echo "<a href='manage_menu_items.php?page=" . ($current_page - 1) . "' class='pagination-btn'>Trang trước</a>";
    }

    for ($i = 1; $i <= $total_pages; $i++) {
      if ($i == $current_page) {
        echo "<span class='pagination-btn active'>$i</span>";
      } else {
        echo "<a href='manage_menu_items.php?page=$i' class='pagination-btn'>$i</a>";
      }
    }

    if ($current_page < $total_pages) {
      echo "<a href='manage_menu_items.php?page=" . ($current_page + 1) . "' class='pagination-btn'>Trang sau</a>";
    }
    ?>
  </div>

  <!-- Form thêm món ăn mới -->
  <div class="add-menu-item">
    <h2>Thêm món ăn mới</h2>
    <form action="/hoangkim/admin/handleFood/add_menu_item.php" method="POST" enctype="multipart/form-data">
      <input type="text" name="name" placeholder="Tên món ăn" required />
      <input type="number" step="0.01" name="price" placeholder="Giá" required />
      <input type="text" name="subContent" placeholder="Mô tả ngắn" required />
      <textarea name="mainContent" placeholder="Nội dung chi tiết" required></textarea>
      <input type="file" name="image" required />
      <select name="category" required>
        <option value="Khai Vị">Khai vị</option>
        <option value="Món Chính">Món chính</option>
        <option value="Tráng Miệng">Tráng miệng</option>
      </select>
      <label for="display">Hiển thị:</label>
      <input type="checkbox" name="display" checked />
      <label for="feature">Nổi bật:</label>
      <input type="checkbox" name="feature" />
      <button type="submit">Thêm món ăn</button>
    </form>
  </div>
</main>
</body>

</html>