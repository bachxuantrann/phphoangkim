<?php
include("../isLogin.php");
include("../db_connection.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $id = intval($_POST['id']);
  $capacity = intval($_POST['capacity']);
  $zone = $_POST['zone'];

  $sql = "UPDATE tables SET capacity = ?, zone = ? WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("isi", $capacity, $zone, $id);

  if ($stmt->execute()) {
    header("Location: ../manage_tables.php");
    exit();
  } else {
    echo "Lỗi: " . $stmt->error;
  }
  $stmt->close();
} else $stmt->close();
