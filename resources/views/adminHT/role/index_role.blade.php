@extends ('adminHT.layout')
@section ('content')
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Hi, welcome !</h4>

                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">

                    <a href="{{route('ht.role_add_view')}}" class="btn btn-rounded btn-info"><span
                            class="btn-icon-left text-info"><i class="fa fa-plus color-info"></i>
                        </span>Tạo mới vai trò</a>
                </ol>
            </div>
        </div>
        <!-- row -->


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Vai trò</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px; color:black;">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Vai trò</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php    foreach ($role as $value) {  ?>
                                    <tr>
                                        <td>{{$value['id']}}</td>
                                        <td>{{$value['name_role']}}</td>
                                        <td>
                                            <a href="{{route('ht.edit_role_view', $value['id'])}}" class="btn "><i
                                                    class="fa fa-pencil" style="color: green; font-size:13px;"></i></a>
                                            <a href="{{route('ht.delete_role', $value['id'])}}" class="btn "><i
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