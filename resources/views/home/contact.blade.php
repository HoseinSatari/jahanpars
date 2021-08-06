@extends('home.layout.header')


@section('content')

    <section class="page-title">
        <div class="pattern-layer-one" style="background-image: url(images/background/pattern-16.png)"></div>
        <div class="auto-container">
            <h2>تماس با ما</h2>
        </div>
    </section>
    <!--End Page Title-->

    <!-- Contact Info Section -->
    <section class="contact-info-section">
        <div class="auto-container">
            <!-- Sec Title -->
            <div class="title-box">
                <div class="title">در تماس باشید</div>

                <div class="text">برای سوالات عمومی می توانید با تیم پشتیبانی میز جلو تماس بگیرید <br> با ایمیل <a href="mailto:{{option()->email}}">{{option()->email}}</a> در تماس باشید <a href="tel:{{option()->phone}}">{{option()->phone}}</a></div>
            </div>

            <div class="row clearfix">

                <!-- Info Column -->
                <div class="info-column col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-column">
                        <div class="content">
                            <div class="icon-box"><span class="flaticon-pin"></span></div>
                            <ul>
                                <li><strong>آدرس </strong></li>
                                <li>{{option()->address}}</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Info Column -->
                <div class="info-column col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-column">
                        <div class="content">
                            <div class="icon-box"><span class="flaticon-phone-call"></span></div>
                            <ul>
                                <li><strong>تلفن </strong></li>
                                <li>{{option()->phone}}</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Info Column -->
                <div class="info-column col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-column">
                        <div class="content">
                            <div class="icon-box"><span class="flaticon-email-1"></span></div>
                            <ul>
                                <li><strong>ایمیل </strong></li>
                                <li>{{option()->email}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Contact Info Section -->

    <!-- Map Section -->

    <!-- End Map Section -->

    <!-- Contact Map Section -->
    <section class="contact-map-section">
        <div class="auto-container">
            <!-- Sec Title -->
            <div class="sec-title">
                <div class="clearfix">
                    <div class="pull-left">
                        <div class="title">پیامی ارسال کنید</div>
                        <h2>پیام ارسالی شما</h2>
                    </div>

                </div>
            </div>

            <!-- Contact Form -->
            <div class="contact-form">

                <!-- Contact Form -->
                <form method="post" action="{{route('contact.send')}}" >
                    @csrf
                    <div class="row clearfix">

                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <label>نام شما *</label>
                            <input type="text" name="name" placeholder="" class="@error('name') is-invalid @enderror" required>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                            @enderror
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <label> ایمیل  *</label>
                            <input type="text" name="email" class="@error('email') is-invalid @enderror" placeholder="" required>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                            @enderror
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <label>شماره تلفن *</label>
                            <input type="text" name="phone" class="@error('phone') is-invalid @enderror" placeholder="" required>
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                            @enderror
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <label> وب سایت </label>
                            <input type="text" name="site" class="@error('site') is-invalid @enderror" placeholder="" >
                            @error('site')
                            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                            @enderror
                        </div>

                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <label>پیام شما *</label>
                            <textarea name="text" class="@error('text') is-invalid @enderror" placeholder=""></textarea>
                            @error('text')
                            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                            @enderror
                        </div>

                        <div class="form-group text-center col-lg-12 col-md-12 col-sm-12">
                            <button class="theme-btn btn-style-three" type="submit" name="submit-form"><span class="txt">اکنون ارسال کنید </span></button>
                        </div>

                    </div>
                </form>
            </div>
            <!-- End Contact Form -->

        </div>
    </section>

@endsection
