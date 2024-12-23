<?php
include("../isLogin.php");
include("../partials/navbar.php");
include("../db_connection.php"); // Kết nối CSDL

// Lấy ID đơn đặt bàn từ URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Truy vấn thông tin chi tiết của đơn đặt bàn
$sql = "SELECT r.id, r.customer_name, r.customer_email, r.customer_phone, r.reservation_time, 
               r.guests_count, r.notes, r.status, t.id AS table_id, t.zone 
        FROM reservations r
        LEFT JOIN tables t ON r.table_id = t.id
        WHERE r.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
  $reservation = $result->fetch_assoc();
} else {
  echo "<p>Không tìm thấy đơn đặt bàn.</p>";
  exit();
}
?>
<link rel="stylesheet" href="../css/reset.css">
<link rel="stylesheet" href="../css/style.css">
<style>
  .details-container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background-color: #fff;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }

  .details-container h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
  }

  .details-container p {
    font-size: 16px;
    margin: 10px 0;
  }

  .details-container strong {
    color: #333;
  }

  .back-btn {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 20px;
    font-size: 14px;
    background-color: #3498db;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    transition: background-color 0.3s ease;
  }

  .back-btn:hover {
    background-color: #2980b9;
  }
</style>

<main class="content">
  <div class="details-container">
    <h2>Chi Tiết Đơn Đặt Bàn</h2>
    <p><strong>ID:</strong> <?php echo $reservation['id']; ?></p>
    <p><strong>Tên khách hàng:</strong> <?php echo $reservation['customer_name']; ?></p>
    <p><strong>Email:</strong> <?php echo $reservation['customer_email']; ?></p>
    <p><strong>Điện thoại:</strong> <?php echo $reservation['customer_phone']; ?></p>
    <p><strong>Thời gian đặt bàn:</strong> <?php echo $reservation['reservation_time']; ?></p>
    <p><strong>Số lượng khách:</strong> <?php echo $reservation['guests_count']; ?></p>
    <p><strong>Bàn:</strong> <?php echo $reservation['table_id']; ?> (<?php echo $reservation['zone']; ?>)</p>
    <p><strong>Ghi chú:</strong> <?php echo $reservation['notes'] ? $reservation['notes'] : "Không có"; ?></p>
    <p><strong>Trạng thái:</strong> <?php echo $reservation['status']; ?></p>
    <a href="/hoangkim/admin/manage_reservations.php" class="back-btn">Quay lại</a>
  </div>
</main>