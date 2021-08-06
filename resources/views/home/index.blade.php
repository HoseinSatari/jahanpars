@extends('home.layout.header')
@section('content')
    <!-- Banner Section -->
    @if(\App\Slider::whereis_active('1')->orderby('order' , 'asc')->count())
        <section class="banner-section">
            <div class="main-slider-carousel owl-carousel owl-theme">
                @foreach(\App\Slider::whereis_active('1')->orderby('order' , 'asc')->get() as $slid)

                    <div class="slide" style="background-image:url('{{$slid->image}}') ; height: 1000px  ">
                        {{--                <div class="patern-layer-one" style="background-image: url(/images/main-slider/pattern-1.png)"></div>--}}
                        {{--                <div class="patern-layer-two" style="background-image: url(images/main-slider/pattern-2.png)"></div>--}}
                        <div class="auto-container">

                            <!-- Content Column -->
                            <div class="content-column">
                                <div class="inner-column">
                                    {{--                            <div class="patern-layer-three" style="background-image: url(images/main-slider/pattern-3.png)"></div>--}}
                                    <div class="title">{{$slid->title}}</div>
                                    <h1> {{$slid->subtitle}} </h1>
                                    <div class="text"> {{$slid->body}}</div>
                                    <div class="btns-box">
                                        @if($slid->button)
                                            <a href="{{$slid->link ?? '#'}}" class="theme-btn btn-style-one"><span
                                                    class="txt">{{$slid->button}}</span></a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach


            </div>

        </section>
    @endif
    <!-- End Banner Section -->

    <!-- About Section -->
    <section class="about-section">
        <div class="auto-container">
            <!-- Sec Title -->
            <div class="sec-title">
                <div class="title">درباره شرکت</div>
                <h2>شما نمی توانید استفاده کنید <br> چون ما انتخاب میکنیم که شما بهترین هستید.</h2>
            </div>
            <div class="row clearfix">

                <!-- Content Column -->
                <div class="content-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="text">آیا هر صنعتی از روند مخاطب و روند فروش بازاریابی پیچیده تری از فناوری B2B
                            برخوردار است؟ تعداد افرادی که بر فروش تأثیر می گذارند ، طول چرخه تصمیم گیری ، منافع رقابتی
                            افرادی که این فناوری را خریداری ، اجرا ، مدیریت و استفاده می کنند ، در نظر بگیرید. در اینجا
                            محتوای بسیار معنی داری است.
                        </div>
                        <div class="blocks-outer">

                            <!-- Feature Block -->
                            <div class="feature-block">
                                <div class="inner-box">
                                    <div class="icon flaticon-award-1"></div>
                                    <h6>تجربه </h6>
                                    <div class="feature-text">تیم عالی ما متشکل از بیش از 1400 متخصص نرم افزار است.
                                    </div>
                                </div>
                            </div>

                            <!-- Feature Block -->
                            <div class="feature-block">
                                <div class="inner-box">
                                    <div class="icon flaticon-technical-support"></div>
                                    <h6>پشتیبانی سریع </h6>
                                    <div class="feature-text">ما به شما کمک می کنیم ضمن به اشتراک گذاشتن ایده های
                                        جسورانه ، ایده های جدید پررنگ خود را ارسال کنید.
                                    </div>
                                </div>
                            </div>

                        </div>

                        <a href="#" class="lightbox-image theme-btn btn-style-one"><span class="txt"><i
                                    class="play-icon"><img src="images/icons/play-icon.png" alt=""/></i>&ensp; نمایش ویدئو </span></a>

                    </div>
                </div>

                <!-- Images Column -->
                <div class="images-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column" style="background-image: url(images/icons/globe.png)">
                        <div class="pattern-layer" style="background-image: url(images/background/pattern-1.png)"></div>
                        <div class="images-outer parallax-scene-1">
                            <div class="image" data-depth="0.10">
                                <img src="images/resource/about-1.jpg" alt=""/>
                            </div>
                            <div class="image-two" data-depth="0.30">
                                <img src="images/resource/about-2.jpg" alt=""/>
                            </div>
                            <div class="image-three" data-depth="0.20">
                                <img src="images/resource/about-3.jpg" alt=""/>
                            </div>
                            <div class="image-four" data-depth="0.30">
                                <img src="images/resource/about-4.jpg" alt=""/>
                            </div>
                        </div>
                    </div>
                    <a href="about.html" class="learn"><span
                            class="arrow flaticon-long-arrow-pointing-to-the-right"></span>مطالعه بیشتر درباره شرکت</a>
                </div>

            </div>
        </div>
    </section>
    @if(\App\Company::where('is_active' , '1')->count())
        <section class="services-page-section">
            <div class="auto-container">
                <div class="row clearfix">

                    <!-- News Block Three -->
                    @foreach(\App\Company::query()->latest()->get()->take(3) as $company)
                        <div class="news-block-three col-lg-4 col-md-6 col-sm-12">
                            <div class="inner-box">
                                <div class="image">
                                    <a href="{{route('single.company' , $company->id)}}"><img src="{{$company->image}}" style="height: 200px" alt="{{$company->title}}" /></a>
                                </div>
                                <div class="lower-content">

                                    <h4 ><a style="color: #0a2aa6" href="{{route('single.company' , $company->id)}}">{{$company->title}}</a></h4>
                                    <div class="text">{{$company->short_text}}</div>
                                    <a style="color: blue" class="read-more" href="{{route('single.company' , $company->id)}}"> بیشتر بدانید <span class="arrow flaticon-long-arrow-pointing-to-the-right"></span></a>

                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <a href="{{route('companys')}}" class="theme-btn btn-style-one">دیدن همه شرکت ها</a>
            </div>
        </section>
    @endif

    @if(\App\Partner::count())
        <section class="team-section" style="background-image: url(images/background/2.jpg)">
            <div class="auto-container">
                <!-- Sec Title -->
                <div class="sec-title">
                    <div class="clearfix">
                        <div class="pull-left">
                            <div class="title">تیم اختصاصی ما</div>
                        </div>
                        <div class="pull-right">
                            <div class="text"></div>
                        </div>
                    </div>
                </div>
                <div class="clearfix">

                    <!-- Team Block -->
                    @foreach(\App\Partner::inRandomOrder()->get()->take(4) as $parter)
                        <div class="team-block col-lg-3 col-md-6 col-sm-12">
                            <div class="inner-box">
                                <div class="image">
                                    <a href="{{route('team')}}"><img src="{{$parter->image}}"
                                                                     style="width: 300px ; height: 400px"
                                                                     alt="{{$parter->name}}"/></a>
                                </div>
                                <div class="lower-box">

                                    <div class="content">
                                        <h5 style="text-align: right"><a href="{{route('team')}}"> {{$parter->name}}</a>
                                        </h5>
                                        <div style="text-align: right" class="designation">{{$parter->jobe}} </div>
                                        <div style="text-align: right" class="designation">{{$parter->phone}} </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <a href="{{route('team')}}" class="theme-btn btn-style-one">دیدن همه تیم</a>

                </div>
            </div>
        </section>
    @endif
    <!-- End Team Section -->

    <!-- News Section -->
    @if(\App\Article::where('is_active' , '1')->count())
        <section class="news-section">
            <div class="auto-container">
                <!-- Sec Title -->
                <div class="sec-title centered">
                    <div class="title">وبلاگ ما</div>
                    <h2>  اخرین مقالات </h2>
                </div>
                <div class="row clearfix">

                    <!-- News Block -->
                    @foreach(\App\Article::query()->latest()->get()->take(3) as $article)
                        <div class="news-block col-lg-4 col-md-6 col-sm-12">
                            <div class="inner-box">
                                <div class="image">
                                    <a href="{{route('single.article' , $article->slug)}}"><img src="{{$article->image}}" style="width: 375px;height: 400px" alt="{{$article->title}}"/></a>
                                </div>
                                <div class="lower-content">
                                    <div class="post-date">22 <span>خرداد </span></div>
                                    <ul class="post-meta">
                                        <li><span class="icon flaticon-comment"></span>تعداد {{$article->comments()->count()}} نظر</li>
                                        <li><span class="icon flaticon-user"></span>{{$article->user->name}}</li>
                                    </ul>
                                    <h4><a href="{{route('single.article' , $article->slug)}}">{{$article->title}}</a></h4>
                                    <div class="text">{{$article->short_text}} ...
                                    </div>
                                    <a class="read-more" href="{{route('single.article' , $article->slug)}}">ادامه مطلب <span
                                            class="arrow flaticon-long-arrow-pointing-to-the-right"></span></a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <a href="{{route('articles')}}" class="theme-btn btn-style-one">دیدن همه مقالات</a>
            </div>
        </section>
    @endif
    <!-- End News Section -->

    <!-- Main Footer -->



    </div>
    <!--End pagewrapper-->

    <!-- Color Palate / Color Switcher -->


@endsection
