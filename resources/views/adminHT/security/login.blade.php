<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login-Admin</title>
    <link href="{{asset('public')}}/webadmin/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="" style="background-image:url('https://images.pexels.com/photos/5632371/pexels-photo-5632371.jpeg'); 
    background-repeat: no-repeat;  background-size: cover;">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h4 class="text-center font-weight-light my-4"><i class="fa fa-key mx-2"
                                            aria-hidden="true"></i>ĐĂNG NHẬP ADMIN</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{route('ht.login')}}" method="post">
                                        @csrf
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="email" value="{{old('email')}} "  
                                                type="email" />
                                            {!!$errors->first('email', '<div class="d-flex has-error text-danger ">:message</div>')!!}
                                            <label for="inputEmail">Email</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="password" type="password"
                                                />
                                            {!!$errors->first('password', '<div class="d-flex has-error text-danger ">:message</div>')!!}
                                            <label for="inputPassword">Mật khẩu</label>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-center mt-4 mb-0">

                                            <button type="submit" class="btn btn-success">Đăng nhập </button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>