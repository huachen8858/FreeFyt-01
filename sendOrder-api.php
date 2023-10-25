<?php

require './parts/connect_db.php';

header('Content-Type: application/json');

$output = [
  'postData' => $_POST,
  'success' => false,
  'errors' => [],
];

$product_sid = isset($_POST['product_sid']) ? intval($_POST['product_sid']) : 0 ;
$price = isset($_POST['price']) ? intval($_POST['price']) : 0 ;
$qty = isset($_POST['qty']) ? intval($_POST['qty']) : 0 ;
// totalAmount?? 

if (empty($_POST['product_sid']) or empty($_POST['price']) or empty($_POST['qty']) or empty($_POST['totalAmount'])) {
  $output['errors']['form'] = "缺少欄位資料";
  echo json_encode($output, JSON_UNESCAPED_UNICODE);
  exit;
};

// $name = $_POST['product_sid'] ?? '';
// $price = $_POST['price'] ?? '';
// $cate1 = $_POST['qty'] ?? '';


$orderId = sha1($_POST['price']. uniqid().rand());

$sql = "INSERT INTO `order_list`(`order_id`, `member_id`, `payment_status`, `order_status`, `order_date`, `total_amount`) VALUES (?, ?, ?, ?, NOW() ?)";


$stmt = $pdo->prepare($sql);

// pdo stmt 執行：把表單拿到的值丟到上方的 ?
$stmt->execute([
  $orderId,
  'M0001',
  '待出貨',
  '待付款',
  $totalAmount, // 還沒處理
]);

$output['success'] = boolval($stmt->rowCount());
echo json_encode($output, JSON_UNESCAPED_UNICODE);