@extends('home.layout.header')



@section('content')

    <section class="page-title">
        <div class="pattern-layer-one" style="background-image: url(images/background/pattern-16.png)"></div>
        <div class="auto-container">
            <h2>بلاگ </h2>

        </div>
    </section>
    <!--End Page Title-->

    <!-- Blog Page Section -->
    <section class="blog-page-section">
        <div class="auto-container">
            <div class="row clearfix">

                <!-- News Block -->
                @foreach($articles as $article)
                <div class="news-block col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="image">
                            <a href="{{$article->image}}"><img src="{{$article->image}}" alt="{{$article->title}}" /></a>
                        </div>
                        <div class="lower-content">
                            <div class="post-date">{{jdate($article->created_at)->format('%d')}} <span>{{jdate($article->created_at)->format('%B')}} </span></div>
                            <ul class="post-meta">
                                <li><span class="icon flaticon-comment"></span>تعداد {{$article->comments()->count()}} نظر </li>
                                <li><span class="icon flaticon-user"></span>{{$article->user->name}} </li>
                            </ul>
                            <h4><a href="{{route('single.article' , $article->slug)}}">{{$article->title}}</a></h4>
                            <div class="text">{{$article->short_text}} ...</div>
                            <a class="read-more" href="{{route('single.article' , $article->slug)}}">ادامه مطلب <span class="arrow flaticon-long-arrow-pointing-to-the-right"></span></a>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>

            <!-- Post Share Options -->
            @include('home.paginat', ['paginator' => $articles])

        </div>
    </section>
@endsection
