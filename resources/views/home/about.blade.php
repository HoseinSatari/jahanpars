@extends('home.layout.header')

@section('content')


    <section class="page-title">
        <div class="pattern-layer-one" style="background-image: url(images/background/pattern-16.png)"></div>
        <div class="auto-container">
            <h2> درباره ما </h2>
            <ul class="page-breadcrumb">
                <li><a href="index.html">صفحه اصلی </a></li>
                <li>درباره ما </li>
            </ul>
        </div>
    </section>
    <!--End Page Title-->

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
                        <div class="text">آیا هر صنعتی از روند مخاطب و روند فروش بازاریابی پیچیده تری از فناوری B2B برخوردار است؟ تعداد افرادی که بر فروش تأثیر می گذارند ، طول چرخه تصمیم گیری ، منافع رقابتی افرادی که این فناوری را خریداری ، اجرا ، مدیریت و استفاده می کنند ، در نظر بگیرید. در اینجا محتوای بسیار معنی داری است.</div>
                        <div class="blocks-outer">

                            <!-- Feature Block -->
                            <div class="feature-block">
                                <div class="inner-box">
                                    <div class="icon flaticon-award-1"></div>
                                    <h6>تجربه </h6>
                                    <div class="feature-text">تیم عالی ما متشکل از بیش از 1400 متخصص نرم افزار است.</div>
                                </div>
                            </div>

                            <!-- Feature Block -->
                            <div class="feature-block">
                                <div class="inner-box">
                                    <div class="icon flaticon-technical-support"></div>
                                    <h6>پشتیبانی سریع </h6>
                                    <div class="feature-text">ما به شما کمک می کنیم ضمن به اشتراک گذاشتن ایده های جسورانه ، ایده های جدید پررنگ خود را ارسال کنید.</div>
                                </div>
                            </div>

                        </div>

                        <a href="#" class="lightbox-image theme-btn btn-style-one"><span class="txt"><i class="play-icon"><img src="images/icons/play-icon.png" alt="" /></i>&ensp; نمایش ویدئو </span></a>

                    </div>
                </div>

                <!-- Images Column -->
                <div class="images-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column" style="background-image: url(images/icons/globe.png)">
                        <div class="pattern-layer" style="background-image: url(images/background/pattern-1.png)"></div>
                        <div class="images-outer parallax-scene-1">
                            <div class="image" data-depth="0.10">
                                <img src="images/resource/about-1.jpg" alt="" />
                            </div>
                            <div class="image-two" data-depth="0.30">
                                <img src="images/resource/about-2.jpg" alt="" />
                            </div>
                            <div class="image-three" data-depth="0.20">
                                <img src="images/resource/about-3.jpg" alt="" />
                            </div>
                            <div class="image-four" data-depth="0.30">
                                <img src="images/resource/about-4.jpg" alt="" />
                            </div>
                        </div>
                    </div>
                    <a href="about.html" class="learn"><span class="arrow flaticon-long-arrow-pointing-to-the-right"></span>مطالعه بیشتر درباره شرکت</a>
                </div>

            </div>
        </div>
    </section>
    <!-- End About Section -->

    <!-- Counter Section -->
    <section class="counter-section">
        <div class="auto-container">
            <div class="inner-container">
                <!-- Fact Counter -->
                <div class="fact-counter">
                    <div class="row clearfix">

                        <!-- Column -->
                        <div class="column counter-column col-lg-3 col-md-6 col-sm-12">
                            <div class="inner wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                                <div class="content">
                                    <div class="count-outer count-box">
                                        <span class="count-text" data-speed="3000" data-stop="330">0</span>+
                                    </div>
                                    <h4 class="counter-title">مشتریان فعال </h4>
                                </div>
                            </div>
                        </div>

                        <!-- Column -->
                        <div class="column counter-column col-lg-3 col-md-6 col-sm-12">
                            <div class="inner wow fadeInLeft" data-wow-delay="300ms" data-wow-duration="1500ms">
                                <div class="content">
                                    <div class="count-outer count-box alternate">
                                        <span class="count-text" data-speed="5000" data-stop="850">0</span>+
                                    </div>
                                    <h4 class="counter-title">پروژه های انجام شده</h4>
                                </div>
                            </div>
                        </div>

                        <!-- Column -->
                        <div class="column counter-column col-lg-3 col-md-6 col-sm-12">
                            <div class="inner wow fadeInLeft" data-wow-delay="600ms" data-wow-duration="1500ms">
                                <div class="content">
                                    <div class="count-outer count-box">
                                        <span class="count-text" data-speed="2000" data-stop="25">0</span>+
                                    </div>
                                    <h4 class="counter-title">مشاوران تیم</h4>
                                </div>
                            </div>
                        </div>

                        <!-- Column -->
                        <div class="column counter-column col-lg-3 col-md-6 col-sm-12">
                            <div class="inner wow fadeInLeft" data-wow-delay="900ms" data-wow-duration="1500ms">
                                <div class="content">
                                    <div class="count-outer count-box">
                                        <span class="count-text" data-speed="3500" data-stop="10">0</span>+
                                    </div>
                                    <h4 class="counter-title">سالهای باشکوه</h4>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Counter Section -->

    <!-- About Section Two -->
    <section class="about-section-two" style="background-image: url(images/background/3.jpg)">
        <div class="auto-container">
            <div class="row clearfix">

                <!-- Image Column -->
                <div class="image-column col-lg-7 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="circle-layer" style="background-image: url(images/background/pattern-10.png)"></div>
                        <div class="image">
                            <img src="images/resource/about-5.jpg" alt="" />
                        </div>
                    </div>
                </div>

                <!-- Skill Column -->
                <div class="skill-column col-lg-5 col-md-12 col-sm-12">
                    <div class="inner-column">

                        <!-- Sec Title -->
                        <div class="sec-title light">
                            <div class="title">درباره گلوباکس</div>
                            <h2>تجارت خود را با ارائه دهنده پیشرو راه حل IT تغییر دهید.</h2>
                            <div class="text">گوش می دهیم. ما توصیه می کنیم. ما با هم طراحی می کنیم. مشتری های خوشحال و روابط مداوم همان چیزی است که ما برای آن تلاش می کنیم. موفقیت با نتایج سنجیده می شود ، مهمترین احساس مشتری در مورد تجربه خود با ماست.</div>
                        </div>

                        <!-- Skills -->
                        <div class="skills">

                            <!-- Skill Item -->
                            <div class="skill-item">
                                <div class="skill-header clearfix">
                                    <div class="skill-title">UI/UX طراحی </div>
                                    <div class="skill-percentage"><div class="count-box"><span class="count-text" data-speed="2000" data-stop="93">0</span>%</div></div>
                                </div>
                                <div class="skill-bar">
                                    <div class="bar-inner"><div class="bar progress-line" data-width="93"></div></div>
                                </div>
                            </div>

                            <!-- Skill Item -->
                            <div class="skill-item">
                                <div class="skill-header clearfix">
                                    <div class="skill-title">توسعه اپ</div>
                                    <div class="skill-percentage"><div class="count-box"><span class="count-text" data-speed="2000" data-stop="80">0</span>%</div></div>
                                </div>
                                <div class="skill-bar">
                                    <div class="bar-inner"><div class="bar progress-line" data-width="80"></div></div>
                                </div>
                            </div>

                            <!-- Skill Item -->
                            <div class="skill-item">
                                <div class="skill-header clearfix">
                                    <div class="skill-title">توسعه وب</div>
                                    <div class="skill-percentage"><div class="count-box"><span class="count-text" data-speed="2000" data-stop="73">0</span>%</div></div>
                                </div>
                                <div class="skill-bar">
                                    <div class="bar-inner"><div class="bar progress-line" data-width="73"></div></div>
                                </div>
                            </div>

                        </div>

                        <a href="contact.html" class="theme-btn btn-style-two"><span class="txt">مطالعه بیشتر</span></a>

                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="sponsors-section style-two">
        <div class="auto-container">

            <div class="carousel-outer">
                <!--Sponsors Slider-->
                <ul class="sponsors-carousel owl-carousel owl-theme">
                    <li><div class="image-box"><a href="#"><img src="images/clients/1.png" alt=""></a></div></li>
                    <li><div class="image-box"><a href="#"><img src="images/clients/2.png" alt=""></a></div></li>
                    <li><div class="image-box"><a href="#"><img src="images/clients/3.png" alt=""></a></div></li>
                    <li><div class="image-box"><a href="#"><img src="images/clients/4.png" alt=""></a></div></li>
                    <li><div class="image-box"><a href="#"><img src="images/clients/1.png" alt=""></a></div></li>
                    <li><div class="image-box"><a href="#"><img src="images/clients/2.png" alt=""></a></div></li>
                    <li><div class="image-box"><a href="#"><img src="images/clients/3.png" alt=""></a></div></li>
                    <li><div class="image-box"><a href="#"><img src="images/clients/4.png" alt=""></a></div></li>
                </ul>
            </div>

        </div>
    </section>
    <!--End Sponsors Section-->

    <!-- Process Section -->
    <section class="process-section">
        <div class="pattern-layer-one" style="background-image: url(images/background/pattern-11.jpg)"></div>
        <div class="pattern-layer-two" style="background-image: url(images/background/pattern-12.jpg)"></div>
        <div class="auto-container">
            <!-- Sec Title -->
            <div class="sec-title centered">
                <div class="title">روند ما  </div>
                <h2>رانندگی نتایج مشتری با استفاده از جدید <br> نقطه نظرات نوآوری</h2>
            </div>
            <div class="row clearfix">

                <!-- Process Block -->
                <div class="process-block col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="number-box">01</div>
                        <h4><a href="services-detail.html">راه حل های پایان به پایان و خدمات تضمین شده</a></h4>
                        <div class="text">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد..</div>
                        <a class="read-more" href="services-detail.html"><span class="arrow flaticon-long-arrow-pointing-to-the-right"></span>ادامه مطلب </a>
                    </div>
                </div>

                <!-- Process Block -->
                <div class="process-block col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="number-box">02</div>
                        <h4><a href="services-detail.html">پیش از منحنی ما در آینده فناوری اطلاعات شما را اثبات نمی کنیم</a></h4>
                        <div class="text">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد..</div>
                        <a class="read-more" href="services-detail.html"><span class="arrow flaticon-long-arrow-pointing-to-the-right"></span>ادامه مطلب </a>
                    </div>
                </div>

                <!-- Process Block -->
                <div class="process-block col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="number-box">03</div>
                        <h4><a href="services-detail.html">اطمینان از اطمینان از موفقیت هر پروژه ای را تجربه کنید</a></h4>
                        <div class="text">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد..</div>
                        <a class="read-more" href="services-detail.html"><span class="arrow flaticon-long-arrow-pointing-to-the-right"></span>ادامه مطلب </a>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
