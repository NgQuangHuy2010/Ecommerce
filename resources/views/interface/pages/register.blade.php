
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
<div id="registerModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered"> <!-- Thêm class modal-dialog-centered để căn giữa -->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Register</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('gd.register') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="fullname">Fullname:</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" value="{{ old('fullname') }}">
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
                @if ($errors->register->any())
                    <div class="alert alert-danger mt-3">
                        @foreach ($errors->register->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                <div class="mt-3">
                    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#loginModal" data-dismiss="modal">Already have an account? Login</button>
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


