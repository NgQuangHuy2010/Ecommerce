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
                        <a href="{{route('ht.productsadd')}}" class="btn btn-rounded btn-info"><span
                                        class="btn-icon-left text-info"><i class="fa fa-plus color-info"></i>
                                    </span>Tạo mới</a>
                           
                        </ol>
                    </div>
                </div>
                <!-- row -->
               

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">Sản phẩm</h2>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px; color:black;">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Tên sản phẩm</th>
                                                <th>Danh mục</th>
                                                <th>Mô tả</th>
                                                <th>Giá</th>
                                                <th>Hình ảnh</th>
                                                <th>Trạng thái</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php    foreach ($products as $value){  
    ?> 
                                            <tr>
                                                <td>{{$value['id']}}</td>
                                                <td>{{$value['name']}}</td>
                                                <td>{{$value->categories->name}}</td>
                                                <td>{{$value['desc']}}</td>
                                                <td>{{$value['price']}}</td>
                                                <td><img width="100" height="100" src="{{asset('public/file/img/img_product/'.$value->image)}}" alt=""></td>
                                                <td>
                                                    @if($value->status == 1)
                                                <span
                                                    style="font-weight:bold; border: 2px solid #0f994b; padding: 2px 5px; color: #0f994b;">Mở</span>
                                                @else
                                                <span
                                                    style="font-weight:bold; border: 2px solid #df2a3c; padding: 2px 5px; color: #df2a3c;">Khóa
                                                </span>
                                                @endif
                                                </td>
                                                <td>
                                                <a href="{{route('ht.productsupdate',$value['id'])}}" class="btn "><i
                                                        class="fa fa-pencil" style="color: green; font-size:13px;"></i></a>
                                                <a href="{{route('ht.productsdelete',$value['id'])}}" class="btn "><i
                                                        class="fa fa-trash " style="color: red; font-size:13px;"></i></a>

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