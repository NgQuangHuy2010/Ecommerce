@extends ('adminHT.layout')
@section ('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.6.2/css/dropify.min.css" rel="stylesheet">
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <diveds class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Tạo mới vai trò</h4>

                </div>
            </diveds>

        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">

                    <div class="card-body">
                        <form action="{{ route('ht.role_add') }}" method="post" class="step-form-horizontal">
                            @csrf
                            <div>
                                <section>
                                    <div class="row">
                                        <div class="col-lg-6 mb-4">
                                            <div class="form-group">
                                                <h5><label class="text-label">Tên</label></h5>
                                                <input value="{{old('name_role')}}" name="name_role" type="text"
                                                    class="form-control">
                                                {!!$errors->first('name_role', '<div class="has-error text-danger">:message</div>')!!}
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-4">
                                            <div class="basic-form">
                                                <div class="form-group">
                                                    <div class="form-check mb-2">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="permissions[]" value="manage_accounts">
                                                        <label class="form-check-label h6">Quản lý tài khoản</label>
                                                    </div>
                                                    <div class="form-check mb-2">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="permissions[]" value="manage_products">
                                                        <label class="form-check-label h6">Quản lý danh mục và sản
                                                            phẩm</label>
                                                    </div>
                                                    <div class="form-check mb-2">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="permissions[]" value="manage_logo">
                                                        <label class="form-check-label h6">Quản lý logo</label>
                                                    </div>
                                                    <div class="form-check mb-2">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="permissions[]" value="manage_banner">
                                                        <label class="form-check-label h6">Quản lý banner</label>
                                                    </div>
                                                    <div class="form-check mb-2">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="permissions[]" value="manage_orders">
                                                        <label class="form-check-label  h6">Quản lý đơn hàng</label>
                                                    </div>
                                                {!!$errors->first('permissions', '<div class="has-error text-danger">:message</div>')!!}

                                                </div>
                                            </div>
                                        </div>
                                </section>
                                <div class="text-left mt-4 mb-5">
                                    <button class="btn btn-primary btn-sl-sm mr-3" type="submit"><span class="mr-2"><i
                                                class="fa fa-paper-plane"></i></span> Thêm</button>
                                    <a class="btn btn-dark btn-sl-sm" href="{{route('ht.role')}}"><span class="mr-2"><i
                                                class="fa fa-times" aria-hidden="true"></i></span> Quay về</a>
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