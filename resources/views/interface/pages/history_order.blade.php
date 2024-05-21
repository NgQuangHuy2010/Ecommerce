@extends('interface.layout_interface')
@section('content')
<div class="container my-5">
    <h3 class="mb-4">Lịch sử đơn hàng</h3>

    @if(session('order_not_found'))
        <div class="alert alert-danger" role="alert">
            Không tìm thấy hóa đơn !!
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <!-- Form tìm kiếm đơn hàng -->
            <form class="mb-4" action="{{ route('gd.searchorder') }}" method="post">
                @csrf
                <div class="form-group row">
                    <label for="order_id_momo" class="col-sm-4 col-lg-2 col-form-label">Nhập số hóa đơn:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="order_id_momo" name="order_id_momo" required>
                    </div>
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                    </div>
                </div>
            </form>

            <h4 class="my-3">Hóa đơn</h4>

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Hóa đơn số</th>
                            <th scope="col">Mã hóa đơn</th>
                            <th scope="col">Ngày đặt hàng</th>
                            <th scope="col">Số tiền</th>
                            <th scope="col">Phương thức thanh toán</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->order_id_momo }}</td>
                                <td>{{ $order->partner_code }}</td>
                                <td>{{ date('d-m-Y', strtotime($order->created_at)) }}</td>
                                <td>{{ number_format($order->amount, 0, ',', '.') }} VNĐ</td>
                                <td>{{ $order->order_info }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <h4 class="my-3">Chi tiết hóa đơn</h4>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Tên khách hàng</th>
                            <th scope="col">Email</th>
                            <th scope="col">Số điện thoại</th>
                            <th scope="col">Địa chỉ </th> 
                            <th scope="col">Sản phẩm </th>
                          
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->fullname }}</td>
                            <td>{{ $order->email }}</td>
                            <td>{{ $order->phone }}</td>
                            <td>{{ $order->address }}, {{ $order->ward }}, {{ $order->district }}, {{ $order->province }}</td>
                            
                            <td>{{ $order->formatted_products }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
