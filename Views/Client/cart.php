<div class="bg-light py-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-0">
        <a href="index.html">Trang chủ</a>
        <span class="mx-2">/</span>
        <strong class="text-black">Giỏ hàng</strong>
      </div>
    </div>
  </div>
</div>

<div class="site-section">
  <div class="container">

    <div class="row mb-5">
      <form class="col-md-12" method="post">
        <div class="site-blocks-table">

          <table class="table table-striped table-hover shadow-sm rounded bg-white">
            <thead>
              <tr>
                <th>Hình ảnh</th>
                <th>Sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Tổng</th>
                <th>Xóa</th>
              </tr>
            </thead>

            <tbody>
              <?php $grand_total = 0;
              foreach ($carts as $cart):
                $final_price = $cart['discount_price'] > 0 ? $cart['discount_price'] : $cart['price'];
                $subtotal = $final_price * $cart['quantity'];
                ?>

                <tr class="align-middle bg-white">
                  <td>
                    <img src="Uploads/Product/<?= $cart['image'] ?>" width="80" class="img-thumbnail rounded">
                  </td>

                  <td>
                    <h5 class="mb-0"><?= $cart['title'] ?></h5>
                  </td>

                  <td class="text-primary font-weight-bold">
                    <?= number_format($final_price) ?> VNĐ
                  </td>

                  <td>
                    <div class="input-group" style="max-width: 130px;">
                      <button data-price="<?= $final_price ?>" class="btn btn-outline-secondary js-btn-minus"
                        type="button">&minus;</button>

                      <input type="number" name="quantity[<?= $cart['cart_item_id'] ?>]" value="<?= $cart['quantity'] ?>"
                        class="form-control text-center">

                      <button data-price="<?= $final_price ?>" class="btn btn-outline-secondary js-btn-plus"
                        type="button">&plus;</button>
                    </div>
                  </td>

                  <td class="sub-total font-weight-bold text-success">
                    <?= number_format($subtotal) ?> VNĐ
                  </td>

                  <td>
                    <button type="submit" name="remove_item_id" value="<?= $cart['cart_item_id'] ?>"
                      class="btn btn-danger btn-sm">
                      X
                    </button>
                  </td>
                </tr>

              <?php endforeach; ?>
            </tbody>

          </table>

        </div>

        <div class="row mb-4">
          <div class="col-md-6 mb-2">
            <button class="btn btn-primary btn-block btn-lg" type="submit" name="update_cart">
              Cập nhật giỏ hàng
            </button>
          </div>

          <div class="col-md-6">
            <a href="store.html" class="btn btn-outline-primary btn-block btn-lg">
              Tiếp tục mua sắm
            </a>
          </div>
        </div>

      </form>
    </div>

    <div class="row">
      <div class="col-md-6">

        <div class="card p-4 shadow-sm">
          <h4 class="mb-3">Mã giảm giá</h4>

          <div class="input-group mb-3">
            <input type="text" class="form-control py-3" placeholder="Nhập mã giảm giá">
            <button class="btn btn-primary">Áp dụng</button>
          </div>

        </div>

      </div>

      <div class="col-md-6">
        <div class="card p-4 shadow-sm">

          <h4 class="border-bottom pb-3 mb-3">Tổng</h4>

          <div class="d-flex justify-content-between mb-2">
            <span>Tổng phụ</span>
            <strong class="subtotal"></strong>
          </div>

          <div class="d-flex justify-content-between mb-2">
            <span>Phí giao hàng</span>
            <strong>Miễn phí</strong>
          </div>

          <div class="d-flex justify-content-between mb-3">
            <span><strong>Tổng tiền</strong></span>
            <strong class="total text-primary"></strong>
          </div>

          <button class="btn btn-success btn-lg btn-block" onclick="window.location='index.php?page=checkout'">
            Tiến hành thanh toán
          </button>

        </div>
      </div>
    </div>

  </div>
</div>


<script>
  jQuery(document).ready(function ($) {
    $('.js-btn-plus').click(function () {
      let price = $(this).data('price');
      let input = $(this).closest('.input-group').find('input'); // Tham chiếu đến thẻ input
      let inputQty = parseInt(input.val()); // Lấy số lượng hiện tại
      let newQty = inputQty; // Tính số lượng mới

      input.val(newQty);

      let subtotal = $(this).closest('tr').find('.sub-total');

      subtotal.text((((newQty + 1) * price).toLocaleString()) + " VNĐ");

      updateTotal();
    })

    $('.js-btn-minus').click(function () {
      let price = $(this).data('price');
      let input = $(this).closest('.input-group').find('input');
      let inputQty = parseInt(input.val());

      if (inputQty <= 1) return;

      let newQty = inputQty;

      input.val(newQty);

      let subtotal = $(this).closest('tr').find('.sub-total');
      subtotal.text((((newQty - 1) * price).toLocaleString()) + " VNĐ");
      updateTotal();
    })

    function updateTotal() {
      let total = 0;
      $('.sub-total').each(function () {
        // Loại bỏ ký tự không phải số trước khi tính tổng
        total += parseInt($(this).text().replace(/[^\d]/g, ''));
      });

      $('.total').text(total.toLocaleString() + ' VNĐ');
      $('.subtotal').text(total.toLocaleString() + ' VNĐ');
    }

    // Cần gọi hàm này để tính tổng ban đầu khi tải trang
    updateTotal();
  });
</script>