<link rel="stylesheet" href="./css/reset.css" />
<link rel="stylesheet" href="./css/style.css">
<link rel="stylesheet" href="./css/index.css">
<?php
include("isLogin.php");
include("./partials/navbar.php");
include("./db_connection.php"); // 

// 1. Thống kê Bàn
$sql_tables_zone = "SELECT zone, COUNT(*) AS total FROM tables GROUP BY zone";
$result_tables_zone = $conn->query($sql_tables_zone);

$sql_tables_status = "SELECT status, COUNT(*) AS total FROM tables GROUP BY status";
$result_tables_status = $conn->query($sql_tables_status);

// 2. Thống kê Đặt Bàn
$sql_reservations_status = "SELECT status, COUNT(*) AS total FROM reservations GROUP BY status";
$result_reservations_status = $conn->query($sql_reservations_status);

$sql_reservations_today = "SELECT COUNT(*) AS total_today FROM reservations WHERE DATE(reservation_time) = CURDATE()";
$result_reservations_today = $conn->query($sql_reservations_today);
$total_reservations_today = $result_reservations_today->fetch_assoc()['total_today'];

// 3. Thống kê Món Ăn
$sql_menu_categories = "SELECT category, COUNT(*) AS total FROM menu_items GROUP BY category";
$result_menu_categories = $conn->query($sql_menu_categories);

// 4. Thống kê Đánh Giá
// Thống kê tổng số đánh giá
$sql_reviews_total = "SELECT COUNT(*) AS total_reviews FROM reviews";
$result_reviews_total = $conn->query($sql_reviews_total);
$total_reviews = $result_reviews_total->fetch_assoc()['total_reviews'];

?>
<!-- Main content -->
<main class="content">
    <h1 class="heading_index">Tổng Quan</h1>
    <div class="dashboard">

        <!-- Thống kê Bàn -->
        <div class="dashboard-card">
            <h3>Bàn</h3>
            <ul>
                <?php while ($row = $result_tables_zone->fetch_assoc()) { ?>
                    <li><?php echo ucfirst($row['zone']); ?>: <strong><?php echo $row['total']; ?></strong></li>
                <?php } ?>
            </ul>
            <ul>
                <?php while ($row = $result_tables_status->fetch_assoc()) { ?>
                    <li>Bàn <?php echo $row['status']; ?>: <strong><?php echo $row['total']; ?></strong></li>
                <?php } ?>
            </ul>
            <a href="manage_tables.php" class="view-details">Xem chi tiết</a>
        </div>

        <!-- Thống kê Đặt Bàn -->
        <div class="dashboard-card">
            <h3>Đặt Bàn</h3>
            <ul>
                <?php while ($row = $result_reservations_status->fetch_assoc()) { ?>
                    <li><?php echo ucfirst($row['status']); ?>: <strong><?php echo $row['total']; ?></strong></li>
                <?php } ?>
            </ul>
            <p>Hôm nay: <strong><?php echo $total_reservations_today; ?></strong></p>
            <a href="manage_reservations.php" class="view-details">Xem chi tiết</a>
        </div>

        <!-- Thống kê Món Ăn -->
        <div class="dashboard-card">
            <h3>Món Ăn</h3>
            <ul>
                <?php while ($row = $result_menu_categories->fetch_assoc()) { ?>
                    <li><?php echo ucfirst($row['category']); ?>: <strong><?php echo $row['total']; ?></strong></li>
                <?php } ?>
            </ul>
            <a href="manage_menu_items.php" class="view-details">Xem chi tiết</a>
        </div>
        <div class="dashboard-card">
            <h3>Đánh Giá</h3>
            <p>Tổng số đánh giá: <strong><?php echo $total_reviews; ?></strong></p>
            <a href="manage_reviews.php" class="view-details">Xem chi tiết</a>
        </div>
    </div>
</main>
</body>

</html>