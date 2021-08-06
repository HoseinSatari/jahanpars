@extends('home.layout.header')

@section('content')
    <section class="page-title">
        <div class="pattern-layer-one" style="background-image: url(images/background/pattern-16.png)"></div>
        <div class="auto-container">
            <h2>ورود و ثبت نام</h2>
        </div>
    </section>
    <!--End Page Title-->

    <!--Register Section-->
    <section class="register-section">
        <div class="auto-container">
            <div class="row clearfix">

                <!--Form Column-->
                <div class="form-column column col-lg-6 col-md-12 col-sm-12">

                    <div class="sec-title">
                        <h2>اکنون وارد شوید</h2>
                        <div class="separate"></div>
                    </div>

                    <!--Login Form-->
                    <div class="styled-form login-form">
                        <form method="post" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-envelope-o"></span></span>
                                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="" placeholder="آدرس ایمیل یا تلفن *">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-unlock-alt"></span></span>
                                <input type="password" name="password" class=" form-control @error('password') is-invalid @enderror" value="" placeholder="وارد کردن رمز عبور">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="clearfix">
                                <div class="form-group pull-left">
                                    <button type="submit" class="theme-btn btn-style-three"><span class="txt">ورود </span></button>
                                </div>
                                <div class="form-group social-links-two pull-right">
                                    یا وارد شدن از طریق   <a href="{{route('auth.google')}}" class="img-circle google-plus"><span style="font-family: 'Font Awesome 5 Brands'" class="fa fa-google"></span></a>
                                </div>
                            </div>

                            <div class="clearfix">
                                <div class="pull-left">
                                    <input type="checkbox" name="remember" id="remember-me"><label class="remember-me" for="remember-me" {{ old('remember') ? 'checked' : '' }}>&nbsp; مرا به خاطر بسپار</label>
                                </div>
                            </div>
                            <div class="clearfix">
                                <div class="pull-left">
                                    <a href="{{route('user.resetpassword')}}">فراموشی رمز عبور</a>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>

                <!--Form Column-->
                <div class="form-column column col-lg-6 col-md-12 col-sm-12">

                    <div class="sec-title">
                        <h2>اینجا ثبت نام کنید</h2>
                        <div class="separate"></div>
                    </div>

                    <!--Login Form-->
                    <div class="styled-form register-form">
                        <form method="post" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-user"></span></span>
                                <input type="text" name="namer" class="form-control @error('namer') is-invalid @enderror" value="" placeholder="نام شما *">
                                @error('namer')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-envelope-o"></span></span>
                                <input type="email" name="emailr" class="form-control @error('emailr') is-invalid @enderror" value="" placeholder="آدرس ایمیل *">
                                @error('emailr')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-unlock-alt"></span></span>
                                <input type="password" name="passwordr" class="form-control @error('passwordr') is-invalid @enderror" value="" placeholder="وارد کردن رمز عبور">
                                @error('passwordr')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="clearfix">
                                <div class="form-group pull-left">
                                    <button type="submit" class="theme-btn btn-style-three"><span class="txt">اینجا ثبت نام کنید</span></button>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>

            </div>
        </div>
    </section>
    <!--End Register Section-->






@endsection
