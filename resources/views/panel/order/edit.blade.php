@extends('panel.layouts.master')
@section('title' , "ویرایش سفارش")

@section('content')

    <div class="content-wrapper">


        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-12">
                        <h1 class="m-0 text-dark"> ویرایش سفارش</h1>
                    </div>
                </div>


            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="card shadow-sm">

                    <div class="py-4 px-4 col-lg-10">

                        <form class="form-horizontal" action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">شماره سفارش</label>
                                    <input type="text" class="form-control" id="inputEmail3" value="{{ $order->id }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">هزینه سفارش</label>
                                    <input type="number" class="form-control" value="{{$order->price}}" id="inputEmail3" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">وضعیت سفارش</label>
                                    <select name="status" class="form-control">
                                        <option value="unpaid" {{ old('status' , $order->status) == 'unpaid' ? 'selected' : '' }}>پرداخت نشده</option>
                                        <option value="paid" {{ old('status' , $order->status) == 'paid' ? 'selected' : '' }}>پرداخت شده</option>
                                        <option value="prepartion" {{ old('status' , $order->status) == 'prepartion' ? 'selected' : '' }}>در حال پردازش</option>
                                        <option value="posted" {{ old('status' , $order->status) == 'posted' ? 'selected' : '' }}>ارسال شد</option>
                                        <option value="recived" {{ old('status' , $order->status) == 'recived' ? 'selected' : '' }}>دریافت شد</option>
                                        <option value="cancel" {{ old('status' , $order->status) == 'cancel' ? 'selected' : '' }}>کنسل شده</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">کد پیگیری</label>
                                    <input type="text" name="tracking_serial" class="form-control" id="inputPassword3" placeholder="کد پیگیری را وارد کنید" value="{{ old('tracking_serial', $order->tracking_serial )}}">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">ویرایش سفارش</button>
                                <a href="{{ route('admin.orders.index') }}" class="btn btn-default float-left">لغو</a>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
