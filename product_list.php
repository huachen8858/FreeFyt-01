<?php
require './index-parts/connect_db.php';
$title = '商品管理系統';
$perPage = 5;

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
    header('Location: ?page=1');
    exit; # 結束這支php
}

# 算筆數
$t_sql = "SELECT COUNT(1) FROM product";

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
        "SELECT * FROM product ORDER BY sid DESC LIMIT %s, %s",
        ($page - 1) * $perPage, 
        $perPage 
    );
    $rows = $pdo->query($sql)->fetchAll();
}

?>

<?php include './index-parts/html-head.php' ?>
<?php include './index-parts/sidebartoTopbar.php' ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">商品管理</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h5 class="m-0 font-weight-bold text-primary">總商品列表</h5>
            <div class="btn btn-primary rounded-pill">
                <a class=" text-light" href="add-product.php"><i class="fas fa-plus"></i> 新增商品</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>商品編號</th>
                        <th>商品名稱</th>
                        <th>商品價格</th>
                        <th>商品描述</th>
                        <th>庫存量</th>
                        <th>累積購買數</th>
                        <th>建立日期</th>
                        <th>是否上架</th>
                        <th><i class="far fa-trash-alt"></i></th>
                        <th><i class="far fa-edit"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($rows as $r) :?>
                    <tr>
                        <td><?= $r['sid'] ?></td>
                        <td><?= $r['product_id'] ?></td>
                        <td><?= $r['name'] ?></td>
                        <td><?= $r['price'] ?></td>
                        <td class="" ><?= $r['descriptions'] ?></td>
                        <td><?= $r['inventory'] ?></td>
                        <td><?= $r['purchase_qty'] ?></td>
                        <td><?= $r['create_date'] ?></td>
                        <?php if(!$r['sale']) : ?>
                        <td><div class="btn btn-secondary rounded-pill">未上架</div></td>
                        <?php else : ?>
                        <td><div class="btn btn-success rounded-pill">上架中</div></td>
                        <?php endif; ?>
                        <td><a href="javascript: deleteItem(<?= $r['sid'] ?>)"><i class="far fa-trash-alt"></a></td>
                        <td><a href="edit-product.php"><i class="far fa-edit"></a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div><?= "$totalRows / $totalPages" ?></div>

    <!-- pagination:還沒調整完 -->
    <div class="raw">
        <div class="col d-flex justify-content-end">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=1">
                        <i class="fa-solid fa-angles-left"></i></a>
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
                        <i class="fa-solid fa-angles-right"></i></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

</div>
<?php include './index-parts/footerToScripts.php' ?>
<script>
    function deleteItem(sid) {
        if (confirm(`確定要刪除編號 ${sid} 的資料嗎?`)) {
            location.href = 'delete-product.php?sid=' + sid;
        }
    }
</script>
<?php include './index-parts/html-foot.php' ?>