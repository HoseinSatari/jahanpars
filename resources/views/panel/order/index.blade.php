@extends('panel.layouts.master')
@section( 'title','مدیریت سفارشات')
@section('content')

    <div class="content-wrapper">


        <div class="content-header">
            <div class="container-fluid px-4">
                <div class="row mb-2 d-flex flex-wrap justify-content-between">

                    <h1 class="m-0 text-dark">مدیریت سفارشات </h1>

                    <div>
                        <a href="{{route('admin.panel')}}" class="btn btn-sm btn-outline-secondary p-2">بازگشت</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="card shadow-sm">
                    <form action="" method="get">

                        <div class="row py-2">
                            <div class="col-lg-3 mr-2">
                                <input type="hidden" name="type" value="{{ request('type') }}">
                                <input type="text" name="search" placeholder="جستجو براساس نام ،شماره مرسوله ,کد , نام سفارش دهنده" class="form-control ml-2">
                            </div>

                            <div class="col-lg-8">
                                <button type="submit" class="btn  btn-outline-success  ">جستجو</button>
                            </div>

                        </div>
                    </form>
                    <div class="py-4 px-4 ">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <th>کد سفارش</th>
                                    <th>نام کاربر</th>
                                    <th>شماره تماس </th>
                                    <th>هزینه سفارش</th>
                                    <th> تخفیف</th>
                                    <th>وضعیت سفارش</th>
                                    <th>شماره پیگیری پستی</th>
                                    <th>زمان ثبت سفارش</th>
                                    <th>اقدامات</th>
                                </tr>

                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order->code }}</td>
                                        <td>{{ $order->user->name }}</td>
                                        <td><i class="badge badge-light">{{ $order->user->phone }}</i></td>
                                        <td><i class="badge badge-gold">{{ number_format($order->price) }} تومان</i></td>
                                        <td>@if($ord = $order->discount()->first())  <i class="badge badge-blue">{{$ord->value}} {{$ord->type == 'Percen' ? 'درصد' : 'تومان'}} - {{$ord->code}} </i> @else <i class="badge badge-danger">تخفیف ندارد</i> @endif</td>
                                        <td>{{ $order->statuss() }}</td>
                                        <td>@if($order->tracking_serial) <i class="badge badge-dark">{{$order->tracking_serial}}</i>   @else  <i class="badge badge-danger">ثبت نشده</i>  @endif</td>
                                        <td>{{ jdate($order->created_at)->ago() }}</td>
                                        <td class="d-flex">
                                            @can('product_order')
                                            <a href="{{ route('admin.orders.show' , $order->id) }}" class="btn btn-sm btn-warning  ml-1">مشاهده جزئیات سفارش</a>
                                            @endcan
                                            @if($order->status != 'cancel')
                                            @can('update_order')
                                            <a href="{{ route('admin.orders.edit' , $order->id) }}" class="btn btn-sm btn-primary  ml-1">ویرایش سفارش</a>
                                                @endcan
                                                @endif
                                                @if($order->status == 'cancel')
                                                @can('delete_order')
                                            <form action="{{ route('admin.orders.destroy' , $order->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger ml-1">حذف</button>
                                            </form>
                                                @endcan
                                                @endif
                                                @if($order->status != 'cancel')
                                            @can('cancel_order')
                                                    <form action="{{route('admin.order.cancel' , $order->id)}}" method="POST">
                                                        @csrf
                                                        @method('put')
                                                        <button type="submit" onclick="return confirm('آیا مطمعن هستید؟')" class="btn btn-sm btn-danger">لغو سفارش</button>
                                                    </form>
                                                @endcan
                                                    @endif
                                        </td>
                                    </tr>
                                @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{$orders->render()}}

                    </div>

                </div>

            </div>
        </div>

    </div>

@endsection
