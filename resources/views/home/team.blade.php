@extends('home.layout.header')

@section('content')

    <section class="page-title">
        <div class="pattern-layer-one" style="background-image: url(/images/background/pattern-16.png)"></div>
        <div class="auto-container">
            <h2>تیم ما</h2>
        </div>
    </section>
    <!--End Page Title-->

    <!-- Team Page Section -->
    <section class="team-page-section">
        <div class="auto-container">
            <div class="row clearfix">

                <!-- Team Block -->
                @foreach(\App\Partner::all() as $partner)
                <div class="team-block col-lg-3 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <div class="image">
                            <a href="" onclick="event.preventDefault()" ><img src="{{$partner->image}}" style="width: 300px;height: 400px" alt="{{$partner->name}}" /></a>
                        </div>
                        <div class="lower-box">
                            <div class="content">
                                <h5 style="text-align: right"><a href="" onclick="event.preventDefault()">{{$partner->name}} </a></h5>
                                <div style="text-align: right" class="designation">{{$partner->jobe}} </div>
                                <div style="text-align: right" class="designation">{{$partner->phone}} </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach



            </div>
        </div>
    </section>


@endsection
