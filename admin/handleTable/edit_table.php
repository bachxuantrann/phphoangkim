<link rel="stylesheet" href="../css/reset.css" />
<link rel="stylesheet" href="../css/style.css">
<?php
include("../isLogin.php");
include("../db_connection.php");
include("../partials/navbar.php");
$id = intval($_GET['id']);
$sql = "SELECT * FROM tables WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
  $table = $result->fetch_assoc();
} else {
  echo "Không tìm thấy bàn!";
  exit();
}
?>
<style>
  /* Giao diện form sửa bàn */
  .edit-table-form {
    max-width: 400px;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background-color: #ffffff;
  }

  .edit-table-form h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
  }

  .form-group {
    margin-bottom: 15px;
  }

  .form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #555;
  }

  .form-group input,
  .form-group select {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ddd;
    border-radius: 4px;
    transition: all 0.3s ease;
  }

  .form-group input:focus,
  .form-group select:focus {
    border-color: #3498db;
    outline: none;
    box-shadow: 0 0 5px rgba(52, 152, 219, 0.5);
  }

  /* Nút Submit */
  .btn-submit {
    width: 100%;
    padding: 12px 15px;
    background-color: #3498db;
    color: #fff;
    font-size: 16px;
    font-weight: bold;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  .btn-submit:hover {
    background-color: #2980b9;
  }
</style>

<main class="content">
  <h2>Sửa Thông Tin Bàn</h2>
  <form action="update_table.php" method="POST" class="edit-table-form">
    <input type="hidden" name="id" value="<?php echo $table['id']; ?>">
    <div class="form-group">
      <label for="id"><?php echo "Bàn " . $table['id']; ?></label>
    </div>
    <div class="form-group">
      <label for="capacity">Số chỗ:</label>
      <input type="number" name="capacity" value="<?php echo $table['capacity']; ?>" placeholder="Nhập số chỗ ngồi..." required>
    </div>

    <div class="form-group">
      <label for="zone">Khu vực:</label>
      <select name="zone" required>
        <option value="trong nhà" <?php if ($table['zone'] === 'trong nhà') echo 'selected'; ?>>Trong nhà</option>
        <option value="ngoài trời" <?php if ($table['zone'] === 'ngoài trời') echo 'selected'; ?>>Ngoài trời</option>
        <option value="vip" <?php if ($table['zone'] === 'vip') echo 'selected'; ?>>VIP</option>
      </select>
    </div>

    <button type="submit" class="btn-submit">Cập nhật</button>
  </form>

</main>