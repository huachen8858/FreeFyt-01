<?php
require './index-parts/connect_db.php';
$title = '商城';
$perPage = 10;

// 檢查是否有登入管理者身份
// if (isset($_SESSION['admin'])){
//     header('Location: index_.php');
//     exit;
// }

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
  header('Location: ?page=1');
  exit; # 結束這支php
}


# 算筆數
$t_sql = "SELECT COUNT(1) FROM order_list";

# 總筆數
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];


# 預設值
$totalPages = 0;
$rows = [];

# 有資料時
if ($totalRows > 0) {
  # 總頁數
  $totalPages = ceil($totalRows / $perPage);
  if ($page > $totalPages) {
    header('Location: ?page=' . $totalPages);
    exit;
  };

  $sql = sprintf(
    "SELECT * FROM product_list ORDER BY sid LIMIT %s, %s",
    ($page - 1) * $perPage,
    $perPage
  );
  $rows = $pdo->query($sql)->fetchAll();
}


// 加入商品圖片



?>

<?php include './index-parts/html-head.php' ?>
<?php include './index-parts/sidebartoTopbar.php' ?>


<div class="container mb-3">
  <div class="row">
    <div class="col">
      <h5 class="mb-2 font-weight-bold text-primary">最新商品</h5>

      <div class="d-flex flex-row justify-content-around">
        <div class="card" style="width: 18rem;">
          <img src="./product-imgs/8c7167bfd49d45c7cdf0ce272048405ae859b966.webp" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">商品名稱</h5>
            <p class="card-text">商品描述商品描述商品描述商品描述商品描述商品描述商品描述商品描述商品描述商品描述商品描述商品描述商品描述</p>
          </div>
          <div class="card-body d-flex justify-content-end">
            <button href="#" class="btn btn-info ">加入購物車</button>
          </div>
        </div>

        <div class="card" style="width: 18rem;">
          <img src="./product-imgs/8c7167bfd49d45c7cdf0ce272048405ae859b966.webp" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">商品名稱</h5>
            <p class="card-text">商品描述商品描述商品描述商品描述商品描述商品描述商品描述商品描述商品描述商品描述商品描述商品描述商品描述</p>
          </div>
          <div class="card-body d-flex justify-content-end">
            <button href="#" class="btn btn-info ">加入購物車</button>
          </div>
        </div>

        <div class="card" style="width: 18rem;">
          <img src="./product-imgs/8c7167bfd49d45c7cdf0ce272048405ae859b966.webp" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">商品名稱</h5>
            <p class="card-text">商品描述商品描述商品描述商品描述商品描述商品描述商品描述商品描述商品描述商品描述商品描述商品描述商品描述</p>
          </div>
          <div class="card-body d-flex justify-content-end">
            <button href="#" class="btn btn-info ">加入購物車</button>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>


<?php include './index-parts/footerToScripts.php' ?>
<script>

</script>
<?php include './index-parts/html-foot.php' ?>