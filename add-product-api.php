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
if (empty($_POST['name']) or empty($_POST['price']) or empty($_POST['inventory']) or empty($_POST['mainImg']) or empty($_POST['category'])) {
  $output['errors']['form'] = '缺少欄位資料';
  echo json_encode($output);
  exit;
};

// 避免錯誤訊息：避免沒有值時 warning 訊息跑到 html 標籤中
$name = $_POST['name'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$birthday = $_POST['birthday'];
$address = $_POST['address'];

# 後端檢查
$isPass = true;

// 判斷 email:PHP regex function 如果 email 判斷為 false 代表格式有誤
// if (! filter_var($email, FILTER_VALIDATE_EMAIL)){
//   $isPass = false;
//   $output['errors']['email'] = 'email 格式錯誤';
// }

// 如果沒有通過檢查
if(! $isPass) {
  echo json_encode($output);
  exit;
}

# 與資料庫串接
// 新增功能： ?用來佔位
$sql = "INSERT INTO `address_book`(
  `name`, `email`, `mobile`, `birthday`, `address`, `created_at`
  ) VALUES (
    ?, ?, ?, ?, ?, NOW()
  )";

// pdo 先準備：並沒有真的執行，會先拿到pdo statement 的物件
$stmt = $pdo->prepare($sql);

// pdo stmt 執行：把這五個表單拿到的值丟到上方的 ?
$stmt->execute([
  $name,
  $email,
  $mobile,
  $birthday,
  $address,
]);

// 如果stmt有新增欄位成功(rowcount=1,布林值為ture),output sucess 就呈現 true, echo 輸出結果
$output['success'] = boolval($stmt->rowCount());
echo json_encode($output);