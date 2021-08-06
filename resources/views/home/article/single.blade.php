@extends('home.layout.header')



@section('content')

    <section class="page-title">
        <div class="pattern-layer-one" style="background-image: url(/images/background/pattern-16.png)"></div>
        <div class="auto-container">
            <h2>{{$article->title}} </h2>

        </div>
    </section>
    <!--End Page Title-->

    <!-- Sidebar Page Container -->
    <div class="sidebar-page-container">
        <div class="auto-container">
            <div class="row clearfix">

                <!-- Content Side -->
                <div class="content-side col-lg-8 col-md-12 col-sm-12">
                    <div class="news-detail">
                        <div class="inner-box">
                            <div class="upper-box">
                                <h3>{{$article->title}}</h3>
                                <ul class="post-meta">
                                    <li><span class="icon flaticon-comment"></span>تعداد {{$article->comments()->count()}} نظر </li>
                                    <li><span class="icon flaticon-user"></span>{{$article->user->name}} </li>
                                </ul>
                            </div>
                            <div class="image">
                                <img src="{{$article->image}}" alt="{{$article->title}}" />
                                <div class="post-date">{{jdate($article->created_at)->format('%d')}} <span>{{jdate($article->created_at)->format('%B')}} </span></div>
                            </div>

                            <div class="lower-content">
                               {!! $article->text !!}

                                <!-- Post Share Options-->
                                <div class="post-share-options">
                                    <div class="post-share-inner clearfix">
                                        <div class="pull-left tags">
                                            @foreach($article->category as $cat)
                                            <a href="{{route('articles' , ['c' => $cat->slug])}}">{{$cat->name}} </a>
                                            @endforeach
                                        </div>
                                        <ul class="social-box pull-right">
                                            <li class="share">این مقاله را به اشتراک گذارید :</li>
                                            <li><a href="whatsapp://send?text={{route('single' , $article->slug)}}"><span style="font-family: 'Font Awesome 5 Brands'" class="fa fa-whatsapp"></span></a></li>
                                            <li><a href="https://telegram.me/share/url?url={{route('single' , $article->slug)}}"><span style="font-family: 'Font Awesome 5 Brands'" class="fa fa-telegram"></span></a></li>

                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="comments-area">
                            <div class="group-title">
                                <h3>{{$article->comments()->count()}} نظرات </h3>
                            </div>
                        @foreach($article->comments()->where('approved' , '1')->where('parent_id' , null)->get() as $comment)
                            <div class="comment-box">
                                <div class="comment">

                                    <div class="comment-info clearfix"><strong>{{$comment->name}} </strong><div class="comment-time">{{jdate($comment->created_at)->format('%d')}} {{jdate($comment->created_at)->format('%B')}} </div></div>
                                    <div class="text">{{$comment->comment}}</div>

                                </div>
                                @if($comment->child()->count())
                                    @foreach($comment->child()->where('approved' , '1')->get()  as $child)
                                <div class="comment-box reply-comment">
                                    <div class="comment">

                                        <div class="comment-info clearfix"><strong>{{$child->name}}</strong><div class="comment-time">{{jdate($child->created_at)->format('%d')}} {{jdate($child->created_at)->format('%B')}} </div></div>
                                        <div class="text">{{$child->comment}}</div>

                                    </div>
                                </div>
                                    @endforeach
                                    @endif

                            </div>
                            @endforeach




                        </div>

                        <!-- Comment Form -->
                        <div class="comment-form">

                            <div class="group-title"><h3>ارسال یک پیام </h3></div>

                            <!--Comment Form-->
                            <form method="post" action="{{route('comment')}}">
                                @csrf
                                <div class="row clearfix">
                                    <input type="hidden" name="commentable_type" value="{{get_class($article)}}">
                                    <input type="hidden" name="commentable_id" value="{{$article->id}}">
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <input type="text" name="name" placeholder="نام کامل" required="">
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <input type="email" name="email" placeholder="ایمیل" required="">
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <textarea class="darma" name="comment" placeholder="پیام شما"></textarea>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <button class="theme-btn btn-style-three" type="submit" name="submit-form"><span class="txt">ارسال نظر </span></button>
                                    </div>

                                </div>
                            </form>

                        </div>



                    </div>
                </div>

                <!-- Sidebar Side -->
                <div class="sidebar-side left-sidebar col-lg-4 col-md-12 col-sm-12">
                    <aside class="sidebar sticky-top">
                        <div class="sidebar-inner">

                            <!-- Search -->
                            <div class="sidebar-widget search-box">
                                <div class="sidebar-title">
                                    <h5>جستجو : -</h5>
                                </div>
                                <form method="get" action="{{route('articles')}}">
                                    <div class="form-group">
                                        <input type="search" name="q" value="" placeholder="جستجو ... " required>
                                        <button type="submit"><span class="icon fa fa-search"></span></button>
                                    </div>
                                </form>
                            </div>

                            <!-- Categories Widget -->
                            @if(\App\CategoryArticle::inRandomOrder()->get()->take(10)->where('is_active' , '1')->count())
                            <div class="sidebar-widget categories-widget">
                                <div class="sidebar-title">
                                    <h5>دسته بندی: </h5>
                                </div>
                                <div class="widget-content">
                                    <ul class="blog-cat">
                                        @foreach(\App\CategoryArticle::inRandomOrder()->get()->take(10)->where('is_active' , '1')  as $category)

                                            <li><a href="{{route('articles' ,['c' => $category->slug])}}">{{$category->name ?? ''}} <span>( {{$category->articles()->count()}} )</span></a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @endif

                            <!-- Categories Widget -->
                            @if(\App\Article::query()->latest()->get()->take(6)->where('is_active' , '1')->count())
                            <div class="sidebar-widget popular-posts">
                                <div class="sidebar-title">
                                    <h5>پست های اخیر : </h5>
                                </div>
                                <div class="widget-content">
                                    @foreach(\App\Article::query()->latest()->get()->take(6)->where('is_active' , '1') as $article)
                                    <article class="post">
                                        <figure class="post-thumb"><img src="{{$article->image}}" alt=""><a href="{{route('single' , $article->slug)}}" class="overlay-box"><span class="icon fa fa-link"></span></a></figure>
                                        <div class="text"><a href="{{route('single' , $article->slug)}}">{{$article->title}}</a></div>
                                        <div class="post-info">{{jdate($article->created_at)->format('%B')}}  {{jdate($article->created_at)->format('Y')}}</div>
                                    </article>
                                    @endforeach

                                </div>
                            </div>
                            @endif

                        </div>
                    </aside>
                </div>

            </div>
        </div>
    </div>

@endsection
