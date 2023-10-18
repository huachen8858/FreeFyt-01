<?php 
require './index-parts/connect_db.php';

// 2023 10 18 5:00 這版api 無法成功上傳資料，且有抓到填寫的data 但 success 顯示false


// 宣告變數 避免使用者點開此 api 會出現 warning，通常不要直接看api檔案
$output = [
  'postData' => $_POST,
  'success' => false,
  'errors' => [],
];
// echo json_encode($output);
// exit;

// 告訴用戶端格式為JSON
header('Content-Type: application/json');

// 資料寫入前要檢查: 除更多圖片其他欄位必填
if (empty($_POST['name']) or empty($_POST['price']) or empty($_POST['cate1']) or empty($_POST['cate2']) or empty($_POST['descriptions']) or empty($_POST['inventory']) or empty($_POST['launch'])) {
  $output['errors']['form'] = '缺少欄位資料';
  echo json_encode($output, JSON_UNESCAPED_UNICODE);
  exit;
};

// 避免錯誤訊息：避免沒有值時 warning 訊息跑到 html 標籤中
$name = $_POST['name'] ?? '';
$price = $_POST['price'] ?? '';
$cate1 = $_POST['cate1'] ?? '';
$cate2 = $_POST['cate2'] ?? '';
$descriptions = $_POST['descriptions'] ?? '';
$inventory = $_POST['inventory'] ?? '';
$launch = $_POST['launch'] ?? '';

# 後端檢查
$isPass = true;

//如果庫存量為0,launch設定為0
if (intval($inventory) === 0) {
  $launch = 0;
}

// 如果沒有通過檢查
if(! $isPass) {
  echo json_encode($output);
  exit;
}

# --- 自動給商品編號 日期＋有序編號 FYT-20231018-00001
$currentDate = date('Ymd'); 

// 查找資料庫最大的序號
$maxNumber = getMaxProductNumber($pdo, $currentDate);

$newNumber = $maxNumber + 1;

// 保持固定五位數 不夠補0
$numberFormatted = sprintf('%05d', $newNumber); // 例如：00001

function getMaxProductNumber($pdo, $currentDate) {
  // 编写SQL查询语句，查找与当前日期匹配的记录中的最大序号
  $sql = "SELECT MAX(SUBSTRING_INDEX(product_id, '-', -1)) AS max_number 
          FROM product 
          WHERE product_id LIKE :date_prefix";

  $stmt = $pdo->prepare($sql);

  $datePrefix = 'FYT-' . $currentDate . '-%';
  $stmt->bindParam(':date_prefix', $datePrefix, PDO::PARAM_STR);
  $stmt->execute();

  $maxNumberResult = $stmt->fetch(PDO::FETCH_ASSOC);

  // 提取最大序号
  $maxNumber = (int)$maxNumberResult['max_number'];

  return $maxNumber;
  }



// 生成商品編號
// if (!empty($_POST['name'])) {
  $pid = 'FYT-' . $currentDate . '-' . $numberFormatted;
// }



echo json_encode($pid, JSON_UNESCAPED_UNICODE);

# 與資料庫串接
// 新增功能： ?用來佔位
$sql = "INSERT INTO `product_list`(
    `product_id`, 
    `name`, `price`, `category`, `descriptions`, `inventory`, `purchase_qty`, `launch`, `create_date`
  ) VALUES (
    ?, ?, ?, ?, ?, ?, 0, ?, NOW()
  )";


// pdo 先準備：並沒有真的執行，會先拿到pdo statement 的物件
$stmt = $pdo->prepare($sql);

// pdo stmt 執行：把表單拿到的值丟到上方的 ?
$stmt->execute([
  $pid,
  $name,
  $price,
  $cate2,
  $descriptions,
  $inventory,
  $launch,
]);

// 如果stmt有新增欄位成功(rowcount=1,布林值為ture),output sucess 就呈現 true, echo 輸出結果
$output['success'] = boolval($stmt->rowCount());
echo json_encode($output); 


$latest_sid = $pdo->lastInsertId(); //取得 PK