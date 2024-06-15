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
            <a href="{{ asset('users/#') }}"><img src="{{ asset('users/img/icon/cart.png') }}" alt="">
                <span>0</span></a>
            <div class="cart__price">Cart: <span>$0.00</span></div>
        </div>
    </div>
    <div class="offcanvas__logo">
        <a href="{{ asset('users/index.html') }}"><img src="{{ asset('users/img/logo.png') }}" alt=""></a>
    </div>
    <div id="mobile-menu-wrap"></div>
    <div class="offcanvas__option">
        <ul>
            <li>
                <a href="">Sign in</a>
            </li>
            <li>
                <a href="">Sign in</a>
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
                                    <a href="#">Sign in</a>
                                </li>
                                <li>
                                    <a href="#">Sign Up</a>
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
                                <div class="cart__price">Cart: <span>$0.00</span></div>
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
                        <li class={{ Route::is('home.index') ? 'active' : null }}><a
                                href="{{ route('home.index') }}">Home</a></li>
                        <li class={{ Route::is('cake.index') ? 'active' : null }}><a
                                href="{{ route('cake.index') }}">Shop</a></li>
                        <li><a href="{{ asset('users/about.html') }}">About</a></li>
                        <li><a href="{{ asset('users/contact.html') }}">Contact</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- Header Section End -->
