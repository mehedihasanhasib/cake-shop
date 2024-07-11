<!-- Offcanvas Menu Begin -->
<div class="offcanvas-menu-overlay"></div>
<div class="offcanvas-menu-wrapper">
    <div class="offcanvas__cart">
        {{-- <div class="offcanvas__cart__links">
         <a href="{{ asset('users/#') }}" class="search-switch"><img src="{{ asset('users/img/icon/search.png') }}"
                 alt=""></a>
         <a href="{{ asset('users/#') }}"><img src="{{ asset('users/img/icon/heart.png') }}" alt=""></a>
     </div> --}}
        <div class="offcanvas__cart__item">
            <a href="{{ route('cart') }}"><img src="{{ asset('users/img/icon/cart.png') }}" alt="">
                <span>0</span></a>
            <div class="cart__price">Cart: <span> &#2547; 0.00</span></div>
        </div>
    </div>
    <div class="offcanvas__logo">
        <a href="{{ route('home.index') }}"><img src="{{ asset('users/img/logo.png') }}" alt=""></a>
    </div>
    <div id="mobile-menu-wrap"></div>
    <div class="offcanvas__option">
        <ul>
            <li>
                <a href="{{ route('login') }}">Sign in</a>
            </li>
            <li>
                <a href="{{ route('register') }}">Sign up</a>
            </li>
        </ul>
    </div>
</div>
<!-- Offcanvas Menu End -->
<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header__top__inner">
                        <div class="header__top__left">
                            <ul>
                                <li>
                                    <a href="{{ route('login') }}">Sign in</a>
                                </li>
                                <li>
                                    <a href="{{ route('register') }}">Sign Up</a>
                                </li>
                            </ul>
                        </div>
                        <div class="header__logo">
                            <a href="{{ route('home.index') }}"><img src="{{ asset('users/img/logo.png') }}"
                                    alt=""></a>
                        </div>
                        <div class="header__top__right">
                            {{-- <div class="header__top__right__links">
                             <a href="{{ asset('users/#') }}" class="search-switch"><img
                                     src="{{ asset('users/img/icon/search.png') }}" alt=""></a>
                             <a href="{{ asset('users/#') }}"><img src="{{ asset('users/img/icon/heart.png') }}"
                                     alt=""></a>
                         </div> --}}
                            <div class="header__top__right__cart">
                                <a href=""><img src="{{ asset('users/img/icon/cart.png') }}" alt="">
                                    <span>0</span></a>
                                <div class="cart__price">Cart: <span> &#2547; 0.00</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav class="header__menu mobile-menu">
                    <ul>
                        <li class={{ Route::is('home.index') ? 'active' : null }}><a href="{{ route('home.index') }}">Home</a></li>
                        <li class={{ Route::is('shop') || Route::is('shop.search_by_category') ? 'active' : null }}><a href="{{ route('shop') }}">Shop</a></li>
                        <li class={{ Route::is('cart') ? 'active' : null }}><a href="{{ route('cart') }}">Cart</a></li>
                        <li class={{ Route::is('contact') ? 'active' : null }}><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- Header Section End -->
