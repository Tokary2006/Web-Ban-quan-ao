<div class="bg-light py-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-0"><a href="index.html">Trang chủ</a> <span class="mx-2 mb-0">/</span> <strong
          class="text-black">Giỏ hàng</strong></div>
    </div>
  </div>
</div>

<div class="site-section">
  <div class="container">
    <div class="row mb-5">
      <form class="col-md-12" method="post">
        <div class="site-blocks-table">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="product-thumbnail">Hình ảnh</th>
                <th class="product-name">Sản phẩm</th>
                <th class="product-price">Giá</th>
                <th class="product-quantity">Số lượng</th>
                <th class="product-total">Tổng</th>
                <th class="product-remove">Xóa</th>
              </tr>
            </thead>
            <tbody>
              <?php $grand_total = 0;
              foreach ($carts as $cart):

                $final_price = $cart['discount_price'] > 0
                  ? ($cart['discount_price'])
                  : ($cart['price']);

                $stock = $cart['quantity'];

                $subtotal = $final_price * $cart['quantity'];

                ?>
                <tr>
                  <td class="product-thumbnail">
                    <img src="Uploads/<?= $cart['image'] ?>" alt="Image" class="img-fluid">
                  </td>
                  <td class="product-name">
                    <h2 class="h5 text-black"><?= $cart['title'] ?></h2>
                  </td>
                  <td><?= number_format($final_price) ?> VNĐ</td>
                  <td>
                    <div class="input-group mb-3" style="max-width: 120px;">
                      <div class="input-group-prepend">
                        <button data-price="<?= $final_price ?>" class="btn btn-outline-primary js-btn-minus"
                          type="button">&minus;</button>
                      </div>
                      <input type="text" class="form-control text-center" value="<?= $cart['quantity'] ?>"
                        placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" disabled>
                      <div class="input-group-append">
                        <button data-price="<?= $final_price ?>" class="btn btn-outline-primary js-btn-plus"
                          type="button">&plus;</button>
                      </div>
                    </div>

                  </td>
                  <td class="sub-total"><?= number_format($subtotal) ?> VNĐ</td>
                  <td><a href="#" class="btn btn-primary height-auto btn-sm">X</a></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </form>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="row mb-5">
          <div class="col-md-6 mb-3 mb-md-0">
            <button class="btn btn-primary btn-sm btn-block">Cập nhật giỏ hàng</button>
          </div>
          <div class="col-md-6">
            <button class="btn btn-outline-primary btn-sm btn-block">Tiếp tục mua sắm</button>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label class="text-black h4" for="coupon">Mã giảm giá</label>
            <p>Nhập vào mã giảm giá.</p>
          </div>
          <div class="col-md-8 mb-3 mb-md-0">
            <input type="text" class="form-control py-3" id="coupon" placeholder="Nhập vào mã giảm giá.">
          </div>
          <div class="col-md-4">
            <button class="btn btn-primary btn-sm px-4">Áp dụng</button>
          </div>
        </div>
      </div>
      <div class="col-md-6 pl-5">
        <div class="row justify-content-end">
          <div class="col-md-7">
            <div class="row">
              <div class="col-md-12 text-right border-bottom mb-5">
                <h3 class="text-black h4 text-uppercase">Tổng</h3>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <span class="text-black">Tổng phụ</span>
              </div>
              <div class="col-md-6 text-right">
                <strong class="text-black"><?= number_format($subtotal) ?> đ</strong>
              </div>
            </div>
            <div class="row mb-5">
              <div class="col-md-6">
                <span class="text-black">Total</span>
              </div>
              <div class="col-md-6 text-right">
                <strong class="text-black total"><?= number_format($value["price"] = 350000) ?> đ</strong>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <button class="btn btn-primary btn-lg btn-block" onclick="window.location='checkout.html'">Tiến hành
                  thanh toán</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  jQuery(document).ready(function ($) {
    $('.js-btn-plus').click(function () {
      let price = $(this).data('price');
      let inputQty = parseInt($(this).closest('.input-group').find('input').val());
      let subtotal = $(this).closest('tr').find('.sub-total');

      subtotal.text((((inputQty + 1) * price).toLocaleString())+ " VNĐ");
      updateTotal();
    })

    $('.js-btn-minus').click(function () {
      let price = $(this).data('price');
      let inputQty = parseInt($(this).closest('.input-group').find('input').val());

      if(inputQty <= 1) return;

      let subtotal = $(this).closest('tr').find('.sub-total');
      subtotal.text((((inputQty - 1) * price).toLocaleString())+ " VNĐ");
      updateTotal();
    })

    function updateTotal() {
      let total = 0;
      $('.sub-total').each(function() {
        total += parseInt($(this).text().replace(/,/g, ''));
      });

      $('.total').text(total.toLocaleString() + ' VNĐ');
    }
  });

</script>