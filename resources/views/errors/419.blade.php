@extends('home.layout.header')
@section('title')
    <title>درخواست نامعتبر</title>
@endsection
@section('content')
    <section class="page-title">
        <div class="pattern-layer-one" style="background-image: url(images/background/pattern-16.png)"></div>
        <div class="auto-container">
            <h2>درخواست نامعتبر</h2>

        </div>
    </section>
    <!--End Page Title-->

    <!--Error Section-->
    <section class="error-section">
        <div class="auto-container">
            <div class="content">
                <h1>419</h1>
                <div class="text">متأسفیم ، اما درخواست شما نامعتبر است</div>
                <a href="{{route('home')}}" class="theme-btn btn-style-three"><span class="txt">برو صفحه اصلی</span></a>
            </div>
        </div>
    </section>
    <!--End Error Section-->

@endsection
