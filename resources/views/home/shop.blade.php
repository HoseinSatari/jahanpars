@extends('home.layout.header')


@section('content')
    <script>
        function favourite(product, check , $loop ) {
            event.preventDefault()
            if (!check) {
                window.location = "/login";
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                }
            })

            $.ajax({
                type: 'POST',
                url: '/profile/favourit/' + product,
                data: JSON.stringify('send'),
                success: function () {

                    if ($("#icon-"+$loop).hasClass('fa fa-heart-broken')) {
                        $("#icon-"+$loop).removeClass("fa fa-heart-broken");
                        $("#icon-"+$loop).addClass('fa fa-heart');
                    } else {
                        $("#icon-"+$loop).removeClass("fa fa-heart");
                        $("#icon-"+$loop).addClass('fa fa-heart-broken');
                    }

                }
            })

        }
    </script>
    <section class="page-title">
        <div class="pattern-layer-one" style="background-image: url(/images/background/pattern-16.png)"></div>
        <div class="auto-container">
            <h2>فروشگاه </h2>

        </div>
    </section>
    <!--End Page Title-->

    <!--Sidebar Page Container-->
    <div class="sidebar-page-container">
        <div class="auto-container">
            <div class="row clearfix">

                <!--Content Side-->
                <div class="content-side col-lg-8 col-md-12 col-sm-12">
                    <!--Shop Single-->
                    <div class="shop-section">

                        <!--Sort By-->
                        <div class="items-sorting">
                            <div class="row clearfix">
                                <div class="results-column col-md-6 col-sm-6 col-xs-12">
                                    <h6>نمایش موارد {{$products->currentPage()}}-{{$products->lastPage()}}
                                        از {{$products->count()}} نتیجه</h6>
                                </div>

                            </div>
                        </div>
                        @if($products->count())
                        <div class="our-shops">

                            <div class="row clearfix">

                                @foreach($products as $product)
                                    <div class="single-product-item col-lg-4 col-md-6 col-sm-12 text-center">
                                        <a href="{{route('single' , ['slug' => $product->slug])}}">
                                        <div class="img-holder">
                                            <img   src="{{$product->image}}" style="height: 235px ;width: 300px" class="" alt="">
                                        </div>
                                        </a>
                                        <div class="title-holder text-center">
                                            <div class="static-content">
                                                <h3 class="title text-center"><a
                                                        href="shop-single.html">{{$product->title}}</a></h3>
                                                @if($product->inventory != '0')
                                                <span class="price"><span class="amount"><span class="">تومان </span>{{number_format($product->price)}}</span></span>
                                                @else
                                                    <i class="badge badge-danger">موجود نیست</i>
                                                @endif
                                            </div>
                                            <div class="overlay-content">
                                                <ul class="clearfix">
                                                    <form action="{{route('add.cart' , $product->id)}}" method="post" id="{{$loop->index}}">
                                                        @csrf
                                                    </form>
                                                    @if($product->inventory != '0')
                                                        @if(!\Illuminate\Support\Facades\Auth::check())
                                                    <li>
                                                        <a href="#" onclick="document.getElementById({{$loop->index}}).submit()"><span
                                                                class="flaticon-shopping-cart"></span>
                                                            <div class="toltip-content">
                                                                <p>افزودن به سبد</p>
                                                            </div>
                                                        </a>
                                                    </li>
                                                        @else
                                                            @if(auth()->user()->checkCart($product))

                                                            @else
                                                                <li>
                                                                    <a href="#" onclick="document.getElementById({{$loop->index}}).submit()"><span
                                                                            class="flaticon-shopping-cart"></span>
                                                                        <div class="toltip-content">
                                                                            <p>افزودن به سبد</p>
                                                                        </div>
                                                                    </a>
                                                                </li>
                                                                @endif

                                                            @endif
                                                        @endif
                                                    <li>
                                                        <a href="#" onclick="favourite({{$product->id}} , {{auth()->check()}} , {{$loop->index}})  " class=""><span
                                                              id="icon-{{$loop->index}}"  class="@if(auth()->check()) @if(auth()->user()->favourite()->where('product_id' , $product->id)->first() ) fa fa-heart @else fa fa-heart-broken @endif @else fa fa-heart-broken @endif"></span>
                                                            <div class="toltip-content">
                                                                <p>افزودن به علاقه مندیها</p>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{$product->image}}" class="lightbox-image"
                                                           data-fancybox="shop-gallery"><span
                                                                class="fa fa-expand"></span>
                                                            <div class="toltip-content">
                                                                <p>بزرگنمایی </p>
                                                            </div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach


                            </div>

                        </div>

                        <!-- Post Share Options -->

                        @include('home.paginat', ['paginator' => $products])
                        @else
<div ><h3> متاسفانه محصولی مطابق جستجوی شما یافت نشد ! :(</h3></div>
                            @endif
                    </div>
                </div>

                <!-- Sidebar Side -->
                <div class="sidebar-side left-sidebar col-lg-4 col-md-12 col-sm-12">
                    <aside class="sidebar sticky-top">
                        <div class="sidebar-inner">

                            <!-- Search -->
                            <div class="sidebar-widget search-box">
                                <div class="sidebar-title">
                                    <h5>جستجو : -</h5>
                                </div>
                                <form method="get" action="">
                                    <div class="form-group">
                                        <input type="search" name="q" value="" placeholder="جستجو ... " required>
                                        <button type="submit"><span class="icon fa fa-search"></span></button>
                                    </div>
                                </form>
                            </div>

                            <!-- Categories Widget -->


                            <div class="sidebar-widget categories-widget">
                                <div class="sidebar-title">
                                    <h5>دسته بندی:
                                    </h5>
                                </div>
                                <div class="widget-content">
                                    <ul class="blog-cat">

                                        @foreach(\App\Category::inRandomOrder()->get()->take(10)  as $category)

                                            <li><a href="{{route('store' ,['c' => $category->slug])}}">{{$category->name ?? ''}} <span>( {{$category->products()->count()}} )</span></a></li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>

                            <!-- Categories Widget -->
                            @if(\App\Article::query()->latest()->get()->take(6)->where('is_active' , '1')->count())
                                <div class="sidebar-widget popular-posts">
                                    <div class="sidebar-title">
                                        <h5>پست های اخیر : </h5>
                                    </div>
                                    <div class="widget-content">
                                        @foreach(\App\Article::query()->latest()->get()->take(6)->where('is_active' , '1') as $article)
                                            <article class="post">
                                                <figure class="post-thumb"><img src="{{$article->image}}" alt=""><a href="{{route('single' , $article->slug)}}" class="overlay-box"><span class="icon fa fa-link"></span></a></figure>
                                                <div class="text"><a href="{{route('single' , $article->slug)}}">{{$article->title}}</a></div>
                                                <div class="post-info">{{jdate($article->created_at)->format('%B')}}  {{jdate($article->created_at)->format('y')}}</div>
                                            </article>
                                        @endforeach

                                    </div>
                                </div>
                        @endif

                            <!-- Popular Posts -->


                        </div>
                    </aside>
                </div>

            </div>
        </div>
    </div>


@endsection
