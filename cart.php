<?php
require './index-parts/connect_db.php';
$title = '購物車';

// 檢查是否有登入管理者身份
// if (isset($_SESSION['admin'])){
//     header('Location: index_.php');
//     exit;
// }


// 加入購物車存放的資訊，將訂單送出後就要刪除

$sql = "SELECT * FROM cart JOIN product_list ON cart.product_sid = product_list.sid";
$cartItems = $pdo->query($sql)->fetchAll();
// var_dump($cartItems);


?>

<?php include './index-parts/html-head.php' ?>
<?php include './index-parts/sidebartoTopbar.php' ?>


<div class="container mb-3">
  <div class="row">
    <div class="col">

      <div class="d-flex flex-row justify-content-center">
        <div class="card">
          <div class="card-head d-flex justify-content-center ">
            <h5 class="mb-2 font-weight-bold text-primary text-center my-2 ">我的購物車</h5>
          </div>
          
          <form name="form1" onsubmit="return false;">
            <table class="table p-3">
              <!-- 看要不要註解掉 -->
              <thead>
                <tr>
                  <th scope="col">選擇</th>
                  <th scope="col">商品名稱</th>
                  <th scope="col">商品圖片</th>
                  <th scope="col">商品價格</th>
                  <th scope="col">數量</th>
                  <th scope="col">小計</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($cartItems as $cart) : ?>
                  <tr>
                    <th scope="row"><input type="checkbox" name="selected_products[]" value="<?= $cart['product_sid'] ?>"></th>
                    <td><?= $cart['name'] ?></td>
                    <td><img style="max-width:100px; max-height:100px; object-fit: cover;" src="<?= 'product-imgs/' . $cart['img'] ?>" alt=""></td>
                    <td><input type="hidden" disabled value="<?= $cart['price'] ?>"><?= $cart['price'] ?></td>
                    <td><input type="number" class="form-control form-control-sm" name="qty" id="qty" min="1" style="width:100px" value="<?= $cart['qty'] ?>" required></td>
                    <td><?= $cart['subtotal'] ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            <hr/>
            <div class="card-body d-flex justify-content-end">
              <h5 class="">總金額:<span id="totalAmount">0</span></h5>
            </div>
            <div class="card-body d-flex justify-content-end">
              <button class="btn btn-info " onclick="sendOrder(event)">送出訂單</button>
            </div>
          
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<?php include './index-parts/footerToScripts.php' ?>
<script>
  // 計算總金額
  function TotalAmount() {
  const selectedCheckboxes = document.querySelectorAll('input[name="selected_products[]"]:checked');
  let totalAmount = 0;

  selectedCheckboxes.forEach(checkbox => {
    const row = checkbox.closest('tr');
    // const price = parseInt(row.querySelector('td[data-price]').textContent); issue
    const qty = parseInt(row.querySelector('input[name="qty"]').value);
    totalAmount += price * qty;
  });

  // 更新頁面上的總金額顯示
  const totalAmountElement = document.getElementById('totalAmount');
  totalAmountElement.textContent = totalAmount;
}

const checkboxes = document.querySelectorAll('input[name="selected_products[]"]');
checkboxes.forEach(checkbox => {
  checkbox.addEventListener('change', TotalAmount);
});


  // function addToCart(event) {
  //   event.preventDefault();
  //   const product_sid = document.form1.product_sid.value;
  //   const price = parseInt(document.form1.price.value);
  //   const qty = parseInt(form1.qty.value);
  //   const fd = new FormData(document.form1);
  //   fd.append('price', price);

  //   fetch("cart-api.php", {
  //       method: 'POST',
  //       body: fd, 
  //     }).then(r => r.json())
  //     .then(data => {
  //       console.log({
  //         data
  //       })
  //       if (data.output.success) {
  //         const modal = new bootstrap.Modal(document.querySelector('#hint'));
  //         modal.show();
  //         form1.qty.value = "";
  //       }
  //     })
  //     .catch(ex => console.log(ex))
  // }
</script>
<?php include './index-parts/html-foot.php' ?>