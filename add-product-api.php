<?php 
require './index-parts/connect_db.php';

// 宣告變數 避免使用者點開此 api 會出現 warning，通常不要直接看api檔案
$output =[
  'postData' => $_POST,
  'sucess' => false,
  'errors' => [],
];

// 告訴用戶端格式為JSON
header('Content-Type: application/json');

// 資料寫入前要檢查: 除更多圖片其他欄位必填
if (empty($_POST['name']) or empty($_POST['price']) or empty($_POST['category']) or empty($_POST['subCategory']) or empty($_POST['mainImg']) or empty($_POST['inventory']) or empty($_POST['sale'])) {
  $output['errors']['form'] = '缺少欄位資料';
  echo json_encode($output);
  exit;
};

// 避免錯誤訊息：避免沒有值時 warning 訊息跑到 html 標籤中
$name = $_POST['name'];
$price = $_POST['price'];
$category = $_POST['category'];
$subCcategory = $_POST['subCategory'];
$mainImg = $_POST['mainImg'];
$moreImg = $_POST['moreImg'] ?? '';
$inventory = $_POST['inventory'];
$sale = $_POST['sale'];

# 後端檢查
// $isPass = true;

//如果庫存量為0,sale設定為0
if (intval($inventory) === 0) {
  $sale = 0;
}

// 如果沒有通過檢查
if(! $isPass) {
  echo json_encode($output);
  exit;
}

# 與資料庫串接
// 新增功能： ?用來佔位
$sql = "INSERT INTO `product`(
  `product_id`, `name`, `price`, `category`, `subCategory`, `inventory`, `sale`, `created_date`
  ) VALUES (
    $pid, ?, ?, ?, ?, ?, NOW()
  )";

// pdo 先準備：並沒有真的執行，會先拿到pdo statement 的物件
$stmt = $pdo->prepare($sql);

// pdo stmt 執行：把表單拿到的值丟到上方的 ?
$stmt->execute([
  $name,
  $price,
  $category,
  $subCategory,
  $inventory,
  $sale 
]);

// 如果stmt有新增欄位成功(rowcount=1,布林值為ture),output sucess 就呈現 true, echo 輸出結果
$output['success'] = boolval($stmt->rowCount());
echo json_encode($output);