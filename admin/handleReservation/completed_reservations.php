<?php
include("../isLogin.php");
include("../partials/navbar.php");
include("../db_connection.php");

// Thiết lập số lượng đơn đặt bàn trên mỗi trang
$items_per_page = 5;

// Lấy trang hiện tại từ URL, mặc định là trang 1
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $items_per_page;

// Lấy tổng số đơn đặt bàn đã hoàn thành
$total_items_sql = "SELECT COUNT(*) AS total FROM reservations WHERE status = 'Hoàn thành'";
$total_items_result = mysqli_query($conn, $total_items_sql);
$total_items_row = mysqli_fetch_assoc($total_items_result);
$total_items = $total_items_row['total'];

// Tính tổng số trang
$total_pages = ceil($total_items / $items_per_page);

// Lấy danh sách đơn đặt bàn đã hoàn thành cho trang hiện tại
$sql = "SELECT * FROM reservations WHERE status = 'Hoàn thành' ORDER BY reservation_time DESC LIMIT $items_per_page OFFSET $offset";
$result = mysqli_query($conn, $sql);
?>
<link rel="stylesheet" href="../css/reset.css" />
<link rel="stylesheet" href="../css/style.css">
<style>
  /* CSS cho bảng */
  .reservations-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
    font-family: 'Arial', sans-serif;
    background-color: #f9f9f9;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  }

  .reservations-table th,
  .reservations-table td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: center;
  }

  .reservations-table th {
    background-color: #4CAF50;
    color: white;
    font-weight: bold;
    text-transform: uppercase;
  }

  .reservations-table td {
    background-color: #fff;
    color: #333;
  }

  .reservations-table tr:nth-child(even) {
    background-color: #f2f2f2;
  }

  .reservations-table tr:hover {
    background-color: #ddd;
  }

  /* CSS cho phân trang */
  .pagination {
    display: flex;
    justify-content: center;
    margin-top: 20px;
  }

  .pagination-btn {
    margin: 0 5px;
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
  }

  .pagination-btn:hover {
    background-color: #0056b3;
  }

  .pagination-btn.active {
    background-color: #0056b3;
    cursor: default;
  }

  .back-btn {
    background-color: #3498db;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    text-decoration: none;
    margin-bottom: 10px;
    display: inline-block;
  }

  /* CSS cho thông báo lỗi */
  .error-message {
    color: #fff;
    background: #ed3c0d;
    text-align: center;
    padding: 15px;
    font-weight: 600;
    border-radius: 5px;
    margin-bottom: 20px;
  }
</style>
<!-- Main content -->
<main class="content">
  <h1>Đơn đặt bàn đã hoàn thành</h1>
  <a href="/hoangkim/admin/manage_reservations.php" class="back-btn">Quay lại</a>
  <!-- Bảng hiển thị danh sách đơn đặt bàn đã hoàn thành -->
  <div class="reservations-table">
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Tên khách hàng</th>
          <th>Email</th>
          <th>Điện thoại</th>
          <th>Thời gian đặt</th>
          <th>Bàn</th>
          <th>Số lượng khách</th>
          <th>Ghi chú</th>
          <th>Trạng thái</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['customer_name']}</td>
                    <td>{$row['customer_email']}</td>
                    <td>{$row['customer_phone']}</td>
                    <td>{$row['reservation_time']}</td>
                    <td>{$row['table_id']}</td>
                    <td>{$row['guests_count']}</td>
                    <td>{$row['notes']}</td>
                    <td>{$row['status']}</td>
                  </tr>";
          }
        } else {
          echo "<tr><td colspan='9'>Chưa có đơn đặt bàn nào.</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

  <!-- Phân trang -->
  <div class="pagination">
    <?php
    if ($current_page > 1) {
      echo "<a href='completed_reservations.php?page=" . ($current_page - 1) . "' class='pagination-btn'>Trang trước</a>";
    }

    for ($i = 1; $i <= $total_pages; $i++) {
      if ($i == $current_page) {
        echo "<span class='pagination-btn active'>$i</span>";
      } else {
        echo "<a href='completed_reservations.php?page=$i' class='pagination-btn'>$i</a>";
      }
    }

    if ($current_page < $total_pages) {
      echo "<a href='completed_reservations.php?page=" . ($current_page + 1) . "' class='pagination-btn'>Trang sau</a>";
    }
    ?>
  </div>
</main>
</body>

</html>