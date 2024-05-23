@extends ('adminHT.layout')
@section ('content')
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <h4>Hi, welcome !</h4>

            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <a href="{{route('ht.order')}}" class="btn btn-rounded btn-info"><span class="btn-icon-left text-info"><i
                                class="fa fa-undo color-info"></i>
                        </span>Quay về</a>

                </ol>
            </div>
        </div>
        <!-- row -->


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Chi tiết đơn hàng</h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px; color:black;">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên khách hàng</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Địa chỉ</th>
                                        <th>Sản phẩm mua</th>
                                        <th>Tổng tiền</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php    foreach ($order_details as $value) {  ?>
                                    <tr>
                                        <td>{{$value['id']}}</td>
                                        <td>{{$value['fullname']}}</td>
                                        <td>{{$value['email']}}</td>
                                        <td>{{$value['phone']}}</td>
                                        <td>
                                            {{$value['address']}}, {{$value['ward']}},
                                            {{$value['district']}},{{$value['province']}}
                                        </td>
                                        <td>{{$value->formatted_products}}</td>
                                        <td> {{ number_format($value['total_price'], 0, ',', '.') }} VNĐ</td>
                                        <td>
                                            <a href="" class="btn"><i class="fa fa-trash "
                                                    style="color: red; font-size:14px; margin-right:10px;"></i></a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}
@endsection