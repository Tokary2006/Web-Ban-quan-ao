<div class="bg-light py-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-0">
        <a href="index.html">Trang chủ</a> 
        <span class="mx-2 mb-0">/</span> 
        <a href="cart.html">Giỏ hàng</a> 
        <span class="mx-2 mb-0">/</span> 
        <strong class="text-black">Thanh toán</strong>
      </div>
    </div>
  </div>
</div>

<div class="site-section">
  <div class="container">

    <div class="row">
      <!-- THÔNG TIN THANH TOÁN -->
      <div class="col-md-6 mb-5 mb-md-0">
        <h2 class="h3 mb-3 text-black">Thông Tin Thanh Toán</h2>
        <div class="p-3 p-lg-5 border">

          <div class="form-group">
            <label for="c_country" class="text-black">Quốc gia <span class="text-danger">*</span></label>
            <select id="c_country" class="form-control">
              <option value="1">Chọn quốc gia</option>
              <option value="2">Bangladesh</option>
              <option value="3">Algeria</option>
              <option value="4">Afghanistan</option>
              <option value="5">Ghana</option>
              <option value="6">Albania</option>
              <option value="7">Bahrain</option>
              <option value="8">Colombia</option>
              <option value="9">Dominican Republic</option>
            </select>
          </div>

          <div class="form-group row">
            <div class="col-md-6">
              <label for="c_fname" class="text-black">Họ <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="c_fname">
            </div>
            <div class="col-md-6">
              <label for="c_lname" class="text-black">Tên <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="c_lname">
            </div>
          </div>

          <div class="form-group">
            <label for="c_companyname" class="text-black">Tên công ty</label>
            <input type="text" class="form-control" id="c_companyname">
          </div>

          <div class="form-group">
            <label for="c_address" class="text-black">Địa chỉ <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="c_address" placeholder="Số nhà, tên đường">
          </div>

          <div class="form-group">
            <input type="text" class="form-control" placeholder="Căn hộ, tòa nhà (tuỳ chọn)">
          </div>

          <div class="form-group row">
            <div class="col-md-6">
              <label for="c_state_country" class="text-black">Tỉnh / Thành phố <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="c_state_country">
            </div>
            <div class="col-md-6">
              <label for="c_postal_zip" class="text-black">Mã bưu điện <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="c_postal_zip">
            </div>
          </div>

          <div class="form-group row mb-5">
            <div class="col-md-6">
              <label for="c_email_address" class="text-black">Email <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="c_email_address">
            </div>
            <div class="col-md-6">
              <label for="c_phone" class="text-black">Số điện thoại <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="c_phone" placeholder="Phone Number">
            </div>
          </div>

          <!-- TẠO TÀI KHOẢN -->
          <div class="form-group">
            <label class="text-black" data-toggle="collapse" href="#create_an_account" role="button">
              <input type="checkbox" id="c_create_account"> Tạo tài khoản?
            </label>
            <div class="collapse" id="create_an_account">
              <div class="py-2">
                <p class="mb-3">Tạo mật khẩu để đăng ký tài khoản mới.</p>
                <div class="form-group">
                  <label for="c_account_password" class="text-black">Mật khẩu</label>
                  <input type="password" class="form-control" id="c_account_password">
                </div>
              </div>
            </div>
          </div>

          <!-- ĐỊA CHỈ GIAO HÀNG KHÁC -->
          <div class="form-group">
            <label class="text-black" data-toggle="collapse" href="#ship_different_address" role="button">
              <input type="checkbox" id="c_ship_different_address"> Giao hàng đến địa chỉ khác?
            </label>
            <div class="collapse" id="ship_different_address">

              <div class="py-2">

                <div class="form-group">
                  <label for="c_diff_country" class="text-black">Quốc gia <span class="text-danger">*</span></label>
                  <select id="c_diff_country" class="form-control">
                    <option value="1">Chọn quốc gia</option>
                    <option value="2">Bangladesh</option>
                    <option value="3">Algeria</option>
                    <option value="4">Afghanistan</option>
                    <option value="5">Ghana</option>
                    <option value="6">Albania</option>
                    <option value="7">Bahrain</option>
                    <option value="8">Colombia</option>
                    <option value="9">Dominican Republic</option>
                  </select>
                </div>

                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="c_diff_fname" class="text-black">Họ <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_diff_fname">
                  </div>
                  <div class="col-md-6">
                    <label for="c_diff_lname" class="text-black">Tên <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_diff_lname">
                  </div>
                </div>

                <div class="form-group">
                  <label for="c_diff_companyname" class="text-black">Tên công ty</label>
                  <input type="text" class="form-control" id="c_diff_companyname">
                </div>

                <div class="form-group">
                  <label for="c_diff_address" class="text-black">Địa chỉ <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="c_diff_address" placeholder="Số nhà, tên đường">
                </div>

                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Căn hộ, tòa nhà (tuỳ chọn)">
                </div>

                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="c_diff_state_country" class="text-black">Tỉnh / Thành phố <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_diff_state_country">
                  </div>
                  <div class="col-md-6">
                    <label for="c_diff_postal_zip" class="text-black">Mã bưu điện <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_diff_postal_zip">
                  </div>
                </div>

                <div class="form-group row mb-5">
                  <div class="col-md-6">
                    <label for="c_diff_email_address" class="text-black">Email <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_diff_email_address">
                  </div>
                  <div class="col-md-6">
                    <label for="c_diff_phone" class="text-black">Số điện thoại <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_diff_phone" placeholder="Phone Number">
                  </div>
                </div>

              </div>

            </div>
          </div>

          <div class="form-group">
            <label for="c_order_notes" class="text-black">Ghi chú đơn hàng</label>
            <textarea class="form-control" id="c_order_notes" rows="5" placeholder="Nhập ghi chú..."></textarea>
          </div>

        </div>
      </div>

      <!-- ĐƠN HÀNG -->
      <div class="col-md-6">

        <div class="row mb-5">
          <div class="col-md-12">
            <h2 class="h3 mb-3 text-black">Mã giảm giá</h2>
            <div class="p-3 p-lg-5 border">
              <label for="c_code" class="text-black mb-3">Nhập mã giảm giá nếu bạn có</label>
              <div class="input-group w-75">
                <input type="text" class="form-control" id="c_code" placeholder="Mã giảm giá">
                <div class="input-group-append">
                  <button class="btn btn-primary btn-sm px-4" type="button">Áp dụng</button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- ORDER SUMMARY -->
        <div class="row mb-5">
          <div class="col-md-12">
            <h2 class="h3 mb-3 text-black">Đơn hàng của bạn</h2>
            <div class="p-3 p-lg-5 border">
              <table class="table site-block-order-table mb-5">
                <thead>
                  <th>Sản phẩm</th>
                  <th>Tổng</th>
                </thead>
                <tbody>
                  <tr>
                    <td>Áo thun Top Up <strong class="mx-2">x</strong> 1</td>
                    <td>250.000đ</td>
                  </tr>
                  <tr>
                    <td>Áo Polo <strong class="mx-2">x</strong> 1</td>
                    <td>100.000đ</td>
                  </tr>
                  <tr>
                    <td class="text-black font-weight-bold"><strong>Tạm tính</strong></td>
                    <td class="text-black">350.000đ</td>
                  </tr>
                  <tr>
                    <td class="text-black font-weight-bold"><strong>Tổng đơn</strong></td>
                    <td class="text-black font-weight-bold"><strong>350.000đ</strong></td>
                  </tr>
                </tbody>
              </table>

              <!-- Phương thức thanh toán -->
              <div class="border p-3 mb-3">
                <h3 class="h6 mb-0">
                  <a data-toggle="collapse" href="#collapsebank">Chuyển khoản ngân hàng</a>
                </h3>
                <div class="collapse" id="collapsebank">
                  <div class="py-2">
                    <p>Vui lòng chuyển khoản kèm mã đơn hàng. Hàng sẽ được giao sau khi xác nhận thanh toán.</p>
                  </div>
                </div>
              </div>

              <div class="border p-3 mb-3">
                <h3 class="h6 mb-0">
                  <a data-toggle="collapse" href="#collapsecheque">Thanh toán bằng séc</a>
                </h3>
                <div class="collapse" id="collapsecheque">
                  <div class="py-2">
                    <p>Vui lòng thanh toán theo hướng dẫn bằng séc. Đơn hàng sẽ xử lý khi thanh toán hoàn tất.</p>
                  </div>
                </div>
              </div>

              <div class="border p-3 mb-5">
                <h3 class="h6 mb-0">
                  <a data-toggle="collapse" href="#collapsepaypal">Paypal</a>
                </h3>
                <div class="collapse" id="collapsepaypal">
                  <div class="py-2">
                    <p>Thanh toán nhanh chóng thông qua Paypal.</p>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <button class="btn btn-primary btn-lg btn-block" onclick="window.location='thankyou.html'">
                  Đặt hàng
                </button>
              </div>

            </div>
          </div>
        </div>

      </div>
    </div>

  </div>
</div>
