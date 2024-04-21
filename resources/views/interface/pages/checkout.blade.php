@extends ('interface/layout_interface')
@section('content')
<?php 
if(Session::get("cart")){
?>
  <!-- Checkout Start -->
  <div class="container-fluid pt-5">
        <div class="row px-xl-5">
        <?php if(Auth::check()){?>
            <div class="col-lg-8">
             

                <div class="mb-4">
                    <h4 class="font-weight-semi-bold mb-4">Thông tin giao hàng</h4>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Tên</label>
                            <input class="form-control" type="text" value="<?php echo Auth::user()->fullname ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Email</label>
                            <input class="form-control" type="text" value="<?php echo Auth::user()->email ?>" >
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Số điện thoại</label>
                            <input class="form-control" type="text" value="<?php echo Auth::user()->phone ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Địa chỉ giao hàng</label>
                            <input class="form-control" type="text" value="<?php echo Auth::user()->address ?>" >
                        </div>
                       
                    </div>
                </div>
             
            </div>
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Order Total</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-medium mb-3">Products</h5>
                        <?php
                        $Subtotal=0; $total=0;
                         foreach(Session::get("cart") as $item ) {?>
                        <div class="d-flex justify-content-between">
                           <div class="d-flex ">
                           <p>{{$item['name']}}</p><b class="ml-2 "> x{{$item['soluong']}} </b>
                           </div>
                            <p>{{$item['price'] * $item['soluong'] }}</p>



                        </div>
                        <?php 
                        $Subtotal=$Subtotal+$item['soluong']*$item['price'];
                        } ?>
                        <hr class="mt-0">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium">{{ $Subtotal}}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">$0</h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold">{{ $Subtotal}}</h5>
                        </div>
                    </div>
                </div>
                <form action="{{route('gd.checkout')}}" method="post">
                    @csrf
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Payment</h4>
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
                        <button type="submit" class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Thanh toán</button>
                    </div>
                </div>
                </form>
            </div>
            
            <?php }else{ 
                    ?>Vui lòng đăng ký tài khoản để thanh toán
                    <a href="{{route('gd.register')}}">Đăng ký tài khoản</a>
                <?php } ?>
        </div>
    </div>
    <!-- Checkout End -->
    <?php }else{
    echo "<p align='center'>khong the thanh toan do gio hang trong</p>";
} ?>

@endsection