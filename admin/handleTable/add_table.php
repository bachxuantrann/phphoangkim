<?php
include("../isLogin.php");
include("../db_connection.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $capacity = intval($_POST['capacity']);
  $zone = $_POST['zone'];

  $sql = "INSERT INTO tables (capacity, zone) VALUES (?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("is", $capacity, $zone);

  if ($stmt->execute()) {
    header("Location: ../manage_tables.php");
    exit();
  } else {
    echo "Lỗi: " . $stmt->error;
  }
  $stmt->close();
} else $stmt->close();
