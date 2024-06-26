@extends ('interface/layout_interface')
@section('content')
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">


<div class="container my-5">
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
                    <div class="login-img text-center" >
                        <img src="{{asset('public/interface')}}/img/logofarm.png">
                    </div>
                    <div class="login-title text-center">
                        <h4>Log In</h4>
                    </div>
                    <div class="login-form mt-4">
                        <form action="{{route('gd.resetPasswordPost')}}" method="post" >
                            @csrf
                            <input type="text" name="token" hidden value="{{$token}}">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <input id="email" name="email" placeholder="Email" value="{{old('email')}}" class="form-control"
                                        type="text">
                                    {!!$errors->first('email','<div class="has-error text-danger">:message</div>')!!}

                                </div>
                                <div class="form-group col-md-12">
                                    <input name="password" placeholder="New Password" class="form-control"
                                        type="password">
                                        {!!$errors->first('password','<div class="has-error text-danger">:message</div>')!!}
                               

                                </div>
                                <div class="form-group col-md-12">
                                    <input name="password_confirmation" placeholder="Confirm Password" class="form-control"
                                        type="password">
                                     
                                   

                                </div>
                            </div>

                            <div class="form-row">
                                <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                            </div>
                      
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}
@endsection