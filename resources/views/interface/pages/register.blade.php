
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
<div id="registerModal" class="modal fade" role="dialog">
    <div class="modal-dialog "> 
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mx-auto pl-5">Đăng ký tài khoản</h5>
                <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('gd.register') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="label-modal">Tên:</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" value="{{ old('fullname') }}">
                        @if ($errors->register->has('fullname'))
                      <p class="text-danger">{{ $errors->register->first('fullname') }}</p>
                        @endif
                    </div>
                   
                    <div class="form-group">
                        <label class="label-modal">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                        @if ($errors->register->has('email'))
                      <p class="text-danger">{{ $errors->register->first('email') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="label-modal">Mật khẩu:</label>
                        <input type="password" class="form-control" id="password" name="password">
                        @if ($errors->register->has('password'))
                      <p class="text-danger">{{ $errors->register->first('password') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="label-modal">Số điện thoại:</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
                        @if ($errors->register->has('phone'))
                      <p class="text-danger">{{ $errors->register->first('phone') }}</p>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-success form-control">Đăng ký</button>
                </form>
                <div class="mt-3 text-center">
                    <span>Đã có tài khoản đăng nhập? <button type="button" class="btn btn-link underline p-0" data-toggle="modal" data-target="#loginModal" data-dismiss="modal">tại đây</button></span>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
 
</style>
<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}


