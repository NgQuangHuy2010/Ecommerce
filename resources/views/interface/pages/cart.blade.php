@extends ('interface/layout_interface')
@section('content')
<!-- Cart Start -->
<?php 
if (Session::get("cart")) {
?>
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-bordered text-center mb-0">
                <thead class=" text-dark">
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng giá</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                   
                    <tr>
                        <td class="align-middle"><img src="img/product-5.jpg" alt="" style="width: 50px;"> {{$item['name']}}</td>
                        <td class="align-middle">{{$item['price']}}</td>
                        <td class="align-middle d-flex justify-content-center" >
                            <div class="input-group quantity mx-auto d-flex  " style="width: 100px;">
                            
                                <input type="number" class="form-control form-control-sm " value="{{$item['soluong']}}" name="quantity" data-id="{{$item['id']}}" onchange="updatecart(this)" >
                               
                            </div>
                        </td>
                        <?php
    $Subtotal = 0;
    $total = 0;
$total_price_all_products = 0;

    foreach (Session::get("cart") as $item) {?>
    <?php
    // Loại bỏ dấu chấm và dấu phẩy từ giá
    $cleaned_price = str_replace(['.', ','], '', $item['price']);

    // Chuyển đổi giá thành số nguyên
    $price_integer = intval($cleaned_price);

    // Tính giá cuối cùng của mỗi sản phẩm
    $total_price_per_item = $price_integer * $item['soluong'];

    // Cộng giá của sản phẩm này vào tổng giá của tất cả các sản phẩm
    $total_price_all_products += $total_price_per_item;
    ?>
                       <td class="align-middle"></td>

                        <td class="align-middle">
                            <a href="{{route('gd.delcart', $item['id'])}}" class="btn btn-sm btn-cart"><i class="fa fa-times"></i></a></td>
                    </tr>
                   
                    <?php  } ?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <form class="mb-5" action="">
                <div class="input-group">
                    <input type="text" class="form-control p-4" placeholder="Coupon Code">
                    <div class="input-group-append">
                        <button class="btn btn-cart">Apply Coupon</button>
                    </div>
                </div>
            </form>
            <div class="card border-secondary mb-5">
                <div class="card-header  border-0">
                    <h4 class="font-weight-semi-bold m-0">Chi tiết giỏ hàng</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3 pt-1">
                        <h6 class="font-weight-medium">Subtotal</h6>
                        <h6 class="font-weight-medium"></h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium">$10</h6>
                    </div>
                </div>
                <div class="card-footer border-secondary bg-transparent">
                    <div class="d-flex justify-content-between mt-2">
                        <h5 class="font-weight-bold">Total</h5>
                        <h5 class="font-weight-bold">$160</h5>
                    </div>
                    <a href="{{route('gd.checkout')}}" class="btn btn-block btn-cart my-3 py-3">Proceed To Checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->
<?php } else {
    echo "<p align='center'>gio hang trong</p>";
} ?>
@endsection

@pushOnce('scripts')
    <script>
        function updatecart(row){
            var id=$(row).data('id');
            var soluong=$(row).val();
            $.ajax({
                url: "{{route('gd.addcart')}}",
                type:'post',
                data: { 
                    'id':id,
                    'soluong': soluong,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                success: function(message){
                    if(message){
                        location.reload();
                    }else{
                        alert("add to cart failed!");
                        location.reload();
                    }
                }
            });
        }
    </script>




@endPushOnce