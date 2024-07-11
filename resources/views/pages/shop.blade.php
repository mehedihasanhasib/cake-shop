@extends('layouts.app' , ['title'=>'Shop'])
@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__text">
                        <h2>Shop</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__links">
                        <a href="{{ route('home.index') }}">Home</a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            
            @include('components.filter_shop', ['variants' => $variants])

            <div class="row">
                @foreach ($cakes as $key => $cake)
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="product__item">
                            <a href="{{ route('shop.details', ['id' => 1]) }}">
                                {{-- this image div is little bit diffrent --}}
                                <div class="product__item__pic set-bg" data-setbg="{{ asset($cake->images->first()->path) }}">
                            </a>
                                <div class="product__label">
                                    <span>{{ $cake->cake_variant->variant_name }}</span>
                                </div>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="{{ route('shop.details', ['id' => 1]) }}">{{ $cake->name }}</a></h6>
                                <div class="product__item__price">&#2547; {{ $cake->price }}</div>
                                <div class="cart_add">
                                    <a href="#">Add to cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- <div class="shop__last__option">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="shop__pagination">
                            {{ $cakes->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="shop__last__text">
                            <p>Showing 1-9 of 10 results</p>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{ $cakes->links('vendor.pagination.shop-pagination') }}
        </div>
    </section>
    <!-- Shop Section End -->
@endsection

{{-- @section('script')
    <script src="{{ URL::asset('admin/assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script>
        $(document).on('click', '.nice-select .list .option', function(event) {
            const slug = $(this).data('value');
            const searchForm = $('#search-form')
            const route = `/shop/${slug}`;
            searchForm.attr('action', route)
            searchForm.submit();
        });
    </script>
@endsection --}}
