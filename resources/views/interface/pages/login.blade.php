
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
<div id="loginModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Login</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('gd.login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                      @if ($errors->login->has('email'))
                      
                          <p class="text-danger">{{ $errors->login->first('email') }}</p>
                   
                  @endif
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password">
                        @if ($errors->login->has('password'))
                        
                            <p class="text-danger">{{ $errors->login->first('password') }}</p>
                       
                    @endif
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            
                <div class="mt-3">
                    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#registerModal" data-dismiss="modal">Don't have an account? Register</button>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}


