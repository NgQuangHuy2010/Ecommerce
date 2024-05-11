@extends ('interface/layout_interface')
@section('content')

<?php 
$category=App\Models\Categorie::where('status',1)->get();

?>
<div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{route('gd.home')}}"><i class="fa fa-home"></i> Trang chủ</a>
                        <span>Sản phẩm</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="shop__sidebar">
                        <divs class="sidebar__categories">
                            <div class="section-title">
                                <h4>Danh mục sản phẩm</h4>
                            </div>
                            <div class="categories__accordion">
                                <div class="accordion" id="accordionExample">
                                    <div class="card">
                                        <div class="card-heading  ">
                                        <?php foreach ($category as $item) { ?>
                                          <a class="mb-2 hover" href="{{route('gd.product', $item->id)}}" >{{$item->name}}</a>
                                            <?php } ?>
                                        </div>
                                   
                                    </div>
                                
                                  
                                </div>
                            </div>
                        </divs>
                        <!-- <div class="sidebar__filter">
                            <div class="section-title">
                                <h4>Shop by price</h4>
                            </div>
                            <div class="filter-range-wrap">
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                data-min="33" data-max="99"></div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <p>Price:</p>
                                        <input type="text" id="minamount">
                                        <input type="text" id="maxamount">
                                    </div>
                                </div>
                            </div>
                            <a href="#">Filter</a>
                        </div> -->
      

                            <div class="sidebar__categories">
                            <div class="section-title">
                                <h4 class="mt-4">Sắp xếp theo</h4>
                            </div>
                            <div class="categories__accordion">
                                <div class="accordion" id="accordionExample">
                                    <div class="card">
                                        <div class="card-heading  ">
                                        <form action="{{ route('product.sort', ['type' => 'asc']) }}" method="GET">
                                       <button class="mb-2" type="submit"> Giá tăng dần</button>
                                        </form>

                                        <form action="{{ route('product.sort', ['type' => 'desc']) }}" method="GET">
                                        <button type="submit"> Giá giảm dần</button>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- <div class="sidebar__sizes">
                            <div class="section-title">
                                <h4>Shop by size</h4>
                            </div>
                            <div class="size__list">
                                <label for="xxs">
                                    xxs
                                    <input type="checkbox" id="xxs">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="xs">
                                    xs
                                    <input type="checkbox" id="xs">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="xss">
                                    xs-s
                                    <input type="checkbox" id="xss">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="s">
                                    s
                                    <input type="checkbox" id="s">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="m">
                                    m
                                    <input type="checkbox" id="m">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="ml">
                                    m-l
                                    <input type="checkbox" id="ml">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="l">
                                    l
                                    <input type="checkbox" id="l">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="xl">
                                    xl
                                    <input type="checkbox" id="xl">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div> -->
                    
                    </div>
                </div>
                <div class="col-lg-9 col-md-9">
                    <div class="row">
                    <?php foreach ($search as $item) { ?>  
                        <div class="col-lg-4 col-md-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{asset('public/file/')}}/img/img_product/{{$item->image}}">
                                    <div class="label new">New</div>
                                    <ul class="product__hover">
                                      
                                        <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6 ><a class="hover" href="{{route('gd.details', [khongdau($item->name), $item->id])}}">{{$item->name}}</a></h6>
                                    <div class="rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="product__price">{{ number_format($item->price, 0, ',', ',') }} VNĐ/G1</div>


                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="col-lg-12 d-flex justify-content-center">
                            
                            {{ $search->links() }}
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection