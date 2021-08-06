@extends('home.layout.header')

@section('scripts')
    <script src="/js/jquery.bootstrap-touchspin.js"></script>


    <script src="/js/mixitup.js"></script>


@endsection


@section('content')

    <script>
        function favourite(product, check) {
            event.preventDefault()
            if (!check) {
                window.location = "/login";
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                }
            })

            $.ajax({
                type: 'POST',
                url: '/profile/favourit/' + product,
                data: JSON.stringify('send'),
                success: function () {
                    if ($("#icon").hasClass('fa fa-heart-broken')) {
                        $("#icon").removeClass("fa fa-heart-broken");
                        $("#icon").addClass('fa fa-heart');
                    } else {
                        $("#icon").removeClass("fa fa-heart");
                        $("#icon").addClass('fa fa-heart-broken');
                    }

                }
            })

        }
    </script>
    <section class="page-title">
        <div class="pattern-layer-one" style="background-image: url(/images/background/pattern-16.png)"></div>
        <div class="auto-container">
            <h2> {{$product->title}}</h2>

        </div>
    </section>
    <!--End Page Title-->

    <!--Shop Single Section-->
    <section class="shop-single-section">
        <div class="auto-container">

            <!--Shop Single-->
            <div class="shop-page product-details">

                <!--Basic Details-->
                <div class="basic-details">
                    <div class="row clearfix">

                        <div class="image-column col-lg-7 col-md-12 col-sm-12">
                            <div class="carousel-outer">

                                <ul class="image-carousel owl-carousel owl-theme">
                                    <li><a href="{{$product->image}}" class="lightbox-image"
                                           title="{{$product->title}}"><img src="{{$product->image}}"
                                                                            style="height: 500px"
                                                                            alt="{{$product->title}}"></a></li>
                                    @foreach($product->Gallery as $img)
                                        <li><a href="{{$img->image}}" class="lightbox-image"
                                               title="{{$img->alt}}"><img src="{{$img->image}}" style="height: 500px"
                                                                          alt="{{$img->alt}}"></a></li>
                                    @endforeach
                                </ul>

                                <ul class="thumbs-carousel owl-carousel owl-theme">
                                    @if($product->Gallery->count())
                                        <li><img src="{{$product->image}}" style="height: 75px"
                                                 alt="{{$product->title}}"></li>
                                        @foreach($product->Gallery as $img)
                                            <li><img src="{{$img->image}}" style="height: 75px" alt="{{$img->alt}}">
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>


                            </div>
                        </div>
                        <!--Info Column-->
                        <div class="info-column col-lg-5 col-md-12 col-sm-12">
                            <div class="details-header">
                                <h2>{{$product->title}} </h2>
                                @if($product->inventory != '0')
                                    @if(\Illuminate\Support\Facades\Auth::check())
                                        @if(auth()->user()->checkCart($product))

                                        @else
                                            <div class="item-price">قیمت: {{number_format($product->price)}} تومان</div>
                                        @endif
                                    @else
                                        <div class="item-price">قیمت: {{number_format($product->price)}}تومان
                                        </div>
                                    @endif
                                @endif
                            </div>

                            <div class="text">
                                <p>{{$product->short_descrip}}</p>
                            </div>

                            <div class="other-options">
                                <div class="clearfix">
                                    <div class="pull-left">
                                        @if($product->inventory != '0')
                                            @if(\Illuminate\Support\Facades\Auth::check())
                                                @if(auth()->user()->checkCart($product))
                                                    <div class="alert alert-warning">تعداد سفارش شما برابر با موجودی
                                                        محصول میباشد
                                                    </div>
                                                @else

                                                    <form action="{{route('add.cart' , $product->id)}}" method="post">
                                                        @csrf

                                                        <div class="item-quantity"><input type="number" id="qty"
                                                                                          name="qty"
                                                                                          class="form-control"
                                                                                          value="1" min="1"
                                                                                          max="{{qty($product)}}"
                                                                                          step="1" data-decimals="0"
                                                                                          required>
                                                        </div>

                                                        <div class="pull-left">
                                                            <!--Btns Box-->
                                                            <div class="btns-box">
                                                                <button type="submit" class="theme-btn btn-style-three"><span
                                                                        class="txt">افزودن به سبد</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                @endif

                                            @else
                                                <form action="{{route('add.cart' , $product->id)}}" method="post">
                                                    @csrf

                                                    <div class="item-quantity"><input type="number" id="qty" name="qty"
                                                                                      class="form-control"
                                                                                      value="1" min="1"
                                                                                      max="{{$product->inventory}}"
                                                                                      step="1" data-decimals="0"
                                                                                      required>
                                                    </div>

                                                    <div class="pull-left">
                                                        <!--Btns Box-->
                                                        <div class="btns-box">
                                                            <button type="submit"
                                                                    class="theme-btn btn-style-three"><span
                                                                    class="txt">افزودن به سبد</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            @endif

                                        @else
                                            <div class="alert alert-danger">موجودی محصول مورد نظر به اتمام رسیده است
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <ul class="shop-list">
                                <li><strong>دسته: </strong><span class="theme_color"></span>
                                    @foreach($product->categories as $category)
                                        {{$category->name}} -
                                    @endforeach
                                </li>
                                <br>
                                <li><a href="#" id="fav" onclick="favourite({{$product->id}} , {{auth()->check()}}) "
                                       class="btn-product   "
                                       title="لیست علاقه مندی"><i id="icon"
                                                                  class="@if(auth()->check()) @if(auth()->user()->favourite()->where('product_id' , $product->id)->first() ) fa fa-heart @else fa fa-heart-broken @endif @else fa fa-heart-broken @endif  ml-3"></i><span
                                            id="favourite_text">افزودن
                                                    به
                                                    علاقه مندی</span> </a></li>
                            </ul>

                        </div>

                    </div>
                </div>
                <!--Basic Details-->

                <!--Product Info Tabs-->
                <div class="product-info-tabs">
                    <!--Product Tabs-->
                    <div class="prod-tabs tabs-box">

                        <!--Tab Btns-->
                        <ul class="tab-btns tab-buttons clearfix">
                            <li data-tab="#prod-details" class="tab-btn active-btn">ویژگی ها</li>
                            <li data-tab="#prod-info" class="tab-btn">اطلاعات تکمیلی</li>
                            <li data-tab="#prod-reviews" class="tab-btn">
                                نظرات {{$product->comments()->where('approved' , '1')->count()}}</li>
                        </ul>

                        <!--Tabs Container-->
                        <div class="tabs-content">

                            <!--Tab / Active Tab-->
                            <div class="tab active-tab" id="prod-details">
                                <div class="content">
                                    <div class="row">
                                        @foreach($product->attributes as $attr)
                                            <table class="table table-striped">
                                                <tbody>
                                                <tr>
                                                    <td class="col-1"></td>
                                                    <th class="col-3 ">{{$attr->name}} :</th>
                                                    <td class="col-8"> {{\App\Attribute_value::find($attr->pivot->value_id)->value}}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!--Tab / Active Tab-->
                            <div class="tab" id="prod-info">
                                <div class="content">
                                    {!! $product->descrip !!}
                                </div>
                            </div>

                            <!--Tab-->
                            <div class="tab" id="prod-reviews">
                                <!--Reviews Container-->
                                <div class="reviews-container">

                                    <!--Review-->
                                    @foreach($product->comments()->where('approved' , '1')->where('parent_id' , null)->get() as $comment)
                                        <div class="review-box clearfix">
                                            <div class="rev-content">
                                                <div class="rev-header clearfix">
                                                    <h4>{{$comment->name}}</h4>
                                                    <div class="time">{{jdate($comment->created_at)->ago()}}</div>
                                                </div>
                                                <div class="rev-text">{{$comment->comment}}
                                                    @if($comment->child())
                                                        @foreach($comment->child()->where('approved' , '1')->get() as $child)
                                                            <div class="review-box clearfix">
                                                                <div class="rev-content">
                                                                    <div class="rev-header clearfix">
                                                                        <h4>{{$child->name}}</h4>

                                                                        <div
                                                                            class="time">{{jdate($child->created_at)->ago()}}</div>
                                                                    </div>
                                                                    <div class="rev-text">{{$child->comment}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                @endforeach
                                <!--Review-->


                                    <!--Add Review-->
                                    <div class="add-review">
                                        <h2>افزودن یک نظر </h2>

                                        <form method="post"
                                              action="{{route('comment')}}">
                                            @csrf
                                            <div class="row clearfix">
                                                <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                                    <input type="hidden" name="commentable_type"
                                                           value="{{get_class($product)}}">
                                                    <input type="hidden" name="commentable_id" value="{{$product->id}}">
                                                    <label> نام *</label>
                                                    <input type="text" name="name" value="" placeholder="" required>
                                                </div>
                                                <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                                    <label> ایمیل *</label>
                                                    <input type="email" name="email" value="" placeholder="" required>
                                                </div>
                                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                    <label>نظر شما </label>
                                                    <textarea name="comment"></textarea>
                                                </div>
                                                <div class="form-group text-right col-md-12 col-sm-12 col-xs-12">
                                                    <button type="submit" class="theme-btn btn-style-three"><span
                                                            class="txt"> افزودن نظر</span></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                            <!--End Tab-->

                        </div>
                    </div>

                </div>
                <!--End Product Info Tabs-->

            </div>

        </div>
    </section>


@endsection
