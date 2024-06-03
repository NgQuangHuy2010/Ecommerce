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
                

                </ol>
            </div>
        </div>
        <!-- row -->


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Đơn hàng</h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px; color:black;">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã đơn hàng</th>
                                        <th>Giá tiền</th>
                                        <th>Phương thức thanh toán</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày thanh toán</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php    foreach ($order as $value) {  
    ?>
                                    <tr>
                                        <td>{{$value['id']}}</td>
                                        <td>{{$value['order_id']}}</td>
                                        <td>{{ number_format($value['amount'], 0, ',', '.') }} VNĐ</td>
                                        <td>{{$value['order_info']}}</td>
                                        <td  style=" color: #00CC00;">{{$value['message']}}</td>

                                        <td>
                                            {{$value['created_at']}}
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    data-toggle="dropdown" aria-expanded="false">
                                                    Chọn
                                                </button>
                                                <div class="dropdown-menu">
                                                <a href="{{route('ht.order_details',$value['id'])}}" class="btn dropdown-item"><i class="fa fa-eye"
                                                            style="color: green; font-size:14px; margin-right:10px;"></i>Xem chi tiết</a>
                                                    <a href="" class="btn dropdown-item"><i class="fa fa-trash "
                                                            style="color: red; font-size:14px; margin-right:10px;"></i>Xóa</a>
                                                  

                                                </div>
                                            </div>


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