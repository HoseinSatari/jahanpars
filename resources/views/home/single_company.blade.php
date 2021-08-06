@extends('home.layout.header')


@section('content')
    <section class="page-title">
        <div class="pattern-layer-one" style="background-image: url(images/background/pattern-16.png)"></div>
        <div class="auto-container">
            <h2>{{$company->title}} </h2>

        </div>
    </section>
    <!--End Page Title-->

    <!--Sidebar Page Container-->
    <div class="sidebar-page-container">
        <div class="auto-container">
            <div class="row clearfix">



                <!-- Content Side -->
                <div class="content-side right-sidebar col-lg-8 col-md-12 col-sm-12">
                    <div class="services-detail">
                        <div class="inner-box">
                            <h2>{{$company->title}}</h2>
                            <div class="image">
                                <img src="{{$company->image}}" style="width: 600px ;height: 500px" alt="{{$company->title}}" />
                            </div>
                            {!! $company->text !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
