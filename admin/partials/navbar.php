<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Quản lý nhà hàng</title>
  <!-- Reset CSS -->
  <link rel="stylesheet" href="./css/reset.css" />
  <!-- End Reset CSS -->
  <!-- GG font -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet" />
  <!-- End GG font -->
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <!-- Style css -->
  <link rel="stylesheet" href="../css/style.css" />
</head>

<body>
  <!-- Sidebar -->
  <aside class="sidebar">
    <div class="admin-info">
      <p style="margin-bottom: 10px;"><strong>Xin chào:</strong> <?php echo $_SESSION['username']; ?></p>
      <p><strong>Vai trò:</strong> <?php echo ucfirst($_SESSION['user_role']); ?></p>
    </div>
    <h2 class="heading" style="color:#fff !important">Quản lý <br>Hoàng Kim</h2>
    <ul>
      <li><a href="/hoangkim/admin/index.php"><i class="fas fa-tachometer-alt"></i> Tổng Quan</a></li>
      <li><a href="/hoangkim/admin/manage_tables.php"><i class="fas fa-table"></i> Quản lý bàn</a></li>
      <li><a href="/hoangkim/admin/manage_reservations.php"><i class="fas fa-calendar-check"></i> Quản lý đặt bàn</a></li>
      <li><a href="/hoangkim/admin/manage_menu_items.php"><i class="fas fa-utensils"></i> Quản lý món ăn</a></li>
      <li><a href="/hoangkim/admin/manage_reviews.php"><i class="fas fa-star"></i> Quản lý đánh giá</a></li>
      <li><a href="/hoangkim/admin/manage_admins.php"><i class="fas fa-user-shield"></i> Quản lý admin</a></li>
      <li><a href="/hoangkim/admin/log_out.php"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a></li>
    </ul>
  </aside>
</body>

</html>