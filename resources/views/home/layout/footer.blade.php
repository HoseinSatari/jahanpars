<footer class="main-footer">
    <div class="pattern-layer-one" style="background-image: url(/images/background/pattern-7.png)"></div>
    <div class="pattern-layer-two" style="background-image: url(/images/background/pattern-8.png)"></div>
    <!--Waves end-->
    <div class="auto-container">
        <!--Widgets Section-->
        <div class="widgets-section">
            <div class="row clearfix">

                <!-- Column -->
                <div class="big-column col-lg-6 col-md-12 col-sm-12">
                    <div class="row clearfix">

                        <!-- Footer Column -->
                        <div class="footer-column col-lg-7 col-md-6 col-sm-12">
                            <div class="footer-widget logo-widget">
                                <div class="logo">
                                    <a href="{{route('home')}}"><img class="rounded-circle" src="{{option()->image}}" alt="{{option()->title}}" style="width: 100px;height: 100px; " /></a>
                                </div>
                                <div class="text">{{option()->description}}
                                </div>
                                <!-- Social Box -->
                                <ul class="social-box">
                                    <li><a href="{{option()->whatsup}}" style="font-family: 'Font Awesome 5 Brands'" class="fa fa-whatsapp"></a></li>
                                    <li><a href="{{option()->instagram}}" style="font-family: 'Font Awesome 5 Brands'" class="fa fa-instagram"></a></li>
                                    <li><a href="{{option()->telegram}}" style="font-family: 'Font Awesome 5 Brands'" class="fas fa-telegram"></a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Footer Column -->

                    </div>
                </div>

                <!-- Column -->
                <div class="big-column col-lg-6 col-md-12 col-sm-12">
                    <div class="row clearfix">

                        <!-- Footer Column -->
                        @if(\App\Article::where('is_active' ,'1')->count())
                            <div class="footer-column col-lg-6 col-md-6 col-sm-12">
                                <div class="footer-widget news-widget">
                                    <h5>پست های اخیر</h5>
                                    <!-- Footer Column -->
                                    <div class="widget-content">
                                        @foreach(\App\Article::query()->latest()->where('is_active' , '1')->get()->take(3) as $post)
                                            <div class="post">
                                                <div class="thumb"><a
                                                        href="{{route('single.article' , $post->slug)}}"><img
                                                            src="{{$post->image}}" alt="{{$post->title}}"></a></div>
                                                <h6>
                                                    <a href="{{route('single.article' , $post->slug)}}">{{$post->title}}</a>
                                                </h6>
                                                <span
                                                    class="date">{{jdate($post->created_at)->format('%B')}} {{jdate($post->created_at)->format('Y')}}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                    @endif
                    <!-- Footer Column -->
                        <div class="footer-column col-lg-6 col-md-6 col-sm-12">
                            <div class="footer-widget contact-widget">
                                <h5>تماس با ما </h5>
                                <ul>
                                    <li>
                                        <span class="icon flaticon-placeholder-2"></span>
                                        <strong>آدرس </strong>
                                        {{option()->address}}
                                    </li>
                                    <li>
                                        <span class="icon flaticon-phone-call"></span>
                                        <strong>تلفن </strong>
                                        <a href="tel:{{option()->phone}}">{{option()->phone}}</a>
                                    </li>
                                    <li>
                                        <span class="icon flaticon-email-1"></span>
                                        <strong>ایمیل </strong>
                                        <a href="mailto:{{option()->email}}">{{option()->email}}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="auto-container">
                <div class="row clearfix">
                    <!-- Column -->
                    <div class="column col-lg-6 col-md-12 col-sm-12">
                        <div class="copyright">کپی رایت 1400 | طراحی سایت و توسعه قالب توسط <a href="https://www.instagram.com/A.g.team/">A.g.team</a>. تمام حقوق سایت
                            محفوظ می باشد.
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="column col-lg-6 col-md-12 col-sm-12">
                        <ul class="footer-nav">
                            <li><a href="{{route('about')}}">درباره ما </a></li>
                            <li><a href="{{route('contact.show')}}">تماس با ما </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
</footer>
<div class="color-palate">
    <div class="color-trigger">
        <i class="fa fa-gear"></i>
    </div>
    <div class="color-palate-head">
        <h6>انتخاب رنگ دلخواه</h6>
    </div>

    <div class="various-color clearfix">
        <div class="colors-list">
            <span class="palate default-color active" data-theme-file="/home/css/color-themes/default-theme.css"></span>
            <span class="palate green-color" data-theme-file="/home/css/color-themes/green-theme.css"></span>
            <span class="palate olive-color" data-theme-file="/home/css/color-themes/olive-theme.css"></span>
            <span class="palate orange-color" data-theme-file="/home/css/color-themes/orange-theme.css"></span>
            <span class="palate purple-color" data-theme-file="/home/css/color-themes/purple-theme.css"></span>
            <span class="palate teal-color" data-theme-file="/home/css/color-themes/teal-theme.css"></span>
            <span class="palate brown-color" data-theme-file="/home/css/color-themes/brown-theme.css"></span>
            <span class="palate redd-color" data-theme-file="/home/css/color-themes/redd-color.css"></span>
        </div>
    </div>


</div>

<!-- Search Popup -->
<div class="search-popup">
    <button class="close-search style-two"><span class="flaticon-multiply"></span></button>
    <button class="close-search"><span class="flaticon-up-arrow-1"></span></button>
    <form method="get" action="{{route('store')}}">
        <div class="form-group">
            <input type="search" name="q" value="" placeholder="اینجا جستجو کنید" required="">
            <button type="submit"><i class="fa fa-search"></i></button>
        </div>
    </form>
</div>
<!-- End Header Search -->

<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-arrow-up"></span></div>

<script src="/home/js/jquery.js"></script>
<script src="/home/js/popper.min.js"></script>
<script src="/home/js/bootstrap.min.js"></script>
<script src="/home/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="/home/js/jquery.fancybox.js"></script>
<script src="/home/js/appear.js"></script>
<script src="/home/js/parallax.min.js"></script>
<script src="/home/js/tilt.jquery.min.js"></script>
<script src="/home/js/jquery.paroller.min.js"></script>
<script src="/home/js/owl.js"></script>
<script src="/home/js/wow.js"></script>
<script src="/home/js/nav-tool.js"></script>
<script src="/home/js/jquery-ui.js"></script>
<script src="/home/js/script.js"></script>
<script src="/home/js/color-settings.js"></script>


@jquery
@toastr_js
@toastr_render
@stack('scripts')
@include('sweet::alert')
</body>

</html>
