@extends ('interface/layout_interface')
@section('content')
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">


<div class="container my-5 py-2">
    <style>
        .login-img img {
            width: 10%;
            max-height: 20%;
        }
    </style>
    <div class="row ">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <!-- <div class="login-img text-center" >
                        <img src="{{asset('public/interface')}}/img/logofarm.png">
                    </div> -->
                    <div class="login-title text-center">
                        <h4>Lấy lại mật khẩu</h4>
                    </div>
                    <div class="login-form mt-4">
                        <form action="{{route('gd.forgetPost')}}" method="post" >
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <input id="email" name="email" placeholder="Nhập email đã đăng ký" value="{{old('email')}}" class="form-control"
                                        type="text">
                                    {!!$errors->first('email','<div class="has-error text-danger">:message</div>')!!}

                                </div>
                               
                            </div>

                            <div class="form-row">
                                <button type="submit" class="btn btn-primary btn-block">Reset Mật khẩu</button>
                            </div>
                      
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}
@endsection