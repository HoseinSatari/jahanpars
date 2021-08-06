@extends('home.layout.header')
@section('title')
    <title>404</title>
@endsection
@section('content')
    <section class="page-title">
        <div class="pattern-layer-one" style="background-image: url(images/background/pattern-16.png)"></div>
        <div class="auto-container">
            <h2>صفحه مورد نظر پیدا نشد</h2>
            <ul class="page-breadcrumb">
                <li><a href="index.html">صفحه اصلی </a></li>
                <li>404 </li>
            </ul>
        </div>
    </section>
    <!--End Page Title-->

    <!--Error Section-->
    <section class="error-section">
        <div class="auto-container">
            <div class="content">
                <h1>404</h1>
                <h2>اوه! آن صفحه یافت نمی شود</h2>
                <div class="text">متأسفیم ، اما صفحه مورد نظر شما موجود نیست</div>
                <a href="{{route('home')}}" class="theme-btn btn-style-three"><span class="txt">برو صفحه اصلی</span></a>
            </div>
        </div>
    </section>
    <!--End Error Section-->

@endsection
