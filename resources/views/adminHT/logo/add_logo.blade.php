@extends ('adminHT.layout')
@section ('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.6.2/css/dropify.min.css" rel="stylesheet">
<div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <diveds class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Logo</h4>
                           
                        </div>
                    </diveds>
                   
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
                        <div class="card">
                       
                            <div class="card-body">
                                <form action="{{route('ht.logo_add')}}" method="post" enctype="multipart/form-data" id="step-form-horizontal" class="step-form-horizontal">
                                @csrf    
                                <div>
                             
                                  
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
                                    <div class="text-left mt-4 mb-5">
                                        <button class="btn btn-primary btn-sl-sm mr-3" type="submit"><span
                                                class="mr-2"><i class="fa fa-paper-plane"></i></span> Thêm</button>
                                        <a class="btn btn-dark btn-sl-sm" href="{{route('ht.logo')}}" ><span class="mr-2"><i
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