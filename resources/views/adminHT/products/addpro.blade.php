
@extends ('adminHT.layout')
@section ('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.6.2/css/dropify.min.css" rel="stylesheet">
<div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <diveds class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Tạo mới sản phẩm</h4>
                           
                        </div>
                    </diveds>
                   
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
                        <div class="card">
                       
                            <div class="card-body">
                                <form action="{{route('ht.productsadd')}}" method="post" enctype="multipart/form-data" id="step-form-horizontal" class="step-form-horizontal">
                                @csrf    
                                <div>
                             
                                        <section>
                                            <div class="row">
                                                <div class="col-lg-6 mb-4">
                                                    <div class="form-group">
                                                       <h5><label class="text-label">Tên sản phẩm </label></h5> 
                                                        <input  value="{{old('name')}}"  type="text" class="form-control" name="name">
                                                                {!!$errors->first('name', '<div class="has-error text-danger">:message</div>')!!}                                               
                                        
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-4">
                                                    <h5><label class="text-label">Danh mục </label></h5> 
                                                 <select class="form-control" name="idcat">
                                                    @foreach($cate as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                      @endforeach
                                                    </select>
                                                </div>
                                                </div>
                                                <div class="col-lg-6 mb-4">
                                                    <div class="form-group">
                                                       <h5><label class="text-label">Từ khóa</label><h5> 
                                                        <input type="text" class="form-control" value="{{old('keyword')}}" name="keyword">
                                                        {!!$errors->first('keyword', '<div class="has-error text-danger">:message</div>')!!}
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mb-4">
                                                    <div class="form-group">
                                                     <h5>   <label class="text-label">Mô tả</label></h5>
                                                        <div class="input-group">
                                                            <input  class="form-control" value="{{old('desc')}}" name="desc">
                                                        {!!$errors->first('desc', '<div class="has-error text-danger">:message</div>')!!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mb-4">
                                                    <div class="form-group">
                                                   <h5>     <label class="text-label">Giá</label></h5>
                                                        <div class="input-group">
                                                            <input type="text"  class="form-control" name="price">
                                                        {!!$errors->first('price', '<div class="has-error text-danger">:message</div>')!!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mb-4">
                                                    <div class="form-group">
                                                   <h5>     <label class="text-label">Nội dung chi tiết</label></h5>
                                                        <div class="input-group">
                                                        <textarea class="form-control" name="content" id="content" cols="30" rows="10"></textarea>
                                                         <script>   CKEDITOR.replace('content');</script>
                                                        {!!$errors->first('datecreate', '<div class="has-error text-danger">:message</div>')!!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mb-4">
                                                <fieldset class="form-group">
                                            <div class="row">
                                               <h5> <label class="col-form-label col-sm-12 pt-0">Trạng thái</label></h5>
                                                <div class="col-sm-10">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="status" checked value=1>
                                                        <label class="form-check-label">
                                                          Mở
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"  name="status"  value=0>
                                                        <label class="form-check-label">
                                                          Khóa
                                                        </label>
                                                    </div>
                                               
                                                </div>
                                            </div>
                                        </fieldset>
                                            </div>
                                        </section>
                                                <div class="compose-content">
                                            <h5 class="mb-4"><i class="fa fa-paperclip"></i> Hình ảnh</h5>

                                            <div  class="d-flex flex-column align-items-center justify-content-center">
                                                <div class="fallback w-100">
                                                    <input type="file" onchange="onUpload(this)" class="dropify" name="image" accept="image/*">
                                                 {!!$errors->first('image', '<div class="has-error text-danger">:message</div>')!!}

                                                </div>
                                            </div>
                                            <div id="preview" class="mt-4"></div>
                                        </div>
                                        <div class="compose-content">
                                            <h5 class="mb-4"><i class="fa fa-paperclip"></i> Hình ảnh chi tiết</h5>

                                            <div  class="d-flex flex-column align-items-center justify-content-center">
                                                <div class="fallback w-100">
                                                    <input type="file" onchange="onUpload(this)" class="dropify" name="images[]" accept="image/*">
                                                     {!!$errors->first('images.*', '<div class="has-error text-danger">:message</div>')!!}

                                                </div>
                                            </div>
                                            <div id="preview" class="mt-4"></div>
                                        </div>
                                    <div class="text-left mt-4 mb-5">
                                        <button class="btn btn-primary btn-sl-sm mr-3" type="submit"><span
                                                class="mr-2"><i class="fa fa-paper-plane"></i></span> Thêm</button>
                                        <a class="btn btn-dark btn-sl-sm" href="{{route('ht.products')}}" ><span class="mr-2"><i
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.6.2/js/dropify.min.js"></script>
    <script>
    function onUpload(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var preview = document.getElementById('preview');
                preview.innerHTML = '<img src="' + e.target.result + '" alt="Uploaded Image" style="max-width: 100%; max-height: 300px;">';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Initialize Dropify plugin
    $('.dropify').dropify();
</script>

@endsection