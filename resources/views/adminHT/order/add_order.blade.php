@extends ('adminHT.layout')
@section ('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.6.2/css/dropify.min.css" rel="stylesheet">


<div class="content-body">
    <div class="container-fluid">
        <form action="{{route('ht.save_info_Customer')}}" method="post" id="shipment-form" class="step-form-horizontal">
            @csrf
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Tạo đơn hàng mới</h4>

                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <button type="submit" class="btn btn-primary">Lưu</button>
                        <button class="btn btn-light mx-2">Tạo lại</button>

                    </ol>
                </div>
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-xl-8 col-xxl-12">
                    <div class="card">

                        <div class="card-body">


                            <div>
                                <section>
                                    <div class="row">
                                        <div class="col-lg-12 mb-4">
                                            <div class="form-group">
                                                <h5><label class="text-label">Sản phẩm</label></h5>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="product-search"
                                                        placeholder="Tìm kiếm sản phẩm">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" type="button"
                                                            id="search-button">Tìm kiếm</button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="search-results" class="mt-4">
                                                <table class="table">
                                                    <tbody id="search-results-body">
                                                        <thead>
                                                            <tr>
                                                                <th>Sản phẩm</th>
                                                                <th>Số lượng</th>
                                                                <th>Giá (đ)</th>
                                                                <th>Thành tiền (đ)</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                    </tbody>
                                                </table>
                                            </div>


                                        </div>
                                    </div>
                                </section>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card">

                        <div class="card-body">
                            <div>
                                <section>
                                    <div class="row">
                                        <div class="col-lg-12 mb-4">
                                            <div class="d-flex justify-content-between align-items-center h6">
                                                <div>Số lượng sản phẩm:</div>
                                                <span id="product-count">0</span>
                                            </div>

                                            <div class="d-flex justify-content-between align-items-center h6 mt-2">
                                                <strong>Tổng tiền hàng:</strong>
                                                <span id="total-price">0 đ</span>
                                            </div>

                                            <div class="d-flex justify-content-between align-items-center h6 mt-2">
                                                <div>Giảm giá:</div>
                                                <span id="discount">10.000 đ</span>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center h6 mt-2">
                                                <div>Phí vận chuyển:</div>
                                                <span>0 đ</span>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center h6 mt-2">
                                                <div class="text-danger">Tổng thanh toán:</div>
                                                <span id="total-payment">0 đ</span>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-xl-8 col-xxl-12">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <section>
                                    <div class="row">
                                        <div class="col-lg-12 mb-4">
                                            <div class="form-group">
                                                <div class="d-flex justify-content-between align-items-center mb-4">
                                                    <h5><label class="text-label">Thông tin khách hàng</label></h5>
                                                    <!-- <a class="text-light btn btn-success" href="">&#10010; Tạo mới </a> -->
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label class="h6">Tên khách hàng</label>
                                                        <input type="text" name="fullname" class="form-control">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="h6">Email</label>
                                                        <input type="email" name="email" class="form-control">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="h6">Số điện thoại</label>
                                                        <input type="number" name="phone" class="form-control">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="h6">Địa chỉ</label>
                                                        <input type="text" name="address" class="form-control">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label class="h6">Chọn tỉnh/thành phố</label>
                                                        <select name="province" id="province" class="form-control">
                                                            <option>Chọn...</option>
                                                            @if ($locations)
                                                                @foreach ($locations as $province)
                                                                    <option value="{{ $province['name'] }}">
                                                                        {{ $province['name'] }}
                                                                    </option>
                                                                @endforeach
                                                            @else
                                                                <option value="">Không có dữ liệu</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label class="h6" for="district">Chọn quận/huyện </label>
                                                        <select name="district" id="district" class="form-control">
                                                            <option>Chọn...</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label class="h6">Chọn phường/xã</label>
                                                        <select name="ward" id="ward" class="form-control">
                                                            <option>Chọn...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" id="selected_province" name="selected_province"
                                                value="">
                                            <input type="hidden" id="selected_district" name="selected_district"
                                                value="">
                                            <input type="hidden" id="selected_ward" name="selected_ward" value="">
                                            <input type="hidden" id="products" name="products" value="">
                                            <input type="hidden" id="totalPayment" name="totalPayment" value="">

                                        </div>
                                    </div>
                                </section>

                            </div>
        </form>



    </div>
</div>
</div>
</div>




</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.6.2/js/dropify.min.js"></script>

<script>
    //tạo var locations chứa json($loactions) từ view trên để tạo file js riêng gọi vào 
    var locations = @json($locations);
</script>

<script src="{{asset('public')}}/webadmin/assets/js/select-address-admin.js"></script>

<script>
    const csrfToken = '{{ csrf_token() }}';
    const productSearchRoute = '{{ route("product.search") }}';
</script>
<script src="{{ asset('public\webadmin\assets\js\add-order-products.js') }}"></script>


@endsection