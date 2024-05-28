@extends ('adminHT.layout')
@section ('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.6.2/css/dropify.min.css" rel="stylesheet">


<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <diveds class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Tạo đơn hàng mới</h4>

                </div>
            </diveds>

        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-8 col-xxl-12">
                <div class="card">

                    <div class="card-body">
                        <form action="{{ route('ht.order_add') }}" method="post" id="step-form-horizontal"
                            class="step-form-horizontal">
                            @csrf
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
                        </form>
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
                        <form action="" method="post" id="step-form-horizontal" class="step-form-horizontal">
                            @csrf
                            <div>
                                <section>
                                    <div class="row">
                                        <div class="col-lg-12 mb-4">
                                            <div class="form-group">
                                                <div class="d-flex justify-content-between align-items-center mb-4 ">
                                                    <h5><label class="text-label">Thông tin khách hàng</label></h5>
                                                    <a class="text-light  btn btn-success" href="">&#10010; Tạo mới </a>
                                                </div>

                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="account-search"
                                                        placeholder="Tìm kiếm khách hàng">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" type="button"
                                                            id="account-search-button">Tìm kiếm</button>
                                                    </div>
                                                </div>
                                                <div id="account-search-results"></div>

                                            </div>

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
    const csrfToken = '{{ csrf_token() }}';
    const productSearchRoute = '{{ route("product.search") }}';
    const accountSearchRoute = '{{ route("account.search") }}';
    const accountStoreInSessionRoute = '{{ route("account.storeInSession") }}';
</script>
<script src="{{ asset('public\webadmin\assets\js\add_order.js') }}"></script>
@endsection