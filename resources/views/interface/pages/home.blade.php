@extends ('interface/layout_interface')
@section('content')
<?php 
//$category=App\Models\Categorie::where('status',1)->get();
?>
<!-- Banner Section Begin -->
<!-- Thêm các thuộc tính của thư viện wow.js -->


<section style="">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            @foreach ($banner as $index => $bannerr)
                <div class="carousel-item active">
                    <img class="d-block w-100 banner"
                        src="{{ asset('public/file/img/img_banner/' . $bannerr->image_first) }}" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 banner"
                        src="{{ asset('public/file/img/img_banner/' . $bannerr->image_second) }}" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 banner"
                        src="{{ asset('public/file/img/img_banner/' . $bannerr->image_third) }}" alt="Third slide">
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>

<!-- Banner Section End -->

<!-- Services Section Begin -->
<section class="services spad bg-light">
    <div class="container ">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-car"></i>
                    <h6>Free Shipping</h6>
                    <p>For all oder over $99</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-money"></i>
                    <h6>Money Back Guarantee</h6>
                    <p>If good have Problems</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-support"></i>
                    <h6>Online Support 24/7</h6>
                    <p>Dedicated support</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-headphones"></i>
                    <h6>Payment Secure</h6>
                    <p>100% secure payment</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Services Section End -->
<!-- Categories Section Begin -->
<section class="product spad  bg-light">
    <div class="container ">
        @foreach($category as $item)
            <div class="row ">
                <div class="col-lg-4 col-md-4 ">
                    <div class="section-title">
                        <h4 class="wow fadeInLeft" data-wow-delay="0.5s">{{$item->name}}</h4>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8">
                    <ul class="filter__controls">
                        <a href="{{route('gd.product', $item->id)}}">
                            <li class="active wow fadeInLeft " data-wow-delay="0.5s" data-filter="*">Tất cả</li>
                        </a>
                    </ul>
                </div>
            </div>
            <div class="row property__gallery ">
                @foreach($item->products as $product)
                <div class="col-lg-2 col-md-4 col-sm-6 mb-5 mix women wow fadeInRight bg-white mr-3 rounded-lg cart-product" data-wow-delay="0.5s">
    <div class="product__item">
        <div class="product__item__pic set-bg" data-setbg="{{asset('public/file/')}}/img/img_product/{{$product->image}}">
            <!-- <div class="label new">New</div> -->
            <ul class="product__hover"></ul>
        </div>
        <div class="product__item__text">
            <h6 class="mb-3">
                <a href="{{route('gd.details', [khongdau($product->name), $product->id])}}">{{$product->name}}</a>
            </h6>
            <div class="rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
            </div>
            <div class="product__price">{{ number_format($product->price, 0, ',', ',') }} VNĐ/G1</div>
        </div>
        <div class="text-center mt-3 border border-success rounded-lg btn-hover-cart">
        <button onclick="momodal()" data-product-id="{{$product->id}}" class="add-to-cart-btn btn btn-sm text-danger">
    <span class="fa fa-cart-plus" style="color:red;"></span> Thêm vào giỏ
</button>


        </div>
    </div>
</div>

                @endforeach
            </div>
        @endforeach
    </div>
</section>


<!-- Categories Section End -->




<!-- Trend Section Begin -->
<section class="trend spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 row ">
                <div class="trend__content">
                    <div class="section-title">
                        <h4>Hot Trend</h4>
                    </div>
                    <div class="trend__item">
                        <div class="trend__item__pic">
                            <img src="img/trend/ht-1.jpg" alt="">
                        </div>
                        <div class="trend__item__text">
                            <h6>Chain bucket bag</h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">$ 59.0</div>
                        </div>
                    </div>
                    <div class="trend__item">
                        <div class="trend__item__pic">
                            <img src="img/trend/ht-2.jpg" alt="">
                        </div>
                        <div class="trend__item__text">
                            <h6>Pendant earrings</h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">$ 59.0</div>
                        </div>
                    </div>
                    <div class="trend__item">
                        <div class="trend__item__pic">
                            <img src="img/trend/ht-3.jpg" alt="">
                        </div>
                        <div class="trend__item__text">
                            <h6>Cotton T-Shirt</h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">$ 59.0</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="trend__content">
                    <div class="section-title">
                        <h4>Best seller</h4>
                    </div>
                    <div class="trend__item">
                        <div class="trend__item__pic">
                            <img src="img/trend/bs-1.jpg" alt="">
                        </div>
                        <div class="trend__item__text">
                            <h6>Cotton T-Shirt</h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">$ 59.0</div>
                        </div>
                    </div>
                    <div class="trend__item">
                        <div class="trend__item__pic">
                            <img src="img/trend/bs-2.jpg" alt="">
                        </div>
                        <div class="trend__item__text">
                            <h6>Zip-pockets pebbled tote <br />briefcase</h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">$ 59.0</div>
                        </div>
                    </div>
                    <div class="trend__item">
                        <div class="trend__item__pic">
                            <img src="img/trend/bs-3.jpg" alt="">
                        </div>
                        <div class="trend__item__text">
                            <h6>Round leather bag</h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">$ 59.0</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="trend__content">
                    <div class="section-title">
                        <h4>Feature</h4>
                    </div>
                    <div class="trend__item">
                        <div class="trend__item__pic">
                            <img src="img/trend/f-1.jpg" alt="">
                        </div>
                        <div class="trend__item__text">
                            <h6>Bow wrap skirt</h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">$ 59.0</div>
                        </div>
                    </div>
                    <div class="trend__item">
                        <div class="trend__item__pic">
                            <img src="img/trend/f-2.jpg" alt="">
                        </div>
                        <div class="trend__item__text">
                            <h6>Metallic earrings</h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">$ 59.0</div>
                        </div>
                    </div>
                    <div class="trend__item">
                        <div class="trend__item__pic">
                            <img src="img/trend/f-3.jpg" alt="">
                        </div>
                        <div class="trend__item__text">
                            <h6>Flap cross-body bag</h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">$ 59.0</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Trend Section End -->


<div class="nenmodal" id="nenmodal-1">
    <div class="nenmodal2"></div>
    <div class="ndmodal">
        <div class="closemodal">
            <button onclick="closeModal()">×</button>
        </div>
        <div class="titlemodal">Thông báo</div>
        <div class="modal-content" id="modal-content">
            <!-- Nội dung thông báo sẽ được thay thế bằng Ajax -->
        </div>
    </div>
</div>


<script>
$(document).ready(function () {
    $('.add-to-cart-btn').click(function () {
        var productId = $(this).data('product-id'); // Lấy ID sản phẩm từ thuộc tính dữ liệu
        $.ajax({
            url: "{{route('gd.addcart')}}",
            type: 'post',
            data: {
                'id': productId,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function (message) {
                var modalContent = $('#modal-content');
                if (message) {
                    modalContent.html("<p>Thêm vào giỏ hàng thành công!</p>");
                } else {
                    modalContent.html("<p>Thêm giỏ hàng thất bại!</p>");
                }
                momodal(); // Hiển thị modal
                // Đóng modal sau 2 giây
                setTimeout(function() {
                    closeModal();
                }, 2000);
            }
        });
    });

    function momodal() {
        document.getElementById("nenmodal-1").classList.toggle("active");
    }

    function closeModal() {
        var modal = document.getElementById("nenmodal-1");
        modal.classList.remove("active"); // Loại bỏ class 'active' để ẩn modal
        location.reload();
    }

    // Sự kiện nhấp vào nút "Đóng" trong modal
    $('.closemodal button').click(function() {
        closeModal();
        location.reload();
    });
});



</script>


@endsection