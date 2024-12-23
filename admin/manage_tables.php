<?php
include("isLogin.php");
include("./db_connection.php");
include("./partials/navbar.php");
$sql = "SELECT * FROM tables ORDER BY id ASC";
$result = $conn->query($sql);
?>
<link rel="stylesheet" href="./css/style.css">
<link rel="stylesheet" href="./css/table.css">

<!-- Main content -->
<main class="content">
  <h1>Quản Lý Bàn</h1>
  <!-- Nút Thêm Bàn Mới -->
  <button id="openModalBtn" class="btn-add">Thêm Bàn Mới</button>
  <!-- Modal Thêm Bàn -->
  <div id="addTableModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2>Thêm Bàn Mới</h2>
      <form action="/hoangkim/admin/handleTable/add_table.php" method="POST">
        <div class="form-group">
          <label for="capacity">Số chỗ:</label>
          <input type="number" name="capacity" min="1" placeholder="Nhập số chỗ ngồi..." required>
        </div>
        <div class="form-group">
          <label for="zone">Khu vực:</label>
          <select name="zone" required>
            <option value="trong nhà">Trong nhà</option>
            <option value="ngoài trời">Ngoài trời</option>
            <option value="vip">VIP</option>
          </select>
        </div>
        <button type="submit" class="btn-submit">Thêm Bàn</button>
      </form>
    </div>
  </div>


  <div class="cards-container">
    <?php
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $status_class = $row['status'] === 'trống' ? 'status-trong' : 'status-dadat';
        echo "
          <div class='card'>
            <h3>Bàn Số: {$row['id']}</h3>
            <p>Số chỗ: {$row['capacity']} chỗ</p>
            <p>Khu vực: {$row['zone']}</p>
            <p class='{$status_class}'>Trạng thái: {$row['status']}</p>
            <div class='actions'>
              <a href='/hoangkim/admin/handleTable/edit_table.php?id={$row['id']}' class='btn-edit'>Sửa</a>
              <a href='/hoangkim/admin/handleTable/delete_table.php?id={$row['id']}' class='btn-delete'>Xóa</a>
            </div>
          </div>
        ";
      }
    } else {
      echo "<p>Chưa có bàn nào trong hệ thống.</p>";
    }
    ?>
  </div>


</main>
</body>
<script>
  // Lấy các phần tử cần thiết
  const modal = document.getElementById("addTableModal");
  const openModalBtn = document.getElementById("openModalBtn");
  const closeModalBtn = document.querySelector(".close");

  // Mở modal khi nhấn nút Thêm Bàn Mới
  openModalBtn.onclick = function() {
    modal.style.display = "block";
  };

  // Đóng modal khi nhấn biểu tượng X
  closeModalBtn.onclick = function() {
    modal.style.display = "none";
  };

  // Đóng modal khi nhấn ra ngoài modal
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  };
</script>


</html>