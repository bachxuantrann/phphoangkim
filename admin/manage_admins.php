<!-- include navbar -->

<link rel="stylesheet" href="./css/admin.css">
<?php

include("isLogin.php");
include("./partials/navbar.php");
include("./db_connection.php");
$is_superadmin = $_SESSION['user_role'] === 'superadmin';
?>
<link rel="stylesheet" href="./css/style.css">
<!-- CSS Admin page -->

<!-- Main content -->

<main class="content">
  <h1>Quản lý tài khoản Admin</h1>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Tài khoản</th>
        <th>Email</th>
        <th>Số điện thoại</th>
        <th>Vai trò</th>
        <th>Thời gian tạo</th>
        <th>Hành động</th>
      </tr>
    </thead>
    <tbody> <!-- Dữ liệu sẽ được lấy từ PHP -->
      <?php
      $sql = "SELECT * FROM admins";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['username']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['phone']}</td>
                    <td>{$row['role']}</td>
                    <td>{$row['created_at']}</td>
                    <td>";

          // Chỉ hiển thị nút sửa/xóa nếu người dùng là superadmin
          if ($is_superadmin) {
            echo "<button class='edit-btn' data-id='{$row['id']}'>Sửa</button>
                      <button class='delete-btn' data-id='{$row['id']}'>Xóa</button>";
          } else {
            echo "Chỉ xem"; // Admin thường chỉ có thể xem
          }

          echo "</td></tr>";
        }
      } else {
        echo "<tr><td colspan='7'>Không có dữ liệu</td></tr>";
      }

      $conn->close(); // Đóng kết nối
      ?>
    </tbody>
  </table>
  <?php if ($is_superadmin): ?>
    <button id="openModalBtn" style="margin-top: 15px !important;">Thêm tài khoản Admin</button>
  <?php endif; ?>
</main> <!-- Modal Form -->
<div id="myModal" class="modal">
  <div class="modal-content"> <span class="close">&times;</span>
    <h2 class="heading">Thêm tài khoản Admin</h2>
    <form action="/hoangkim/admin/handleAdmin/add_admin.php" method="POST">
      <label for="username">Tài khoản:</label>
      <input type="text" name="username" required>
      <label for="email">Email:</label>
      <input type="email" name="email" required>
      <label for="phone">Số điện thoại:</label>
      <input type="text" name="phone" required>
      <label for="password">Mật khẩu:</label>
      <input type="password" name="password" required>
      <label for="role">Vai trò:</label> <select name="role">
        <option value="admin">Admin</option>
        <option value="superadmin">Superadmin</option>
      </select> <button type="submit">Thêm</button>
    </form>
  </div>
</div>
<script>
  // Get the modal
  var modal = document.getElementById("myModal");
  var btn = document.getElementById("openModalBtn");
  var span = document.getElementsByClassName("close")[0];
  btn.onclick = function() {
    modal.style.display = "block";
  }
  span.onclick = function() {
    modal.style.display = "none";
  }
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
  document.querySelectorAll('.edit-btn').forEach(button => {
    button.addEventListener('click', function() {
      const adminId = this.getAttribute('data-id');
      // Chuyển hướng đến trang sửa admin với ID tương ứng
      window.location.href = `/hoangkim/admin/handleAdmin/edit_admin.php?id=${adminId}`;
    });
  });
  document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', function() {
      const adminId = this.getAttribute('data-id');
      if (confirm('Bạn có chắc chắn muốn xóa tài khoản này không?')) {
        // Chuyển hướng đến trang xóa admin với ID tương ứng
        window.location.href = `/hoangkim/admin/handleAdmin/delete_admin.php?id=${adminId}`;
      }
    });
  });
</script>
</body>

</html>