<?php
include("isLogin.php"); // Kiểm tra đăng nhập
include("./partials/navbar.php"); // Thanh navbar
include("./db_connection.php"); // Kết nối CSDL

// Lấy danh sách các đơn đặt bàn trong trạng thái "Chờ duyệt" và "Đã duyệt"
$sql = "SELECT r.id, r.customer_name, r.customer_phone, r.guests_count, r.status, t.id AS table_id, t.zone 
        FROM reservations r 
        LEFT JOIN tables t ON r.table_id = t.id 
        WHERE r.status IN ('Chờ duyệt', 'Đã duyệt')
        ORDER BY r.id DESC";
$result = $conn->query($sql);
?>
<link rel="stylesheet" href="./css/reset.css">
<link rel="stylesheet" href="./css/style.css">
<style>
  .cards-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-top: 20px;
  }

  .card {
    width: 300px;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 20px;
    background-color: #fff;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .card h3 {
    margin-bottom: 10px;
    color: #333;
  }

  .card p {
    margin: 5px 0;
    color: #555;
  }

  .status-choduyet {
    background-color: #f39c12;
    color: white;
    padding: 5px 10px;
    border-radius: 4px;
    text-align: center;
  }

  .status-daduyet {
    background-color: #2ecc71;
    color: white;
    padding: 5px 10px;
    border-radius: 4px;
    text-align: center;
  }

  .status-huyban {
    background-color: #e74c3c;
    color: white;
    padding: 5px 10px;
    border-radius: 4px;
    text-align: center;
  }

  .status-hoanthanh {
    background-color: #3498db;
    color: white;
    padding: 5px 10px;
    border-radius: 4px;
    text-align: center;
  }

  .actions form {
    display: inline-block;
  }

  .actions button {
    padding: 8px 12px;
    border: none;
    border-radius: 4px;
    color: white;
    cursor: pointer;
    margin-right: 5px;
  }

  .btn-approve {
    background-color: #2ecc71;
  }

  .btn-approve.disabled {
    background-color: #95a5a6;
    cursor: not-allowed;
  }

  .btn-cancel {
    background-color: #e74c3c;
  }

  .btn-complete {
    background-color: #3498db;
    margin-top: 5px;
  }

  .buttons {
    margin-bottom: 20px;
  }

  .btn-secondary {
    background-color: #3498db;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    text-decoration: none;
    margin-bottom: 10px;
    display: inline-block;
  }

  .btn-secondary:hover {
    background-color: #5a6268;
  }

  .btn-approve:hover,
  .btn-cancel:hover,
  .btn-complete:hover {
    opacity: 0.7;
  }
</style>

<main class="content">
  <h1>Quản Lý Đặt Bàn</h1>

  <!-- Nút dẫn tới các trang khác -->
  <div class="buttons">
    <a href="/hoangkim/admin/handleReservation/cancelled_reservations.php" class="btn btn-secondary">Đơn đặt bàn đã hủy</a>
    <a href="/hoangkim/admin/handleReservation/completed_reservations.php" class="btn btn-secondary">Đơn đặt bàn đã hoàn thành</a>
  </div>

  <div class="cards-container">
    <?php
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $status_class = match ($row['status']) {
          'Chờ duyệt' => 'status-choduyet',
          'Đã duyệt' => 'status-daduyet',
          'Hủy bàn' => 'status-huyban',
          'Hoàn Thành' => 'status-hoanthanh',
        };

        // Nút "Duyệt bàn" chỉ khả dụng khi trạng thái là "Chờ duyệt"
        $disable_approve = $row['status'] === 'Đã duyệt' ? 'disabled' : '';
        echo "
          <div class='card'>
            <h3>{$row['customer_name']}</h3>
            <p>Điện thoại: {$row['customer_phone']}</p>
            <p>Số khách: {$row['guests_count']}</p>
            <p>Bàn: {$row['table_id']} ({$row['zone']})</p>
            <p class='{$status_class}'>{$row['status']}</p>
            <a href='/hoangkim/admin/handleReservation/reservation_details.php?id={$row['id']}' class=' btn-secondary'>Xem chi tiết</a>
            <div class='actions'>
              <form action='/hoangkim/admin/handleReservation/update_reservation.php' method='POST'>
                <input type='hidden' name='id' value='{$row['id']}'>
                <input type='hidden' name='status' value='Đã duyệt'>
                <button class='btn-approve {$disable_approve}' type='submit' {$disable_approve}>Duyệt bàn</button>
              </form>
              <form action='/hoangkim/admin/handleReservation/update_reservation.php' method='POST'>
                <input type='hidden' name='id' value='{$row['id']}'>
                <input type='hidden' name='status' value='Hủy bàn'>
                <button class='btn-cancel' type='submit'>Hủy bàn</button>
              </form>
              <form action='/hoangkim/admin/handleReservation/update_reservation.php' method='POST'>
                <input type='hidden' name='id' value='{$row['id']}'>
                <input type='hidden' name='status' value='Hoàn thành'>
                <button class='btn-complete' type='submit'>Hoàn thành</button>
              </form>
            </div>
          </div>
        ";
      }
    } else {
      echo "<p>Chưa có đơn đặt bàn nào.</p>";
    }
    ?>
  </div>
</main>