@extends ('adminHT.layout')
@section ('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.6.2/css/dropify.min.css" rel="stylesheet">
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <diveds class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Tạo mới tài khoản</h4>

                </div>
            </diveds>

        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">

                    <div class="card-body">
                        <form action="{{route('ht.account_add')}}" method="post" class="step-form-horizontal">
                            @csrf
                            <div>

                                <section>
                                    <div class="row">
                                        <div class="col-lg-6 mb-4">
                                            <div class="form-group">
                                                <h5><label class="text-label">Tên</label></h5>
                                                <input value="{{old('fullname')}}" name="fullname" type="text"
                                                    class="form-control">
                                                {!!$errors->first('fullname', '<div class="has-error text-danger">:message</div>')!!}
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-4">
                                            <div class="form-group">
                                                <h5><label class="text-label">Số điện thoại</label> </h5>
                                                <input type="text" class="form-control" value="{{old('phone')}}"
                                                    name="phone">
                                                {!!$errors->first('phone', '<div class="has-error text-danger">:message</div>')!!}
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-4">
                                            <div class="form-group">
                                                <h5> <label class="text-label">Email</label></h5>
                                               
                                                    <input class="form-control" value="{{old('email')}}" name="email"/>
                                                    {!!$errors->first('email', '<div class="has-error text-danger">:message</div>')!!}
                                                
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-4">
                                            <div class="form-group">
                                                <h5> <label class="text-label">Mật khẩu</label></h5>
                                                
                                                    <input class="form-control" value="{{old('password')}}"
                                                        name="password">
                                                    {!!$errors->first('password', '<div class="has-error text-danger">:message</div>')!!}
                                                
                                            </div>
                                        </div>
                                        <div class="col-lg-3 mb-4">
                                            <div class="form-group ">
                                                <label class="h6">Vai trò</label>
                                                <select name="role" class="form-control">
                                                    <option value=0>Người dùng</option>
                                                    @foreach($role as $item)
                                                        <option value="{{$item->id}}" class="h6">
                                                            {{$item->name_role}}
                                                        </option>
                                                    @endforeach
                                                    {!!$errors->first('role', '<div class="has-error text-danger">:message</div>')!!}
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 mb-4">
                                            <fieldset class="form-group">
                                                <div class="row">
                                                    <h5> <label class="col-form-label col-sm-12 pt-0">Trạng thái</label>
                                                    </h5>
                                                    <div class="col-sm-10">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="status"
                                                                checked value=1>
                                                            <label class="form-check-label">
                                                                Mở
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="status"
                                                                value=0>
                                                            <label class="form-check-label">
                                                                Khóa
                                                            </label>
                                                        </div>

                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>

                                </section>

                                <div class="text-left mt-4 mb-5">
                                    <button class="btn btn-primary btn-sl-sm mr-3" type="submit"><span class="mr-2"><i
                                                class="fa fa-paper-plane"></i></span> Thêm</button>
                                    <a class="btn btn-dark btn-sl-sm" href="{{route('ht.account')}}"><span
                                            class="mr-2"><i class="fa fa-times" aria-hidden="true"></i></span> Quay
                                        về</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection