@extends ('adminHT.layout')
@section ('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.6.2/css/dropify.min.css" rel="stylesheet">
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{ isset($account) ? 'Cập nhật tài khoản' : 'Thêm tài khoản mới' }}</h4>
                    </div>
                </div>
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-xl-12 col-xxl-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ isset($account) ? route('ht.account_update', $account->id) : route('ht.add_account') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 mb-4">
                                        <div class="form-group">
                                            <label class="text-label font-weight-bold">Họ và tên</label>
                                            <input type="text" class="form-control" name="fullname" value="{{ old('fullname', isset($account) ? $account->fullname : '') }}" placeholder="Nhập họ và tên">
                                            @error('fullname')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        <div class="form-group">
                                            <label class="text-label font-weight-bold">Email</label>
                                            <input type="email" class="form-control" name="email" value="{{ old('email', isset($account) ? $account->email : '') }}" placeholder="Nhập email">
                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        <div class="form-group">
                                            <label class="text-label font-weight-bold">Số điện thoại</label>
                                            <input type="text" class="form-control" name="phone" value="{{ old('phone', isset($account) ? $account->phone : '') }}" placeholder="Nhập số điện thoại">
                                            @error('phone')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        <div class="form-group">
                                            <label class="text-label font-weight-bold">Mật khẩu</label>
                                            <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu">
                                            @error('password')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        <div class="form-group">
                                            <label class="text-label font-weight-bold">Vai trò</label>
                                            <select class="form-control" name="role">
                                                <option value="">Chọn vai trò</option>
                                                @foreach($role as $item)
                                                    <option value="{{ $item->id }}" {{ (old('role', isset($account) && $account->roles->first() ? $account->roles->first()->id : '') == $item->id) ? 'selected' : '' }}>{{ $item->name_role }}</option>
                                                @endforeach
                                            </select>
                                            @error('role')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="text-left mt-4 mb-5">
                                    <button type="submit" class="btn btn-primary">{{ isset($account) ? 'Cập nhật' : 'Thêm mới' }}</button>
                                    <a href="{{ route('ht.account') }}" class="btn btn-secondary ml-2">Quay lại</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
