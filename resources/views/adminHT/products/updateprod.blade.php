@extends ('adminHT/layout')
@section ('content')
<div class="container-fluid px-4">
    <ol class="breadcrumb mb-4">
        <h1 class="breadcrumb-item active">Update product</h1>
    </ol>

    <form action="{{route('ht.productsupdate',$load->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="name"
                    value="{{old('name',isset($load ->name)?$load ->name:null)}}">
                {!!$errors->first('name','<div class="has-error text-danger">:message</div>')!!}

            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Keyword</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="keyword"
                    value="{{old('keyword',isset($load ->keyword)?$load ->keyword:null)}}">
                {!!$errors->first('keyword','<div class="has-error text-danger">:message</div>')!!}

            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="desc" value="{{old('desc',isset($load ->desc)?$load ->desc:null)}}">
                {!!$errors->first('desc','<div class="has-error text-danger">:message</div>')!!}

            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Image</label>
            <div class="col-sm-5">
                <input type="file" class="form-control"
                    value="{{old('image',isset($load ->image)?$load ->image:null)}}" name="image">
                {!!$errors->first('image','<div class="has-error text-danger">:message</div>')!!}
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Images</label>
            <div class="col-sm-5">
                <input type="file" class="form-control"  multiple="multiple" name="images[]">
                {!!$errors->first('images.*','<div class="has-error text-danger">:message</div>')!!}

            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Price</label>
            <div class="col-sm-5">
                <input type="text" class="form-control"
                    value="{{old('price',isset($load ->price)?$load ->price:null)}}" name="price">
                {!!$errors->first('price','<div class="has-error text-danger">:message</div>')!!}

            </div>
        </div>

        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Category</label>
            <div class="col-sm-5">
                <select class="form-control" name="idcat" id="">
                    @foreach($cate as $value)
                    <option value="{{$value->id}}" <?php  if($value->id==$load->id){echo"selected";} ?>>{{$value->name}}</option>
                    @endforeach

                </select>
                {!!$errors->first('idcat','<div class="has-error text-danger">:message</div>')!!}

            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Content</label>
            <div class="col-sm-5">
                <textarea class="form-control" name="content" id="content" cols="30" rows="10"></textarea>{!!isset($load)? $load->content:null!!}
                <script>   CKEDITOR.replace('content');</script>
               

            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">DateCreate</label>
            <div class="col-sm-5">
                <input type="text" class="form-control"
                    value="{{old('datecreate',isset($load ->datecreate)?$load ->datecreate:null)}}"
                    name="datecreate">
                {!!$errors->first('datecreate','<div class="has-error text-danger">:message</div>')!!}

            </div>
        </div>

        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">DateEdit</label>
            <div class="col-sm-5">
                <input type="text" class="form-control"
                    value="{{old('dateedit',isset($load ->dateedit)?$load ->dateedit:null)}}" name="dateedit">
                {!!$errors->first('dateedit','<div class="has-error text-danger">:message</div>')!!}

            </div>
        </div>
        <div class="mb-3  ">
            <label for="" class="col-sm-2 col-form-label">Status</label>
            <div class="form-check form-check-inline ">
                <input class="form-check-input" type="radio" name="status" <?php if($load-> status==1){echo "checked";}else{echo"";} ?>  value=1>
                <label class="form-check-label">Active</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" <?php if($load-> status==0){echo "checked";}else{echo"";} ?> value=0>
                <label class="form-check-label">Deactivate</label>
            </div>

        </div>

<div class="mb-3 row">
    <label for="inputPassword" class="col-sm-2 col-form-label"></label>
    <div class="col-sm-5 ">
        <button class="btn btn-success" type="submit" href="" role="button">Update</button>
        <a class="btn btn-secondary" href="{{route('ht.products')}}" role="button">Back</a>

    </div>
</div>
</form>
</div>
@endsection