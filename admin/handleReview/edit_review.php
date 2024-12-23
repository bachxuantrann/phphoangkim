<?php
include("../isLogin.php");

include("../partials/navbar.php");
include("../db_connection.php");
?>
<link rel="stylesheet" href="../css/reset.css" />
<link rel="stylesheet" href="../css/style.css">
<style>
  h1 {
    margin-bottom: 20px;
    color: #333;
    font-weight: 500;
    font-size: 25px;
  }

  form {
    display: flex;
    flex-direction: column;
    gap: 15px;
  }

  form label {
    font-weight: bold;
    color: #333;
  }

  form input[type="text"],
  form textarea {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    width: 100%;
  }

  form textarea {
    resize: vertical;
    height: 150px;
  }

  form button {
    padding: 10px 20px;
    background-color: #3498db;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
  }

  form button:hover {
    background-color: #2980b9;
  }
</style>
<!-- Main content -->

<main class="content">
  <h1>Sửa đánh giá</h1>
  <?php
  $id = $_GET['id']; // Lấy ID đánh giá từ URL

  $sql = "SELECT * FROM reviews WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $review = $result->fetch_assoc();
  } else {
    echo "Không tìm thấy đánh giá!";
    exit();
  }
  ?>
  <form action="update_review.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $review['id']; ?>">
    <label for="username">Tên người dùng:</label>
    <input type="text" name="username" value="<?php echo $review['name']; ?>" required>
    <label for="profession">Nghề nghiệp:</label>
    <input type="text" name="profession" value="<?php echo $review['profession']; ?>" required>
    <label for="content">Nội dung:</label>
    <textarea name="content" required><?php echo $review['content']; ?></textarea>
    <button type="submit">Cập nhật</button>
  </form>
</main>
</body>

</html>