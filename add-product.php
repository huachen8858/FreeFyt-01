<?php
require './index-parts/connect_db.php';
$pageName = 'add';
$title = '新增商品';

$sql = "SELECT * FROM product_categories";
$rows = $pdo->query($sql)->fetchAll();

?>
<style>
  form .form-text {
    color: red;
  }
</style>

<?php include './index-parts/html-head.php' ?>
<?php include './index-parts/sidebarToTopbar.php' ?>
<div class="container mb-4">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title text-gray-800 text-center">新增商品資料</h3>
          <hr>
          <form name="form1" onsubmit="sendData(event)">
            <!-- <div class="mb-3">
              <label for="product_id" class="form-label">商品編號</label>
              <input type="text" class="form-control" id="product_id" name="product_id"  placeholder="Pxxxx (待確認新增商品後會自動生成)">
              <div class="form-text"></div>
            </div> -->
            <div class="mb-3">
              <label for="name" class="form-label">商品名稱</label>
              <input type="text" class="form-control" id="name" name="name">
              <div class="form-text"></div>
            </div>
            <div class="mb-3">
              <label for="price" class="form-label">商品價格</label>
              <input type="number" class="form-control" id="price" name="price">
              <div class="form-text"></div>
            </div>
            <!-- 商品分類 下拉式選單 -->
            <div class="input-group mb-3">
              <span class="input-group-text">主分類</span>
              <select class="form-select" name="cate1" id="cate1" onchange="generateCate2List()">
                <?php foreach ($rows as $r) :
                  if ($r['parent_sid'] == 0) : ?>
                    <option value="<?= $r['sid'] ?>"><?= $r['name'] ?></option>
                <?php endif;
                endforeach; ?>
              </select>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text">次分類</span>
              <select class="form-select" name="cate2" id="cate2">
              </select>
            </div>

            <!-- 商品描述 -->
            <div class="mb-3">
              <label for="descriptions" class="form-label">商品描述</label>
              <textarea class="form-control" name="descriptions" id="descriptions" cols="30" rows="3"></textarea>
              <div class="form-text"></div>
            </div>
            <!-- 庫存數量 -->
            <div class="mb-3">
              <label for="inventory" class="form-label">庫存數量</label>
              <input type="number" class="form-control" id="inventory" name="inventory">
              <div class="form-text"></div>
            </div>
            <!-- 是否上架 -->
            <div class="mb-3">
              <label for="launch" class="form-label">上架狀態</label>&nbsp;
              <input type="radio" id="on" name="launch" value="1" checked>
              <label for="launch">上架</label>&nbsp;
              <input type="radio" id="on" name="launch" value="0">
              <label for="launch">下架</label>
            </div>
            <!-- 主要商品圖片 -->
            <!-- <div class="mb-3">
              <label for="mainImg" class="form-label">主要商品圖片</label>
              <input type="file" class="form-control" name="mainImg" accept="image/jpeg,image/png,image/webp" onchange="previewImg(event)">
              <div class="form-text"></div>
              <div style="width:100px" class="showMainImg">
                <img id="myimg" src="" alt="" width="100%" />
              </div>
            </div> -->
            <!-- 新增商品／取消新增商品 按鈕 -->
            <div class="d-flex justify-content-center mb-3">
              <button type="submit" class="btn btn-warning rounded-pill">新增商品</button> &nbsp;
              <button type="button" onclick="cancelSend(event)" class="btn btn-secondary rounded-pill">取消新增</button>
            </div>
        </div>
        </form>
        <!-- 單一圖片上傳的表單(hidden) -->
        <!-- <form name="mainImgForm" hidden>
          <input type="file" name="mainImg" onchange="uploadMainImg(event)">
        </form> -->
        <!-- 多張圖片上傳的表單(hidden)  -->
        <!-- <form name="moreImgForm" hidden>
          <input type="file" name="moreImg" onchange="uploadMoreImg()" multiple/>
        </form> -->
      </div>
    </div>
  </div>
</div>
</div>

<?php include './index-parts/footerToScripts.php' ?>
<script>
  // 先拿到欄位參照，因為一開始是空的 沒有值
  const name_in = document.form1.name;
  const price_in = document.form1.price;
  const category = document.form1.category;
  // const selectedCategory = document.form1.category.value;
  const descriptions = document.form1.descriptions;
  // const mainImg = document.form1.mainImg;
  // const moreImg = document.form1.moreImg;
  const inventory = document.form1.inventory;
  const launch = document.form1.launch.value;
  const fields = [name_in, price_in, inventory, descriptions];
  const showMainImg = document.querySelector('.showMainImg');


  // 下拉選單的設定
  const initVals = {
    cate1: 1,
    cate2: 5
  };
  const cates = <?= json_encode($rows, JSON_UNESCAPED_UNICODE) ?>;
  const cate1 = document.querySelector('#cate1');
  const cate2 = document.querySelector('#cate2');

  function generateCate2List() {
    const cate1Val = cate1.value; // 主分類的值
    let str = ""; // 要加進第二個選單的內容
    // 跑迴圈看有哪些符合
    for (let item of cates) {
      if (+item.parent_sid === +cate1Val) { // 轉換成數值, cateVal 是字串
        str += `<option value="${item.sid}">${item.name}</option>`;
      }
    }
    cate2.innerHTML = str;
  }

  cate1.value = initVals.cate1; // 設定第一層的初始值
  generateCate2List(); // 一進來就呼叫 / 生第二層
  cate2.value = initVals.cate2; // 設定第二層的初始持


  // 預覽圖片 createObjectURL
  const previewImg = (event) => {
    const myimg = document.querySelector('#myimg');
    const el = event.target;
    myimg.src = URL.createObjectURL(el.files[0]);
    // console.log(el.files); // 會拿到FileList
    myimg.onload = function() {
      URL.revokeObjectURL(myimg.src); // 無法將原圖片移除
    }
  };



  // ---- 按下送出按鈕要執行以下
  function sendData(e) {
    e.preventDefault();

    // 外觀要回復原來的狀態
    // fields.forEach(field => {
    //   field.style.border = '1px solid #CCCCCC';
    //   if (field.nextElementSibling) {
    //     field.nextElementSibling.innerHTML = '';
    //   }
    // })

    // // 先假設表單都是正確資訊，後續判斷如果有誤就把它變成false
    let isPass = true;

    // // 1.商品編號亂數或for給數字？ 在前端做？ 要怎麼知道資料庫已有的值


    // // 2.判斷商品名稱需大於兩個字:如果長度小於二就是資訊有誤
    // if (name_in.value.length < 2) {
    //   $isPass = false;
    //   name_in.style.border = '2px solid red';
    //   name_in.nextElementSibling.innerHTML = '請填寫正確的商品名稱';
    // }

    // //3.price 如果價格<1 就不是正確值
    // if (price_in.value <= 0) {
    //   isPass = false;
    //   price_in.style.border = '2px solid red';
    //   price_in.nextElementSibling.innerHTML = '請填寫正確的商品價格';
    // }

    // // 4.category 如果value沒有值，就代表沒選 (尚未釐清) // 設定進去後還是會有
    // // if (selectedCategory === '0') {
    // //   isPass = false;
    // //   category.style.border = '2px solid red';
    // //   category.nextElementSibling.innerHTML = '請選擇商品類別';
    // // }

    // // 5.判斷商品描述 需大於50字
    // if (descriptions.value.length < 10) {
    //   $isPass = false;
    //   descriptions.style.border = '2px solid red';
    //   descriptions.nextElementSibling.innerHTML = '請填寫商品描述(需滿50字)';
    // }

    // // 6.inventory 如果庫存沒有值 或 庫存<0代表資料有誤
    // if (!inventory.value || inventory.value < 0) {
    //   isPass = false;
    //   inventory.style.border = '2px solid red';
    //   inventory.nextElementSibling.innerHTML = '請填寫庫存';
    // }

    // 7.判斷上架狀態：預設為1,如果inventory填寫0就將launch設為0

    // 8.mainImg 如果圖片沒有值 代表資料有誤
    // if (!mainImg.value) {
    //   isPass = false;
    //   mainImg.style.border = '2px solid red';
    //   mainImg.nextElementSibling.innerHTML = '請上傳商品圖片';
    // }

    // 9.moreImg 非必填: 是否要判別跟主圖片一樣就提醒?



    // 沒有通過就不要發送資料
    if (!isPass) {
      return;
    }

    // 建立只有資料的表單 用formData類型去接
    const fd = new FormData(document.form1);

    // 只要有資料傳送時或是想暫存資料就可以用 AJAX 方式去叫小弟做事 fetch 這支 add-api.php
    fetch("add-product-api.php", {
        method: 'POST',
        body: fd, // 送出資料格式會自動是mutipart/form-data
      }).then(r => r.json())
      .then(data => {
        console.log({
          data
        })
        console.log(data.success);
        if (data.success) {
          alert('資料新增成功');
          location.href = "product_list.php";
        }
      })
      .catch(ex => console.log(ex))
  }


  //---- 取消新增
  function cancelSend() {
    if (confirm(`確定要取消新增資料嗎？`)) {
      document.form1.reset();
      location.href = "product_list.php";
    }
  }
</script>
<?php include './index-parts/html-foot.php' ?>