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
        <div class="col-md-5 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <!-- <div class="login-img text-center" >
                        <img src="{{asset('public/interface')}}/img/logofarm.png">
                    </div> -->
                    <div class="login-title text-center">
                        <h4>Log In</h4>
                    </div>
                    <div class="login-form mt-4">
                        <form action="{{route('gd.login')}}" method="post" >
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <input id="email" name="email" placeholder="Email" value="{{old('email')}}" class="form-control"
                                        type="text">
                                    {!!$errors->first('email','<div class="has-error text-danger">:message</div>')!!}

                                </div>
                                <div class="form-group col-md-12">
                                    <input type="password" name="password" class="form-control"  id="pass" placeholder="Password">
                                {!!$errors->first('password','<div class="has-error text-danger">:message</div>')!!}

                                </div>
                            </div>
                            <div class="form-row d-flex justify-content-between">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input name="remember" class="form-check-input" type="checkbox" value=1 id="updatecheck1">
                                        <label class="form-check-label" for="updatecheck1">
                                            <small >Remember me</small>
                                            <small><a class="pl-2" href="{{route('gd.forget')}}">Reset Password </a> </small>
                                        </label>

                                    </div>

                                </div>
                                <a href="{{route('gd.register')}}">Register</a>
                            </div>

                  
                            <div class="form-row">
                                <button type="submit" class="btn btn-primary btn-block">Log in</button>
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