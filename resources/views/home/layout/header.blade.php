<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name=”keywords” content=”{{option()->keyword}}” >
    <!-- Stylesheets -->
    <link href="/home/css/bootstrap.css" rel="stylesheet">
    <link href="/home/css/style.css" rel="stylesheet">
    <link href="/home/css/responsive.css" rel="stylesheet">
    @yield('title')
    <link href="/home/css/select2.min.css" rel="stylesheet"/>
    <!-- Color Switcher Mockup -->
    <link href="/home/css/color-switcher-design.css" rel="stylesheet">
{!! SEO::generate(true) !!}
<!-- Color Themes -->
    <link id="theme-color-file" href="/home/css/color-themes/default-theme.css" rel="stylesheet">
    <link rel="stylesheet" href="/awesom/css/all.min.css">


    <link href="{{option()->image}}" rel="shortcut icon"/>
    <link rel="icon" href="{{option()->image}}" type="image/x-icon">
    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @toastr_css
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
    <!--[if lt IE 9]>
    <script src="/home/js/respond.js"></script><![endif]-->
</head>
<body class="hidden-bar-wrapper">

<div class="page-wrapper">

    <!-- Preloader -->
    <div class="preloader"></div>

    <!-- Main Header-->
    <header class="main-header header-style-one">

        <!-- Header Top -->
        <div class="header-top">
            <div class="auto-container">
                <div class="clearfix">
                    <!-- Top Left -->
                    <div class="top-left">
                        <!-- Info List -->
                        <ul class="info-list">
                            <li><a href="mailto:{{option()->email}}"><span class="icon flaticon-email"></span>
                                    {{option()->email}}</a></li>
                            <li><a href="tel:{{option()->phone}}"><span class="icon flaticon-telephone"></span> {{option()->phone}}

                                </a></li>
                        </ul>
                    </div>

                    <!-- Top Right -->
                    <div class="top-right pull-right">
                        <!-- Social Box -->
                        <ul class="social-box">
                            <li><a href="{{option()->whatsup}}" style="font-family: 'Font Awesome 5 Brands'" class="fa fa-whatsapp"></a></li>
                            <li><a href="{{option()->instagram}}" style="font-family: 'Font Awesome 5 Brands'" class="fa fa-instagram"></a></li>
                            <li><a href="{{option()->telegram}}" style="font-family: 'Font Awesome 5 Brands'" class="fa fa-telegram"></a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>

        <!--Header-Upper-->
        <div class="header-upper">
            <div class="auto-container clearfix">

                <div class="pull-left logo-box">
                    <div class="logo"><a href="{{route('home')}}"><img class="rounded-circle" src="{{option()->image}}" style="height: 50px;width: 50px"
                                                                alt="{{option()->sitename}}" title="{{option()->sitename}}"></a></div>
                </div>

                <div class="nav-outer clearfix">
                    <!--Mobile Navigation Toggler-->
                    <div class="mobile-nav-toggler"><span class="icon flaticon-menu"></span></div>
                    <!-- Main Menu -->
                    <nav class="main-menu navbar-expand-md">
                        <div class="navbar-header">
                            <!-- Toggle Button -->
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                    aria-expanded="false" aria-label="تغییر ناوبری ">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>

                        <div class="navbar-collapse collapse clearfix" id="navbarSupportedContent">
                            <ul class="navigation clearfix">
                                <li class="{{request()->url() == route('home') ? 'current' : '' }}"><a
                                        href="{{route('home')}}"> صفحه اصلی  </a></li>
                                <li class="{{request()->url() == route('store') ? 'current' : '' }} dropdown"><a
                                        href="#">فروشگاه </a>
                                    <ul>
                                        @foreach(\App\Category::all()->where('parent' , 0)->where('is_active' , 1)->sortBy('view_order') as $father)
                                            <li @if($father->child()->count())class="dropdown" @endif><a
                                                    href="{{route('store' , ['c' => $father->slug])}}">{{$father->name}} </a>
                                                @if($father->child()->count())
                                                    <ul>
                                                        @foreach($father->child()->get()->where('is_active', 1)->sortBy('view_order') as $child)
                                                            <li>
                                                                <a href="{{route('store' ,  ['c' => $child->slug])}}">{{$child->name}}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>

                                </li>
                                <li class="{{request()->url() == route('articles') ? 'current' : '' }} dropdown"><a
                                        href="#">مقالات </a>
                                    <ul>
                                        @foreach(\App\CategoryArticle::all()->where('parent' , 0)->where('is_active' , 1)->sortBy('view_order') as $father)
                                            <li @if($father->child()->count())class="dropdown" @endif><a
                                                    href="{{route('articles' , ['c' => $father->slug])}}">{{$father->name}} </a>
                                                @if($father->child()->count())
                                                    <ul>
                                                        @foreach($father->child()->get()->where('is_active', 1)->sortBy('view_order') as $child)
                                                            <li>
                                                                <a href="{{route('articles' ,  ['c' => $child->slug])}}">{{$child->name}}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>

                                </li>
                                <li class="{{request()->url() == route('about') ? 'current' : '' }}"><a
                                        href="{{route('about')}}"> درباره ما </a></li>
                                <li class="{{request()->url() == route('contact.show') ? 'current' : '' }}"><a
                                        href="{{route('contact.show')}}">تماس با ما </a></li>
                                <li class="{{request()->url() == route('team') ? 'current' : '' }}"><a
                                        href="{{route('team')}}"> تیم ما  </a></li>
                                <li class="{{request()->url() == route('companys') ? 'current' : '' }}"><a
                                        href="{{route('companys')}}">  شرکت ها  </a></li>
                                @if(auth()->check())
                                    @if(auth()->user()->is_staff or auth()->user()->is_superuser)
                                        <li class="{{request()->url() == route('admin.panel') ? 'current' : '' }}"><a
                                                href="{{route('admin.panel')}}"> پنل مدیریت </a></li>
                                    @else
                                        <li class="{{request()->url() == route('profile') ? 'current' : '' }}"><a
                                                href="{{route('profile')}}"> پنل کاربری </a></li>
                                    @endif
                                @else
                                    <li class="{{request()->url() == route('login') ? 'current' : '' }}"><a
                                            href="{{route('login')}}"> ورود | ثبت نام </a></li>
                                @endif
                            </ul>
                        </div>
                    </nav>

                    <!-- Main Menu End-->

                    <div class="outer-box clearfix">

                        <!-- Cart Box -->
                        @if(\Illuminate\Support\Facades\Auth::check())
                        @if(auth()->user()->cart->count())
                            <div class="cart-box">
                                <div class="dropdown">
                                    <button class="cart-box-btn dropdown-toggle" type="button" id="dropdownMenu1"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span
                                            class="flaticon-shopping-bag-1"></span><span
                                            class="total-cart">{{auth()->user()->cart->count()}}</span>
                                    </button>
                                    <div class="dropdown-menu pull-right cart-panel" aria-labelledby="dropdownMenu1">

                                        @foreach(auth()->user()->cart as $item)
                                            @php $product = \App\Product::where('id' , $item['product_id'])->first();   @endphp
                                            <div class="cart-product">
                                                <div class="inner">
                                                    <a href="#" class="cross-icon"
                                                       onclick='document.getElementById("delet{{$loop->index}}").submit()'><span
                                                            class="icon fa fa-remove"></span></a>
                                                    <form action="{{route('cartdelete' , $item->id)}}" method="post"
                                                          id="delet{{$loop->index}}">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                    <div class="image"><img src="{{$product->image}}"
                                                                            alt="{{$product->title}}"/>
                                                    </div>
                                                    <h3><a href="shop-single.html">{{$product->title}} </a></h3>
                                                    <div class="quantity-text"> تعداد {{$item->qty}}</div>
                                                    <div class="price">{{number_format($product->price * $item->qty)}} تومان</div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="cart-total">جمع کل: <span>{{number_format(auth()->user()->total())}} تومان</span>
                                        </div>
                                        <ul class="btns-boxed">
                                            <li><a href="{{route('cart')}}">نمایش سبد </a></li>
                                        </ul>

                                    </div>

                                </div>
                            </div>
                    @endif
                        @endif

                    <!-- Search Btn -->
                        <div class="search-box-btn search-box-outer"><span class="icon fa fa-search"></span></div>
                    </div>

                </div>

            </div>
        </div>
        <!--End Header Upper-->

        <!-- Sticky Header  -->
        <div class="sticky-header">
            <div class="auto-container clearfix">
                <!--Logo-->
                <div class="logo pull-left">
                    <a href="{{route('home')}}" title="{{option()->title}}"><img class="rounded-circle" src="{{option()->image}}" alt="{{option()->title}}" title="{{option()->title}}" style="height: 75px;width: 50px"></a>
                </div>
                <!--Right Col-->
                <div class="pull-right">
                    <!-- Main Menu -->
                    <nav class="main-menu">
                        <!--Keep This Empty / Menu will come through Javascript-->
                    </nav><!-- Main Menu End-->

                    <!-- Main Menu End-->
                    <div class="outer-box clearfix">

                        <!-- Cart Box -->
                        @if(\Illuminate\Support\Facades\Auth::check())
                            @if(auth()->user()->cart->count())
                                <div class="cart-box">
                                    <div class="dropdown">
                                        <button class="cart-box-btn dropdown-toggle" type="button" id="dropdownMenu1"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span
                                                class="flaticon-shopping-bag-1"></span><span
                                                class="total-cart">{{auth()->user()->cart->count()}}</span>
                                        </button>
                                        <div class="dropdown-menu pull-right cart-panel" aria-labelledby="dropdownMenu1">

                                            @foreach(auth()->user()->cart as $item)
                                                @php $product = \App\Product::where('id' , $item['product_id'])->first();   @endphp
                                                <div class="cart-product">
                                                    <div class="inner">
                                                        <a href="#" class="cross-icon"
                                                           onclick='document.getElementById("delet{{$loop->index}}").submit()'><span
                                                                class="icon fa fa-remove"></span></a>
                                                        <form action="{{route('cartdelete' , $item->id)}}" method="post"
                                                              id="delet{{$loop->index}}">
                                                            @csrf
                                                            @method('delete')
                                                        </form>
                                                        <div class="image"><img src="{{$product->image}}"
                                                                                alt="{{$product->title}}"/>
                                                        </div>
                                                        <h3><a href="shop-single.html">{{$product->title}} </a></h3>
                                                        <div class="quantity-text"> تعداد {{$item->qty}}</div>
                                                        <div class="price">{{number_format($product->price * $item->qty)}} تومان</div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="cart-total">جمع کل: <span>{{number_format(auth()->user()->total())}} تومان</span>
                                            </div>
                                            <ul class="btns-boxed">
                                                <li><a href="{{route('cart')}}">نمایش سبد </a></li>
                                            </ul>

                                        </div>

                                    </div>
                                </div>
                        @endif
                    @endif

                        <!-- Search Btn -->
                        <div class="search-box-btn search-box-outer"><span class="icon fa fa-search"></span></div>

                        <!-- Nav Btn -->


                    </div>

                </div>
            </div>
        </div><!-- End Sticky Menu -->

        <!-- Mobile Menu  -->
        <div class="mobile-menu">
            <div class="menu-backdrop"></div>
            <div class="close-btn"><span class="icon flaticon-multiply"></span></div>

            <nav class="menu-box">
                <div class="nav-logo"><a href="{{route('home')}}"><img class="rounded-circle" src="{{option()->image}}" alt="{{option()->title}}" title="{{option()->title}}" style="height: 75px;width: 50px"></a></div>
                <div class="menu-outer">
                    <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
            </nav>
        </div><!-- End Mobile Menu -->

    </header>
    <!-- End Main Header -->

@yield('content')


@include('home.layout.footer')
