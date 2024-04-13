@extends ('interface/layout_interface')
@section('content')
<!-- Cart Start -->
<?php 
if(Session::get("cart")){
?>
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-bordered text-center mb-0">
                <thead class="bg-secondary text-dark">
                    <tr>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    <?php
                        $Subtotal=0; $total=0;
                         foreach(Session::get("cart") as $item ) {?>
                    <tr>
                        <td class="align-middle"><img src="img/product-5.jpg" alt="" style="width: 50px;"> {{$item['name']}}</td>
                        <td class="align-middle">{{$item['price']}}</td>
                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                            
                                <input type="number" class="form-control form-control-sm bg-secondary text-center"
                                    value="{{$item['soluong']}}" name="quantity" data-id="{{$item['id']}}" onchange="updatecart(this)" >
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle">{{$item['price']*$item['soluong']}}</td>
                        <td class="align-middle">
                            <a href="{{route('gd.delcart',$item['id'])}}" class="btn btn-sm btn-primary"><i class="fa fa-times"></i></a></td>
                    </tr>
                    <?php 
                        $Subtotal=$Subtotal+$item['soluong']*$item['price'];
                        } ?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <form class="mb-5" action="">
                <div class="input-group">
                    <input type="text" class="form-control p-4" placeholder="Coupon Code">
                    <div class="input-group-append">
                        <button class="btn btn-primary">Apply Coupon</button>
                    </div>
                </div>
            </form>
            <div class="card border-secondary mb-5">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3 pt-1">
                        <h6 class="font-weight-medium">Subtotal</h6>
                        <h6 class="font-weight-medium">${{$Subtotal}}</h6>
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
                    <a href="{{route('gd.checkout')}}" class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->
<?php }else{
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