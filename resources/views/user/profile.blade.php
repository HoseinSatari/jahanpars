@extends('home.layout.header')


@section('content')

    <section class="page-title">
        <div class="pattern-layer-one" style="background-image: url(/images/background/pattern-16.png)"></div>
        <div class="auto-container">
            <h2>پنل کاربری</h2>
        </div>
    </section>

    <div class="page-content mt-4 mb-4">
        <div class="dashboard">
            <div class="container">
                <div class="row">
                    <aside class="col-md-4 col-lg-3">
                        <ul class="nav nav-dashboard flex-column mb-3 mb-md-0 active" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link @if(session('user_edit')) active  @endif" id="tab-dashboard-link"
                                   data-toggle="tab"
                                   href="#tab-dashboard" role="tab" aria-controls="tab-dashboard"
                                   aria-selected="{{session('user_edit') ? 'true' : 'false'}}">اطلاعات کاربر</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(session('order')) active  @endif" id="tab-orders-link" data-toggle="tab" href="#tab-orders"
                                   role="tab" aria-controls="tab-orders" aria-selected="{{session('order') ? 'true' : 'false'}}">سفارشات</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-downloads-link" data-toggle="tab"
                                   href="#tab-comment" role="tab" aria-controls="tab-comment"
                                   aria-selected="false"> نظرات</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-downloads-link" data-toggle="tab"
                                   href="#tab-favourite" role="tab" aria-controls="tab-favourite"
                                   aria-selected="false"> محصولات مورد علاقه</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href=""
                                   onclick="event.preventDefault(); document.getElementById('logout').submit()">خروج از
                                    حساب کاربری</a>
                            </li>
                        </ul>
                    </aside><!-- End .col-lg-3 -->

                    <div class="col-md-8 col-lg-9 ">
                        <div class="tab-content">
                            <div class="mb-2">
                            </div>
                            <div class="tab-pane fade @if(session('user_edit')) active show @endif " id="tab-dashboard"
                                 role="tabpanel"
                                 aria-labelledby="tab-dashboard-link">


                                <form method="post" action="{{route('user.update', $user->id)}}">
                                    @csrf
                                    <div class="form-group">
                                        <span class="adon-icon"><span class="fa fa-user"></span></span>
                                        <input type="text" class="form-control" value="{{$user->name}}"
                                               placeholder="نام" disabled>
                                    </div>
                                    <div class="form-group">

                                        <span class="adon-icon"><span class="fa fa-envelope-o">@if(!$user->email_verified_at)<a href=""
                                                                                                  onclick="event.preventDefault(); document.getElementById('verify_email').submit()"
                                                                                                  class="mb-2 mr-2">ایمیل شما تایید نشده برای تایید کلیک کنید</a>@endif</span></span>
                                        <input type="email" class=" form-control " value="{{$user->email}}"
                                               placeholder="ایمیل" disabled>
                                    </div>
                                    <div class="form-group">
                                        <span class="adon-icon"><span class="fa fa-phone"></span></span>
                                        <input type="tel" name="phone"
                                               class="form-control @error('phone') is-invalid @enderror"
                                               value="{{$user->phone}}" placeholder="شماره تماس">
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <span class="adon-icon"><span class="fa fa-book"></span></span>
                                        <textarea name="address"
                                                  class="form-control @error('address') is-invalid @enderror"
                                                  placeholder="ادرس " id="" cols="30"
                                                  rows="4">{{$user->address ?? ''}}</textarea>
                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror


                                    </div>
                                    @if($user->password == null)
                                        <div class="form-group">
                                            <span class="adon-icon"><span class="fa fa-unlock-alt"></span></span>
                                            <input type="password" name="password"
                                                   class="form-control @error('password') is-invalid @enderror" value=""
                                                   placeholder="کلمه عبوری برای حساب خود در نظر بگیرید">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    @endif
                                    <div class="clearfix">
                                        <div class="form-group pull-left">
                                            <button type="submit" class="theme-btn btn-style-three"><span class="txt">ویرایش </span>
                                            </button>
                                        </div>
                                    </div>
                                </form>


                            </div><!-- .End .tab-pane -->
                            <div class="tab-pane fade @if(session('order')) active show @endif" id="tab-orders" role="tabpanel"
                                 aria-labelledby="tab-orders-link">
                                <div class="table-responsive">
                                <table class="table table-condensed table-striped">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>کد سفارش</th>
                                        <th> تاریخ ثبت</th>
                                        <th>وضعیت مرسوله</th>
                                        <th>کد رهگیری پستی</th>
                                        <th>مبلغ </th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @if($user->orders->count())
                                    @foreach($user->orders->sortByDesc('created_at') as $order)
                                    <tr data-toggle="collapse" data-target="#{{$loop->index}}" class="accordion-toggle">
                                        <td><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open"></span></button></td>
                                            <th>{{$order->code}}</th>
                                            <th>{{jdate($order->created_at)->format('%d %B %Y')}}</th>
                                            <th>{{$order->statuss()}}</th>
                                            <th>{{$order->tracking_serial ?? ' ثبت نشده'}}</th>
                                            <th>{{number_format($order->price)}} تومان</th>
                                        </tr>


                                    <tr>
                                        <td colspan="12" class="hiddenRow">
                                            <div class="accordian-body collapse" id="{{$loop->index}}">
                                                <table class="table table-striped">
                                                    <thead>
                                                    <tr class="info">
                                                        <th>#</th>
                                                        <th>عکس</th>
                                                        <th>نام</th>
                                                        <th>قیمت </th>
                                                        <th> تعداد</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($order->products as $product)
                                                    <tr data-toggle="collapse"  class="accordion-toggle" data-target="">

                                                        <td>{{$loop->index}} </td>
                                                            <td><img src="{{$product->image}}" alt="{{$product->title}}"  width="50px" height="50px" class="rounded-circle"> </td>
                                                            <td>{{$product->title}} </td>
                                                            <td>{{number_format($product->pivot->price)}} تومان</td>
                                                            <td>{{$product->pivot->quantity}} </td>
                                                        @endforeach
                                                    </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <h3>سفارشی ندارید</h3>
                                    @endif
                                    </tbody>
                                </table>
                                </div>

                            </div><!-- .End .tab-pane -->
                            <div class="tab-pane fade" id="tab-comment" role="tabpanel"
                                 aria-labelledby="tab-downloads-link">
                                <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>تاریخ</th>
                                        <th>نظر</th>
                                        <th>صفحه</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($user->comments->count())
                                        @foreach($user->comments as $comment)
                                    <tr>

                                        <td>{{$loop->index}}</td>
                                            <td>{{jdate($comment->created_at)->format('%d %B %Y')}}</td>
                                            <td>{{$comment->comment}}</td>
                                            <td>
                                                @if($comment->commentable_type == 'App\Product')
                                                    <a href="{{route('single' , \App\Product::find($comment->commentable_id)->first()->slug)}}">{{\App\Product::find($comment->commentable_id)->first()->title}}</a>
                                                    @else
                                                    <a href="{{route('single.article' , \App\Article::find($comment->commentable_id)->first()->slug)}}">{{\App\Article::find($comment->commentable_id)->first()->title}}</a>
                                                @endif
                                            </td>


                                    </tr>
                                        @endforeach
                                    @else
                                        <h3>نظر ثبت شده ندارید</h3>
                                    @endif
                                    </tbody>
                                </table>
                                </div>
                            </div><!-- .End .tab-pane -->
                            <div class="tab-pane fade" id="tab-favourite" role="tabpanel"
                                 aria-labelledby="tab-downloads-link">
                                <div class="table-responsive">
                                    @if($user->favourite->count())
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>عکس</th>
                                            <th>نام</th>
                                            <th>توضیحات</th>
                                            <th>قیمت</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($user->favourite as $p)
                                                @php $product = \App\Product::find($p->product_id);  @endphp
                                                <tr>
                                                    <td>{{$loop->index}}</td>
                                                    <td><img src="{{$product->image}}"
                                                             class="rounded-circle"
                                                             alt="{{$product->title}}" width="75px"
                                                             height="75px"></td>
                                                    <td><a href="{{route('single' , $product->slug)}}">{{$product->title}}</a></td>
                                                    <td>{{$product->short_descrip}}</td>
                                                    <td>{{$product->price}}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <h3> محصول مورد علاقه ای ندارید</h3>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- .End .tab-pane -->
                        </div>
                    </div><!-- End .col-lg-9 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .dashboard -->
    </div>
    <form action="{{route('verification.resend')}}" id="verify_email" method="post">
        @csrf
    </form>
    <form action="{{route('logout')}}" id="logout" method="post">
        @csrf
    </form>

@endsection







