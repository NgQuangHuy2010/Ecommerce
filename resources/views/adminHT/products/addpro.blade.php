@extends ('adminHT/layout')
@section ('content')
<div class="container-fluid px-4 mt-4">
    <ol class="breadcrumb mb-4">
        <h3 class="breadcrumb-item active">Add product</h3>
    </ol>

    <form action="{{route('ht.productsadd')}}" method="post" class="form" enctype="multipart/form-data">
        @csrf
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="name" value="{{old('name')}}">
                {!!$errors->first('name','<div class="has-error text-danger">:message</div>')!!}

            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Keyword</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="keyword" value="{{old('keyword')}}">
                {!!$errors->first('keyword','<div class="has-error text-danger">:message</div>')!!}
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="desc" value="{{old('desc')}}">
                {!!$errors->first('desc','<div class="has-error text-danger">:message</div>')!!}

            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Image</label>
            <div class="col-sm-5">
                <input type="file" class="form-control" name="image">
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
                <input type="text" class="form-control" value="{{old('price')}}" name="price">
                {!!$errors->first('price','<div class="has-error text-danger">:message</div>')!!}

            </div>
        </div>

        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Category</label>
            <div class="col-sm-5">
                <select class="form-control form-select" aria-label="Default select example" name="idcat" id="">
                    @foreach($cate as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                   @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Content</label>
            <div class="col-sm-5">
                <textarea class="form-control" name="content" id="content" cols="30" rows="10"></textarea>
                <script>   CKEDITOR.replace('content');</script>
                {!!$errors->first('datecreate','<div class="has-error text-danger">:message</div>')!!}

            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">DateCreate</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" value="{{old('datecreate')}}" name="datecreate">
                {!!$errors->first('datecreate','<div class="has-error text-danger">:message</div>')!!}

            </div>
        </div>

        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">DateEdit</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" value="{{old('dateedit')}}" name="dateedit">
                {!!$errors->first('dateedit','<div class="has-error text-danger">:message</div>')!!}

            </div>
        </div>
        <div class="mb-3  ">
            <label for="" class="col-sm-2 col-form-label">Status</label>
            <div class="form-check form-check-inline ">
                <input class="form-check-input" type="radio" name="status" checked value=1>
                <label class="form-check-label">Active</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" value=0>
                <label class="form-check-label">Deactivate</label>
            </div>

        </div>


        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-5 ">
                <button class="btn btn-success" type="submit" href="" role="button">Add</button>
                <a class="btn btn-secondary" href="{{route('ht.products')}}" role="button">Back</a>

            </div>
        </div>
    </form>
</div>
@endsection