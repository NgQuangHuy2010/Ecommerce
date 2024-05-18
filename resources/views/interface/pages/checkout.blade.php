@extends ('interface/layout_interface')
@section('content')
<?php 
if (Session::get("cart")) {
?>

<!-- Checkout Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <?php    if (Auth::check()) {?>
        <div class="col-lg-8">

            <form action="{{route('gd.save_information')}}" method="post" name="form">
                @csrf

                <div class="mb-4">
                    <h4 class="font-weight-semi-bold mb-4">Thông tin giao hàng</h4>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Tên</label>
                            <input class="form-control" name="fullname" type="text"
                                value="<?php        echo Auth::user()->fullname ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Email</label>
                            <input class="form-control" name="email" type="text"
                                value="<?php        echo Auth::user()->email ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Số điện thoại</label>
                            <input class="form-control" name="phone" type="text"
                                value="<?php        echo Auth::user()->phone ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Địa chỉ giao hàng</label>
                            <input class="form-control" name="address" type="text"
                                value="<?php        echo Auth::user()->address ?>">

                        </div>


                        <div class="form-group col-md-4">
                            <label for="province">Chọn tỉnh/thành phố</label>
                            <select id="province" class="form-control">
                                <option value="">Chọn tỉnh/thành phố</option>
                                @if ($locations)
                                    @foreach ($locations as $province)
                                        <option name="province" value="{{ $province['name'] }}">{{ $province['name'] }}</option>
                                    @endforeach
                                @else
                                    <option value="">Không có dữ liệu</option>
                                @endif
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="district">Chọn quận/huyện</label>
                            <select id="district" class="form-control">
                                <option name="district" value="">Chọn quận/huyện</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="ward">Chọn phường/xã</label>
                            <select id="ward" class="form-control">
                                <option name="ward" value="">Chọn phường/xã</option>
                            </select>
                        </div>
                    </div>
                </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-secondary mb-5">
                <div class="card-header bg-success border-0">
                    <h4 class="font-weight-semi-bold m-0 text-light">Xác nhận hóa đơn</h4>
                </div>
                <div class="card-body">
                    <h5 class="font-weight-medium mb-3">Sản phẩm</h5>
                    <?php
        $Subtotal = 0;
        $total = 0;
        foreach (Session::get("cart") as $item) {?>
                    <!-- vòng lặp foreach lấy từng só lượng sản phẩm khi có nhiều sản phẩm và số lượng-->
                    <input type="hidden" name="name_product" value="{{ $item['name'] }}">
                    <input type="hidden" name="quantity" value="{{ $item['soluong'] }}">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex ">
                            <p>{{$item['name']}}</p><b class="ml-2 "> x{{$item['soluong']}} </b>
                        </div>
                        <p>{{ number_format($item['price'] * $item['soluong'], 0, ',', ',') }} VNĐ</p>
                    </div>

                    <?php 
                        $Subtotal = $Subtotal + $item['soluong'] * $item['price'];

        } ?>
                    <hr class="mt-0">
                    <div class="d-flex justify-content-between mb-3 pt-1">
                        <h6 class="font-weight-medium">Tổng tiền sản phẩm</h6>
                        <h6 class="font-weight-medium">{{ number_format($Subtotal, 0, ',', ',') }} VNĐ</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium">$0</h6>
                    </div>
                </div>
                <div class="card-footer border-secondary bg-transparent">
                    <div class="d-flex justify-content-between mt-2">
                        <h5 class="font-weight-bold">Tổng thanh toán</h5>
                        <h5 class="font-weight-bold">{{ number_format($Subtotal, 0, ',', ',') }} VNĐ</h5>
                    </div>
                </div>
            </div>

            <input type="hidden" name="total_price" value="{{ $Subtotal }}">




            <div class="card border-secondary mb-5">
                <div class="card-header bg-success border-0">
                    <h4 class="font-weight-semi-bold m-0 text-light">Phương thức thanh toán</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="payment" id="paypal" value=1 checked>
                            <label class="custom-control-label" for="paypal">VNPAY</label>
                        </div>
                    </div>
                </div>
                <div class="card-footer border-secondary bg-transparent">
                    <button type="submit" class="btn btn-lg btn-block btn-danger font-weight-bold my-3 py-3">Thanh
                        toán</button>
                </div>
            </div>
        </div>
        </form>
        <?php    } else { 
                    ?>
        <div class="m-auto py-5">Vui lòng đăng ký tài khoản để thanh toán&nbsp;
            <button class="btn btn-link p-0 underline" data-toggle="modal" data-target="#registerModal"
                data-dismiss="modal"> tại đây</button>
        </div>
        <?php    } ?>
    </div>
</div>
<!-- Checkout End -->
<?php } else {
    echo "<p align='center'>khong the thanh toan do gio hang trong</p>";
} ?>
<script>
    // Thay đổi khi chọn tỉnh/thành phố
    $('#province').change(function () {
        var province = $(this).val();
        $('#district').html('<option value="">Chọn quận/huyện</option>');
        $('#ward').html('<option value="">Chọn phường/xã</option>');

        // Lọc danh sách quận/huyện dựa trên tỉnh/thành phố đã chọn
        var districts = @json($locations);

        $.each(districts, function (key, value) {
            if (value.name === province) {
                $.each(value.districts, function (key, district) {
                    $('#district').append('<option value="' + district.name + '">' + district.name + '</option>');
                });
            }
        });
    });

    // Thay đổi khi chọn quận/huyện
    $('#district').change(function () {
        var district = $(this).val();
        $('#ward').html('<option value="">Chọn phường/xã</option>');

        // Lọc danh sách phường/xã dựa trên quận/huyện đã chọn
        var districts = @json($locations);

        $.each(districts, function (key, value) {
            $.each(value.districts, function (key, value) {
                if (value.name === district) {
                    $.each(value.wards, function (key, ward) {
                        $('#ward').append('<option value="' + ward.name + '">' + ward.name + '</option>');
                    });
                }
            });
        });
    });
</script>
@endsection