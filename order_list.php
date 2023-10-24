<?php
require './index-parts/connect_db.php';
$title = '訂單管理系統';
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
    "SELECT * FROM order_list ORDER BY sid LIMIT %s, %s",
    ($page - 1) * $perPage,
    $perPage
  );
  $rows = $pdo->query($sql)->fetchAll();
}


?>

<?php include './index-parts/html-head.php' ?>
<?php include './index-parts/sidebartoTopbar.php' ?>

<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
      <h5 class="m-0 font-weight-bold text-primary">訂單列表</h5>
      <!-- add-product -->
      <div class="btn btn-primary rounded-pill">
        <a class="text-light" href="add-product.php"><i class="fas fa-plus"></i> 新增訂單</a>
      </div>
    </div>

    <!-- 結果顯示 -->
    <div class="card-body scroll">
      <div class="table-responsive " style="max-width: 1800px;">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>訂單編號</th>
              <th>訂購人</th>
              <th>付款狀態</th>
              <th>訂單狀態</th>
              <th>建立日期</th>
              <th><i class="far fa-trash-alt"></i></th>
              <th><i class="far fa-edit"></i></th>
            </tr>
          </thead>
          <tbody id="original-table">
            <?php foreach ($rows as $r) : ?>
              <tr>
                <td><?= $r['sid'] ?></td>
                <td><?= $r['order_id'] ?></td>
                <td><?= htmlentities($r['member_id']) ?></td>
                <td><?= $r['payment_status'] ?></td>
                <td><?= $r['order_status'] ?></td>
                <td><?= $r['order_date'] ?></td>
                <td><a href="javascript: deleteItem(<?= $r['sid'] ?>)"><i class="far fa-trash-alt"></a></td>
                <td><a href="edit-product.php?sid=<?= $r['sid'] ?>"><i class="far fa-edit"></a></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>


    <!-- pagination -->
    <div class="container">
      <div class="raw">
        <div class="col d-flex justify-content-end">
          <!-- 總列數/總頁數 -->
          <div class="col"><?= "$totalRows / $totalPages" ?></div>
          <nav aria-label="Page navigation example">
            <ul class="pagination">
              <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                <a class="page-link" href="?page=1">
                  <i class="fas fa-angle-double-left"></i></a>
              </li>
              <?php for ($i = $page - 3; $i <= $page + 3; $i++) :
                if ($i >= 1 and $i <= $totalPages) : ?>
                  <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                  </li>
                <?php endif; ?>
              <?php endfor; ?>
              <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                <a class="page-link" href="?page=<?= $totalPages ?>">
                  <i class="fas fa-angle-double-right"></i></a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>

</div>
<?php include './index-parts/footerToScripts.php' ?>
<script>
  function deleteItem(sid) {
    if (confirm(`確定要刪除編號 ${sid} 的資料嗎?
提醒您若確定刪除資料將無法復原，可透過下架商品保留商品資訊。`)) {
      location.href = 'delete-product.php?sid=' + sid;
    }
  }

</script>
<?php include './index-parts/html-foot.php' ?>