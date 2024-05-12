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
                <?php foreach (Session::get("cart") as $item) {
              
                    ?>
                    <tr>
                        <td class="align-middle"><img src="img/product-5.jpg" alt="" style="width: 50px;"> {{$item['name']}}</td>
                        <td class="align-middle">{{$item['price']}}</td>
                        <td class="align-middle d-flex justify-content-center" >
                            <div class="input-group quantity mx-auto d-flex  " style="width: 100px;">
                            
                                <input type="number" class="form-control form-control-sm " value="{{$item['soluong']}}" name="quantity" data-id="{{$item['id']}}" onchange="updatecart(this)" >
                               
                            </div>
                        </td>
                       <td class="align-middle">{{$item['soluong']*$item['price']}}</td>
                        <td class="align-middle">
                            <a href="{{route('gd.delcart', $item['id'])}}" class="btn btn-sm btn-cart"><i class="fa fa-times"></i></a></td>
                    </tr>
                   
                    <?php  } ?>
                </tbody>
            </table>
        </div>
        <?php 
$totalAmount = 0; // Khởi tạo biến tổng số tiền

foreach (Session::get("cart") as $item) {
    // Tính tổng số tiền cho từng sản phẩm và cộng vào biến tổng số tiền
    $totalAmount += $item['soluong'] * $item['price'];
}
?>

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
                        <h6 class="font-weight-medium"> {{$totalAmount}}</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium">$0</h6>
                    </div>
                </div>
                <div class="card-footer border-secondary bg-transparent">
                    <div class="d-flex justify-content-between mt-2">
                        <h5 class="font-weight-bold">Total</h5>
                        <h5 class="font-weight-bold">{{$totalAmount}}</h5>
                    </div>
                    <a href="{{route('gd.checkout')}}" class="btn btn-block btn-cart my-3 py-3">Proceed To Checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->
<?php } else {
echo "<p align='center' style='margin-top: 100px; margin-bottom: 100px;'>Giỏ hàng trống! <a style='color:green;' href='" . route("gd.home") . "'>Tiếp tục mua hàng</a></p>";




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