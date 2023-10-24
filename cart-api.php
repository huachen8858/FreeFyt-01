<?php
require './index-parts/connect_db.php';

header('Content-Type: application/json');

$output = [
  'postData' => $_POST,
  'success' => false,
  'errors' => [],
];
// echo json_encode($output);
// exit;

$productSid = isset($_POST['product_sid']) ? intval($_POST['product_sid']) : 0;
$productPrice = isset($_POST['price']) ? intval($_POST['price']) : 0;
$qty = isset($_POST['qty']) ? intval($_POST['qty']) : 0;


if (empty($productSid) or empty($productPrice) or empty($qty)) {
  $output['errors']['form'] = "缺少商品資料";
  echo json_encode($output, JSON_UNESCAPED_UNICODE);
  exit;
};

$orderId = sha1($productSid . $productPrice . $qty . uniqid() . rand());

$subtotal = $productPrice * $qty;



$sql = "INSERT INTO `cart`(`order_id`, `product_sid`, `price`, `qty`, `subtotal`) VALUES (?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);

$stmt->execute([
  $orderId,
  $productSid,
  $productPrice,
  $qty,
  $subtotal,
]);

$output['success'] = boolval($stmt->rowCount());
echo json_encode([
  'orderId' => $orderId, 
  'output' => $output
]);

