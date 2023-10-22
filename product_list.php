<?php
require './index-parts/connect_db.php';
$title = '商品管理系統';
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

// 篩選價格的初始值
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'original';

# 算筆數
$t_sql = "SELECT COUNT(1) FROM product_list";

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

    // 篩選價格
    $sql = '';
    if ($sort === 'original') {
        $sql = sprintf(
            "SELECT * FROM product_list ORDER BY sid DESC LIMIT %s, %s",
            ($page - 1) * $perPage,
            $perPage
        );
    } elseif ($sort === 'desc') {
        $sql = sprintf(
            "SELECT * FROM product_list ORDER BY price DESC, sid DESC LIMIT %s, %s",
            ($page - 1) * $perPage,
            $perPage
        );
    } elseif ($sort === 'asc') {
        $sql = sprintf(
            "SELECT * FROM product_list ORDER BY price ASC, sid DESC LIMIT %s, %s",
            ($page - 1) * $perPage,
            $perPage
        );
    }
    if (!empty($sql)) {
        $rows = $pdo->query($sql)->fetchAll();
    }
}

?>

<?php include './index-parts/html-head.php' ?>
<?php include './index-parts/sidebartoTopbar.php' ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">商品管理</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h5 class="m-0 font-weight-bold text-primary">總商品列表</h5>
            <!-- Search -->
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" id="search-form" name="search-form">
                <div class="input-group">
                    <input type="text" id="search-field" name="search-field" class="form-control form-control-sm bg-light border-1 small " placeholder="搜尋商品名稱" aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-primary btn-sm" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
            <!-- add-product -->
            <div class="btn btn-primary rounded-pill">
                <a class="text-light" href="add-product.php"><i class="fas fa-plus"></i> 新增商品</a>
            </div>
        </div>
        <!-- Filter -->
        <!-- <div class="mx-4 my-3">
            <form id="filter-form" class="d-flex flex-row align-items-center">
                <label for="filterCategory" class="mb-0">選擇篩選分類：</label>
                <select id="filterCategory" name="filterCategory" class="form-control form-control-sm " style="width:150px;">
                    <option value="all">所有分類</option>
                    <option value="0">#</option>
                    <option value="1">價格</option>
                </select>
                &nbsp;
                <button type="button" class="btn btn-warning btn-sm rounded-pill">篩選</button>
            </form>
        </div> -->
        <!-- Filter -->
        <div class="mx-4 my-2">
            <a class="btn btn-sm btn-secondary" href="product_list.php">所有資料</a>
        </div>

        <div class="mx-4 my-2">
            <div for="filterCategory" class="mb-0 d-inline">價格篩選：</div>
            <a class="btn btn-sm btn-outline-secondary" href="?page=<?= $page ?>&sort=asc">由低到高</a>
            <a class="btn btn-sm btn-outline-secondary" href="?page=<?= $page ?>&sort=desc">由高到低</a>
        </div>


        <!-- 結果顯示 -->
        <div class="card-body scroll">
            <div class="table-responsive " style="max-width: 1800px;">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>商品編號</th>
                            <th>商品名稱</th>
                            <th>商品價格</th>
                            <th style="max-width: 100px;">商品描述</th>
                            <th>庫存量</th>
                            <th>累積購買數</th>
                            <th>建立日期</th>
                            <th>是否上架&nbsp;&nbsp;
                                <button id="filter-toggle" class="btn btn-sm btn-outline-secondary btn-sm"><i class="fas fa-sort-down"></i></button>
                            </th>
                            <th><i class="far fa-trash-alt"></i></th>
                            <th><i class="far fa-edit"></i></th>
                        </tr>
                    </thead>
                    <tbody id="original-table">
                        <?php foreach ($rows as $r) : ?>
                            <tr>
                                <td><?= $r['sid'] ?></td>
                                <td><?= $r['product_id'] ?></td>
                                <td><?= htmlentities($r['name']) ?></td>
                                <td><?= $r['price'] ?></td>
                                <!-- 隱藏多於文字text-truncate 要記得給寬度 -->
                                <td class="text-truncate" style="max-width: 100px;"><?= htmlentities($r['descriptions']) ?></td>
                                <td><?= $r['inventory'] ?></td>
                                <td><?= $r['purchase_qty'] ?></td>
                                <td><?= $r['create_date'] ?></td>
                                <?php if (!$r['launch']) : ?>
                                    <td>
                                        <div class="btn btn-secondary btn-sm rounded-pill status">未上架</div>
                                    </td>
                                <?php else : ?>
                                    <td>
                                        <div class="btn btn-success btn-sm rounded-pill status">上架中</div>
                                    </td>
                                <?php endif; ?>
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

</div>
<?php include './index-parts/footerToScripts.php' ?>
<script>
    function deleteItem(sid) {
        if (confirm(`確定要刪除編號 ${sid} 的資料嗎?
提醒您若確定刪除資料將無法復原，可透過下架商品保留商品資訊。`)) {
            location.href = 'delete-product.php?sid=' + sid;
        }
    }

    // Search- product name
    const originalTable = document.querySelector("#original-table")
    const searchForm = document.querySelector("#search-form");

    searchForm.addEventListener("submit", function(e) {
        e.preventDefault();
        const searchStr = document.querySelector("#search-field").value;
        const fd = new FormData(searchForm);

        fetch('product-search-api.php', {
                method: 'POST',
                body: fd,
            })
            .then(r => r.json())
            .then(data => {
                originalTable.innerHTML = ``; //將原本的列表清空 顯示出要的資料

                if (data.length > 0) {
                    data.forEach(item => {
                        const row = document.createElement("tr");
                        row.innerHTML = `
                <td>${item.sid}</td>
                <td>${item.product_id}</td>
                <td>${item.name}</td>
                <td>${item.price}</td>
                <td class="text-truncate" style="max-width: 100px;">${item.descriptions}</td>
                <td>${item.inventory}</td>
                <td>${item.purchase_qty}</td>
                <td>${item.create_date}</td>
                <td>${item.launch}</td>
                <td><a href="javascript: deleteItem(${item.sid})"><i class="far fa-trash-alt"></a></td>
                <td><a href="edit-product.php?sid=${item.sid}"><i class="far fa-edit"></a></td>
                `;
                        originalTable.appendChild(row);
                    });
                } else {
                    resultTable.innerHTML = '<tr><td colspan="13">No results found.</td></tr>';
                }
            })
    })

    // launch filter ：只能單頁篩選
    const launchFilter = document.querySelector('#filter-toggle');
    let filterState = 'all';

    launchFilter.addEventListener("click", function() {
        const rows = document.querySelectorAll('#dataTable tbody tr');

        if (filterState === 'all') {
            rows.forEach(row => {
                const statusElement = row.querySelector(".status");
                if (statusElement.textContent === "上架中") {
                    row.style.display = "table-row";
                } else {
                    row.style.display = "none";
                }
            });
            filterState = 'launched';
        } else if (filterState === "launched") {
            rows.forEach(row => {
                const statusElement = row.querySelector(".status");
                if (statusElement.textContent === "未上架") {
                    row.style.display = "table-row";
                } else {
                    row.style.display = "none";
                }
            });
            filterState = 'not-launched';
        } else {
            rows.forEach(row => {
                row.style.display = "table-row";
            });
            filterState = 'all';
        }
    });


    // 篩選sid降冪排列
    // 價格price 排列
</script>
<?php include './index-parts/html-foot.php' ?>