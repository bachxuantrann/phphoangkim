<?php

include("../isLogin.php");
if ($_SESSION['user_role'] !== 'superadmin') {
  echo "Bạn không có quyền thực hiện hành động này!";
  exit();
}
include("../partials/navbar.php");
include("../db_connection.php");
?>
<link rel="stylesheet" href="../css/reset.css" />
<style type="text/css">
  .content .content-heading {
    margin-bottom: 20px;
    color: #333;
  }

  .content form {
    display: flex;
    flex-direction: column;
    gap: 15px;
  }

  .content form label {
    font-weight: bold;
  }

  .content form input,
  .content form select,
  .content form button {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    width: 100%;
  }

  .content form button {
    background-color: #3498db;
    color: #fff;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  .content form button:hover {
    background-color: #2980b9;
  }
</style>
<link rel="stylesheet" href="../css/style.css">
<!-- Main content -->

<main class="content">
  <h1 class="content-heading">Sửa tài khoản Admin</h1>
  <?php
  $id = $_GET['id']; // Lấy ID admin từ URL

  $sql = "SELECT * FROM admins WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $admin = $result->fetch_assoc();
  } else {
    echo "Không tìm thấy admin!";
    exit();
  }
  ?>
  <form action="update_admin.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $admin['id']; ?>">
    <label for="username">Tài khoản:</label>
    <input type="text" name="username" value="<?php echo $admin['username']; ?>" required>
    <label for="email">Email:</label>
    <input type="email" name="email" value="<?php echo $admin['email']; ?>" required>
    <label for="password">Mật khẩu mới:</label>
    <input type="password" name="password" required>
    <label for="phone">Số điện thoại:</label>
    <input type="text" name="phone" value="<?php echo $admin['phone']; ?>" required>
    <label for="role">Vai trò:</label>
    <select name="role">
      <option value="admin" <?php if ($admin['role'] === 'admin') echo 'selected'; ?>>Admin</option>
      <option value="superadmin" <?php if ($admin['role'] === 'superadmin') echo 'selected'; ?>>Superadmin</option>
    </select>
    <button type="submit">Cập nhật</button>
  </form>
</main>
</body>

</html>