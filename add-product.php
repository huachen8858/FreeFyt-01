<?php
require './index-parts/connect_db.php';
$pageName = 'add';
$title = '新增商品'

?>
<style>
  form .form-text{
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
      <form name="form1">
        <div class="mb-3">
          <label for="product_id" class="form-label">商品編號</label>
          <input type="text" class="form-control" id="product_id" name="product_id" disabled placeholder="Pxxxx (待確認新增商品後會自動生成)">
          <div class="form-text"></div>
        </div>
        <div class="mb-3">
          <label for="name" class="form-label">商品名稱</label>
          <input type="text" class="form-control" id="name" name="name">
          <div class="form-text"></div>
        </div>
        <div class="mb-3">
          <label for="price" class="form-label">商品商品價格</label>
          <input type="number" class="form-control" id="price" name="price" min="0" max="99999">
          <div class="form-text"></div>
        </div>
        <!-- 商品分類 下拉式選單 -->
        <div class="mb-3">
          <label for="category" class="form-label">商品分類</label>
          <select name="category" id="category" class="form-control">
            <option value="0">-- 請選擇類別 --</option>
          </select>
          <select name="subCategory" id="subCategory" class="form-control">
          </select>
          <div class="form-text"></div>
        </div>
        <!-- 商品圖片 -->
        <div class="mb-3">
          <label for="mainImg" class="form-label">主要商品圖片</label>
          <p>(建議 600 x 600px, 檔案大小 500K 以內)</p>
          <input type="file" class="form-control" name="mainImg" id="img">
          </div>
        <div class="mb-3">
          <label for="moreImg" class="form-label">更多商品圖片</label>
          <input type="file" class="form-control" name="moreImg" id="moreImg" multiple>
        </div>
        <div class="mb-3">
          <label for="inventory" class="form-label">庫存數量</label>
          <input type="number" class="form-control" id="inventory" mobile="inventory" min="0" max="99999">
        </div>
        <div class="mb-3">
          <label for="sale" class="form-label">上架狀態</label>&nbsp;
          <input type="radio" id="on" name="sale" value="1" checked>
          <label for="sale">上架</label>&nbsp;
          <input type="radio" id="on" name="sale" value="0">
          <label for="sale">下架</label>
        </div>
        <div class="d-flex justify-content-end">
          <button type="submit" onsubmit="sendData(event)" class="btn btn-warning rounded-pill">新增商品</button> &nbsp;
          <button type="submit" onsubmit="cancelSend(event)" class="btn btn-secondary rounded-pill">取消新增</button>
        </div>
      </form>
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
  const category = document.form1.catogory;
  const mainImg = document.form1.mainImg;
  const moreImg = document.form1.moreImg;
  const inventory = document.form1.inventory;
  const sale = document.form1.inventory.value;
  const fields = [name_in, price_in, category, mainImg, moreImg, inventory, sale];

  // 宣告商品類別
  let product_category = [
    {
      "category": "物品",
      "subCategory":[
        {v: 1, name: "服裝"},
        {v: 2, name: "器材"},
        {v: 3, name: "裝備"},
      ]
    },
    {
      "category": "食品",
      "subCategory":[
        {v: 4, name: "蛋白"},
        {v: 5, name: "非蛋白"},
      ]
    }
  ];
  
// 下拉式選單 串接子選項
$.each(product_category, function(index, value){
  $("#category").append(`<option value="${index+1}">${value.category}</option>`)
  })

  // 先選到類別名，在第二個下拉式選單顯示該類別名的子選項
  $("#category").on("change",function(){
    let selectedCategory = $(this).val();
    // console.log($(this).val());
    
    $("#subCategory").empty();
    // 商品類別是陣列 陣列的item是內容要對到他的類別名
    // let selectedPc = product_category.find(function(item){
    //     return item.category === selectedCategory;
    // })
    let selectedPc = product_category[selectedCategory - 1];

  // 當選到類別
  if (selectedPc) {
    $.each(selectedPc.subCategory, function(index, value2){
    console.log(value2);
    $("#subCategory").append(`<option value="${value2.v}" >${value2.name}</option>`)
    // console.log(selectedPc);
    })
  }
})





// 按下送出按鈕要執行以下
  function sendData(e) {
    e.preventDefault();

    // 外觀要回復原來的狀態
    fields.forEach(field => {
      field.style.border = '1px solid #CCCCCC';
      field.nextElementSibling.innerHTML = '';
    })

    // 先假設表單都是正確資訊，後續判斷如果有誤就把它變成false
    let isPass = true;

    // 1.商品編號給數字
    // for () {

    // }

    // 2.判斷商品名稱需大於兩個字:如果長度小於二就是資訊有誤
    if (name_in.value.length < 2) {
      $isPass = false;
      name_in.style.border = '2px solid red';
      name_in.nextElementSibling.innerHTML = '請填寫正確的商品名稱';
    }

    // moreImg 非必填: 如果沒有值因為是非必填是ok的就不做 && 後面的事，如果有值 且 正規驗證為沒有值
    // if (moreImg.value) {
    //   $isPass = false;
    //   mobile_in.style.border = '2px solid red';
    //   mobile_in.nextElementSibling.innerHTML = '請填寫正確的手機號碼';
    // }
    
    // 沒有通過就不要發送資料
    if (!isPass) {
      return;
    }
    
    // 建立只有資料的表單 用formData類型去接
    const fd = new FormData(document.form1);

    // 只要有資料傳送時或是想暫存資料就可以用 AJAX 方式去叫小弟做事 fetch 這支 add-api.php
    fetch ('add-product-api.php', {
      method: 'POST',
      body: fd, // 送出資料格式會自動是mutipart/form-data
    }).then(r => r.json())
    .then(data => {
      console.log({
        data
      });
    })
    .catch(ex => console.log(ex))
  }



  // 取消新增
  function cancelSend() {
    if (confirm(`確定要取消新增資料嗎？`)) {
      document.form1.reset();
      location.href = 'product_list.php';
    }
  }
</script>
<?php include './index-parts/html-foot.php' ?>