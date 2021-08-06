@extends('panel.layouts.master')
@section( 'title','مدیریت محصولات')
@section('content')

    <div class="content-wrapper">


        <div class="content-header">
            <div class="container-fluid px-4">
                <div class="row mb-2 d-flex flex-wrap justify-content-between">

                    <h1 class="m-0 text-dark">مدیریت محصولات </h1>

                    <div>
                        @can('create_product')
                            <a href="{{route('admin.product.create')}}" class="btn btn-sm btn-outline-primary p-2">افزودن
                                محصولات جدید</a>
                        @endcan

                        <a href="{{route('admin.panel')}}" class="btn btn-sm btn-outline-secondary p-2">بازگشت</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="card shadow-sm">
                    <form action="" method="get" id="inv">
                        <input type="hidden" name="inventory" value="1">
                    </form>
                    <form action="" method="get" id="active">
                        <input type="hidden" name="product" value="2">
                    </form>
                    <form action="" method="get" id="deactive">
                        <input type="hidden" name="product" value="1">
                    </form>
                    <form action="" method="get" id="visit">
                        <input type="hidden" name="visit" value="1">
                    </form>
                    <form action="" method="get" id="sell">
                        <input type="hidden" name="sell" value="1">
                    </form>
                    <form action="" method="get" id="gran">
                        <input type="hidden" name="gran" value="1">
                    </form>
                    <form action="" method="get" id="arzn">
                        <input type="hidden" name="arzn" value="1">
                    </form>

                    <form action="" method="get">

                        <div class="row py-2">
                            <div class="col-lg-3 mr-2">
                                <input type="text" name="search"
                                       placeholder="جستجو براساس نام ،توضیحات , نام سازنده کالا , دسته بندی"
                                       class="form-control ml-2">
                            </div>

                            <div class="col-lg-8">
                                <button type="submit" class="btn  btn-outline-success  ">جستجو</button>
                                <button class="btn btn-outline-danger "
                                        onclick="event.preventDefault(); document.getElementById('inv').submit()">کالا
                                    های رو به اتمام
                                </button>
                                <button class="btn btn-outline-gold "
                                        onclick="event.preventDefault(); document.getElementById('active').submit()">
                                    کالا های فعال
                                </button>
                                <button class="btn btn-outline-dark "
                                        onclick="event.preventDefault(); document.getElementById('deactive').submit()">
                                    کالا های غیرفعال
                                </button>
                                <button class="btn btn-outline-blue "
                                        onclick="event.preventDefault(); document.getElementById('visit').submit()">کالا
                                    های پربازدید
                                </button>
                                <button class="btn btn-outline-indigo "
                                        onclick="event.preventDefault(); document.getElementById('sell').submit()">کالا
                                    های پرفروش
                                </button>
                                <button class="btn btn-outline-indigo "
                                        onclick="event.preventDefault(); document.getElementById('gran').submit()">
                                    گرانترین
                                </button>
                                <button class="btn btn-outline-indigo "
                                        onclick="event.preventDefault(); document.getElementById('arzn').submit()">
                                    ارزانترین
                                </button>
                            </div>

                        </div>
                    </form>
                    <div class="py-4 px-4 ">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>عکس</th>
                                    <th>نام ایجاد کننده</th>
                                    <th>نام محصول</th>
                                    <th>توضیحات</th>
                                    <th> مبلغ</th>
                                    <th>موجودی</th>
                                    <th>تعداد بازدید</th>
                                    <th>تعداد بازدیدکنندگان</th>
                                    <th>تعداد خرید</th>
                                    <th>تعداد خریداران</th>
                                    <th>اقدامات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($products->count())
                                    @foreach($products as $product)
                                        <tr>
                                            <td class="text-align-center">{{$loop->index}}</td>
                                            <td class="text-align-center"><img src="{{$product->image}}"
                                                                               class="rounded-circle"
                                                                               alt="{{$product->title}}" width="75px"
                                                                               height="75px"></td>
                                            <td class="text-align-center">{{$product->user->name}}</td>
                                            <td class="text-align-center"><a href="{{route('single' , $product->slug)}}">{{$product->title}}</a></td>
                                            <td class="text-align-center">{{$product->short_descrip}}</td>
                                            <td class="text-align-center"><i class="badge badge-gold">{{number_format($product->price)}}</i></td>
                                            <td class="text-align-center">
                                                @if($product->inventory <= '3')
                                                    <i class="badge badge-danger"> {{$product->inventory}}</i>
                                                @else
                                                    <i class="badge badge-indigo"> {{$product->inventory}}</i>
                                                @endif
                                            </td>
                                            <td class="text-align-center"><i
                                                    class="badge badge-info">{{$product->visitor()}}</i></td>
                                            <td class="text-align-center"><i
                                                    class="badge badge-info">{{$product->visit()->count()}}</i></td>
                                            <td class="text-align-center"><i
                                                    class="badge badge-success">{{$product->order->sum(function ($item){ return $item->pivot->quantity;} )}}</i>
                                            </td>
                                            <td class="text-align-center"><i
                                                    class="badge badge-success">{{$product->order->count() }}</i></td>

                                            <td class="text-align-center">
                                                <form method="post"
                                                      action="{{route('admin.product.destroy' , $product->id)}}">
                                                    @csrf
                                                    @method('delete')
                                                    @can('update_product')
                                                        <a href="{{route('admin.product.edit' , $product->id)}}"
                                                           class="btn btn-sm btn-success">ویرایش</a>
                                                    @endcan
                                                    @can('delete_product')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('آیا مایل به حذف هستید؟')"
                                                                title="حذف"
                                                        >حذف
                                                        </button>
                                                    @endcan
                                                    @can('show_gallery')
                                                        <a href="{{route('admin.gallery.index' , ['product' => $product->id])}}"
                                                           class="btn btn-sm btn-warning">گالری محصول</a>
                                                    @endcan
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach

                                @else
                                    <td colspan="8"><p class="col-12" style="text-align: center; font-size: 20px">محصولی
                                            ثبت نشده است. </p></td>
                                @endif

                                </tbody>

                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{$products->render()}}

                    </div>

                </div>

            </div>
        </div>

    </div>

@endsection
