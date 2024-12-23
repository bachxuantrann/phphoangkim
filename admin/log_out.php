<?php
session_start(); // Bắt đầu session

// Xóa toàn bộ session
session_unset(); // Hủy tất cả biến session
session_destroy(); // Hủy session hiện tại

// Chuyển hướng đến trang đăng nhập
header("Location: login.php");
exit();
