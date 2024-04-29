@extends ('interface/layout_interface')
@section('content')
<div class="container mt-4">
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
                    <div  class="login-img text-center">
                        <img src="{{asset('public/interface')}}/img/logofarm.png">
                    </div>
                    <div class="login-title  text-center">
                        <h4>Đăng ký</h4>
                    </div>
                    <div class="login-form mt-4">
                        <form action="{{route('gd.register')}}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <input name="fullname" placeholder="Tên" class="form-control" type="text">
                                    {!!$errors->first('fullname','<div class="has-error text-danger">:message</div>')!!}
                                </div>

                                <div class="form-group col-md-12">
                                        <input name="address" placeholder="Địa chỉ" class="form-control" type="text">
                                    {!!$errors->first('address','<div class="has-error text-danger">:message</div>')!!}
                                </div>
                                <div class="form-group col-md-12">
                                    <input name="email" placeholder="Email" class="form-control" type="text">
                                    {!!$errors->first('email','<div class="has-error text-danger">:message</div>')!!}
                                </div>
                                <div class="form-group col-md-12">
                                    <input name="phone" placeholder="Số điện thoại" class="form-control" type="number">
                                    {!!$errors->first('phone','<div class="has-error text-danger">:message</div>')!!}
                                </div>
                                <div class="form-group col-md-12">
                                    <input name="username" placeholder="Tài khoản" class="form-control" type="text">
                                    {!!$errors->first('username','<div class="has-error text-danger">:message</div>')!!}
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="password" class="form-control" name="password" placeholder="Mật khẩu">
                                </div>
                                {!!$errors->first('password','<div class="has-error text-danger">:message</div>')!!}
                            </div>

                            <a href="{{route('gd.login')}}" class="d-flex ">Đăng nhập</a>
                            <div class="form-row">
                                <button type="submit" class="btn btn-primary btn-block">Đăng ký</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection