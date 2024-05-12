
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
<!-- resources/views/login-modal.blade.php -->

<!-- resources/views/login-modal.blade.php -->

<div id="myModal" class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header ">
        <h5 class="modal-title text-center" >Đăng nhập</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form id="loginForm" action="{{ route('gd.login') }}" method="POST">
          @csrf
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ session('email') }}">
          </div>
          <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" value="{{ session('password') }}">
          </div>
          <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
        </form>
      </div>
    </div>
  </div>
</div>


<style>
  /* Modal (background) */
.modal {
  display: none;
  position: fixed;
  z-index: 1050;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: hidden;
  background-color: rgba(0, 0, 0, 0.4);
}

/* Modal Content/Box */
.modal-dialog {
  margin: 15% auto;
}

/* Style form */
form {
  width: 100%;
}

label {
  display: block;
}

input[type="email"],
input[type="password"] {
  width: 100%;
  padding: 10px;
  margin-bottom: 10px;
}

input[type="submit"] {
  width: 100%;
  padding: 10px;
  margin-top: 10px;
}

.modal-header {
  border-bottom: none;
 
}

.modal-title {
  margin-right: auto;
  font-weight: bold;
  
}
.close{
    font-size: 40px;
}


</style>


<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}


