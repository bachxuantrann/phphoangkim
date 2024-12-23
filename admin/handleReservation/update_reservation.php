<?php
include("../db_connection.php");
include("../isLogin.php");


// Kiểm tra yêu cầu POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $id = intval($_POST['id']);
  $status = $_POST['status'];

  // Lấy ID bàn từ đơn đặt bàn
  $sql_get_table = "SELECT table_id FROM reservations WHERE id = ?";
  $stmt = $conn->prepare($sql_get_table);
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();
  $table_id = $result->fetch_assoc()['table_id'];

  // Cập nhật trạng thái đơn đặt bàn
  $sql_update_reservation = "UPDATE reservations SET status = ? WHERE id = ?";
  $stmt = $conn->prepare($sql_update_reservation);
  $stmt->bind_param("si", $status, $id);
  $success = $stmt->execute();

  // Cập nhật trạng thái bàn
  if ($success) {
    $table_status = match ($status) {
      'Đã duyệt' => 'đã đặt',
      'Hủy bàn', 'Hoàn thành' => 'trống',
      default => 'trống',
    };

    $sql_update_table = "UPDATE tables SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql_update_table);
    $stmt->bind_param("si", $table_status, $table_id);
    $stmt->execute();
  }

  // Quay lại trang quản lý đặt bàn
  header("Location: ../manage_reservations.php");
  exit();
}
