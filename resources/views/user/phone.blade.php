@extends('home.layout.header')


@section('content')

    <section class="page-title">
        <div class="pattern-layer-one" style="background-image: url(images/background/pattern-16.png)"></div>
        <div class="auto-container">
            <h2>ثبت شماه تلفن  </h2>
        </div>
    </section>

    <section class="page-item mt-5 mb-5">
        <div class="pattern-layer-one" style="background-image: url(images/background/pattern-16.png)"></div>
        <div class="auto-container">

            <form method="post" action="{{route('user.phone')}}">
                @csrf

                <div class="form-group">
                    <span class="adon-icon"><span class="fa fa-user"></span></span>
                    <input type="number"  class="form-control" value="" placeholder="شماره" name="phone">
                </div>
                <div class="clearfix">
                    <div class="form-group pull-left">
                        <button type="submit" class="theme-btn btn-style-three"><span class="txt">ارسال </span></button>
                    </div>
                </div>
            </form>
        </div>
    </section>

@endsection
