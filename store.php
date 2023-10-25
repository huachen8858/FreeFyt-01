<?php
require './index-parts/connect_db.php';
$title = '商城';

// 檢查是否有登入管理者身份
// if (isset($_SESSION['admin'])){
//     header('Location: index_.php');
//     exit;
// }


// 加入商品圖片
#1
$sql_product1 = "SELECT * FROM product_list WHERE sid=111";
$product1 = $pdo->query($sql_product1)->fetch();
#2
$sql_product2 = "SELECT * FROM product_list WHERE sid=117";
$product2 = $pdo->query($sql_product2)->fetch();
#3
$sql_product3 = "SELECT * FROM product_list WHERE sid=123";
$product3 = $pdo->query($sql_product3)->fetch();


?>

<?php include './index-parts/html-head.php' ?>
<?php include './index-parts/sidebartoTopbar.php' ?>


<div class="container mb-3">
  <div class="row">
    <div class="col">
      <h5 class="mb-2 font-weight-bold text-primary">最新商品</h5>
      <!-- <div id="info"></div> -->

      <div class="d-flex flex-row justify-content-around">
        <!-- 商品一 -->
        <div class="card" style="width: 18rem;">
          <form name="form1" onsubmit="return false;">
            <img src="<?= 'product-imgs/' . $product1['img'] ?>" class="card-img-top" alt="...">
            <div class="card-body">
              <input type="hidden" name="product_sid" value="<?= $product1['sid'] ?>">
              <h5 class="card-title text-dark"><?= $product1['name'] ?></h5>
              <input type="hidden" name="price" value="<?= $product1['price'] ?>">
              <h4 class="card-text text-dark">$ <?= $product1['price'] ?></h4>
              <p class="card-text"><?= $product1['descriptions'] ?></p>
            </div>
            <div class="card-body d-flex">
              <label for="qty" class="text-align-center">數量：</label>
              <input type="number" class="form-control form-control-sm" name="qty" id="qty" min="1" style="width:180px" required>
            </div>
            <div class="card-body d-flex justify-content-end">
              <button class="btn btn-info " onclick="addToCart(event)">加入購物車</button>
            </div>
          </form>

        </div>

        <!-- 商品二 -->
        <!-- 是否要放在跟商品一同一個form裡面？建立新的form? -->
        <div class="card" style="width: 18rem;">

          <img src="<?= 'product-imgs/' . $product2['img'] ?>" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title text-dark"><?= $product2['name'] ?></h5>
            <input type="hidden" name="price" value="<?= $product2['price'] ?>">

            <h4 class="card-text text-dark">$ <?= $product2['price'] ?></h4>
            <p class="card-text"><?= $product2['descriptions'] ?></p>
          </div>
          <div class="card-body d-flex">
            <label for="qty" class="text-align-center">數量：</label>
            <input type="number" class="form-control form-control-sm" name="qty" id="qty" min="1" style="width:180px" required>
          </div>
          <div class="card-body d-flex justify-content-end">
            <button class="btn btn-info ">加入購物車</button>
          </div>

        </div>
        <!-- 商品三 -->
        <div class="card" style="width: 18rem;">
          <img src="<?= 'product-imgs/' . $product3['img'] ?>" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title text-dark"><?= $product3['name'] ?></h5>
            <h4 class="card-text text-dark">$ <?= $product3['price'] ?></h4>
            <p class="card-text"><?= $product3['descriptions'] ?></p>
          </div>
          <div class="card-body d-flex">
            <label for="qty" class="text-align-center">數量：</label>
            <input type="number" class="form-control form-control-sm" name="qty" id="qty" min="1" style="width:180px" required>
          </div>
          <div class="card-body d-flex justify-content-end">
            <button class="btn btn-info ">加入購物車</button>
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="hint" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title fs-5">商城溫馨小提示</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                商品已添加到購物車
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">返回商品列表</button>
                <!-- 轉到購物車畫面 -->
                <a class="btn btn-primary" onclick="goToCart()">查看購物車</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php include './index-parts/footerToScripts.php' ?>
<script>
  // 新增商品到購物車資料表 AJAX
  function addToCart(event) {
    event.preventDefault();
    const product_sid = document.form1.product_sid.value;
    const price = parseInt(document.form1.price.value);
    const qty = parseInt(form1.qty.value);
    const fd = new FormData(document.form1);
    fd.append('price', price);

    fetch("cart-api.php", {
        method: 'POST',
        body: fd, 
      }).then(r => r.json())
      .then(data => {
        console.log({
          data
        })
        if (data.output.success) {
          const modal = new bootstrap.Modal(document.querySelector('#hint'));
          modal.show();
          form1.qty.value = "";
        }
      })
      .catch(ex => console.log(ex))
  }

  // 跳轉到購物車
  function goToCart() {
    window.location.href = 'cart.php';
  }
</script>
<?php include './index-parts/html-foot.php' ?>