<?php 
require './index-parts/connect_db.php';

$dir = __DIR__ . '/product-imgs/';


# 檔案類型的篩選
$exts = [
  'image/jpeg' => '.jpg',
  'image/png' => '.png',
  'image/webp' => '.webp',
];

header('Content-Type: application/json');

$output = [
  'success' => false,
  'file' => ''
];

if (!empty($_FILES) and !empty($_FILES['mainImg']) and $_FILES['mainImg']['error']==0) {
  
  if (!empty( $exts[$_FILES['mainImg']['type']] )) {
    $ext = $exts[$_FILES['mainImg']['type']]; // 副檔名

    # 隨機的主檔名
    $f = sha1($_FILES['mainImg']['name']. uniqid());

    if (
      move_uploaded_file(
        $_FILES['mainImg']['tmp_name'],
        $dir . $f. $ext
      )
    ) {
      $output['success'] = true;
      $output['file'] = $f. $ext;
    }
  }
}

echo json_encode($output);
