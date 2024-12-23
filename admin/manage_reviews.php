<?php
include("isLogin.php");
include("./partials/navbar.php");
include("./db_connection.php");
?>
<link rel="stylesheet" href="./css/style.css">
<link rel="stylesheet" href="./css/review.css">
<!-- Main content -->
<main class="content">
  <h1>Quản lý đánh giá</h1>

  <!-- Bảng hiển thị danh sách đánh giá -->
  <div class="reviews-table">
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Tên người dùng</th>
          <th>Nghề nghiệp</th>
          <th>Nội dung</th>
          <th>Hành động</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Lấy danh sách đánh giá từ database
        $sql = "SELECT * FROM reviews ORDER BY id ASC";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['profession']}</td>
                    <td>{$row['content']}</td>
                    <td>
                      <a href='/hoangkim/admin/handleReview/edit_review.php?id={$row['id']}' class='edit-btn'>Sửa</a>
                      <a href='/hoangkim/admin/handleReview/delete_review.php?id={$row['id']}' class='delete-btn'>Xóa</a>
                    </td>
                  </tr>";
          }
        } else {
          echo "<tr><td colspan='5'>Chưa có đánh giá nào.</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

  <!-- Form thêm đánh giá mới -->
  <div class="add-review">
    <h2>Thêm đánh giá mới</h2>
    <form action="/hoangkim/admin/handleReview/add_review.php" method="POST">
      <input type="text" name="username" placeholder="Tên người dùng" required />
      <input type="text" name="profession" placeholder="Nghề nghiệp" required />
      <textarea name="content" placeholder="Nội dung đánh giá" required></textarea>
      <button type="submit">Thêm đánh giá</button>
    </form>
  </div>
</main>

</body>
<script>
  document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', function() {
      const adminId = this.getAttribute('data-id');
      if (confirm('Bạn có chắc chắn muốn xóa đánh giá này không?')) {
        // Chuyển hướng đến trang xóa admin với ID tương ứng
        window.location.href = `/hoangkim/admin/handleReview/delete_review.php?id={$row['id']}`;
      }
    });
  });
</script>

</html>