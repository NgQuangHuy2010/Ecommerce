
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
<div id="loginModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header ">
    <h5 class="modal-title mx-auto pl-5">Đăng nhập tài khoản</h5>
    <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">&times;</button>
</div>

            <div class="modal-body">
                <form action="{{ route('gd.login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="label-modal">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                      @if ($errors->login->has('email'))
                      
                          <p class="text-danger">{{ $errors->login->first('email') }}</p>
                   
                  @endif
                  {!!$errors->first('email','<p class="has-error text-danger">:message</p>')!!}
                    </div>
                    <div class="form-group">
                        <label class="label-modal">Mật khẩu:</label>
                        <input type="password" class="form-control" id="password" name="password">
                        @if ($errors->login->has('password'))
                        
                            <p class="text-danger">{{ $errors->login->first('password') }}</p>
                       
                    @endif
                    </div>
               <p class="text-muted">
               <a href="{{route("gd.forget")}}" class="text-reset underline "> Quên mật khẩu?</a>
               </p>
                    
                    <button  type="submit" class="btn btn-success form-control">Đăng nhập</button>
                </form>
                <div class="mt-3 text-center">
                <span >Chưa có tài khoản đăng ký?<button  class="btn btn-link p-0 underline" data-toggle="modal" data-target="#registerModal" data-dismiss="modal"> tại đây</button></span>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>



