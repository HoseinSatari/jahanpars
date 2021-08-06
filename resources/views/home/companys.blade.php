@extends('home.layout.header')



@section('content')
    <section class="page-title">
        <div class="pattern-layer-one" style="background-image: url(/images/background/pattern-16.png)"></div>
        <div class="auto-container">
            <h2>شرکت های طرف قرارداد </h2>

        </div>
    </section>
    <!--End Page Title-->

    <!-- Services Page Section -->
    @if(\App\Company::where('is_active' , '1')->count())
    <section class="services-page-section">
        <div class="auto-container">
            <div class="row clearfix">

                <!-- News Block Three -->
                @foreach(\App\Company::all()->where('is_active' , '1') as $company)
                <div class="news-block-three col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <div class="image">
                            <a href="{{route('single.company' , $company->id)}}"><img src="{{$company->image}}" style="height:350px" alt="{{$company->title}}" /></a>
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
        </div>
    </section>

    @else
    <h3 style="text-align: center" class="m-5">در حال حاظر شرکتی ثبت نشده است.</h3>
    @endif

@endsection
