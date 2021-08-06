@extends('panel.layouts.master')
@section( 'title','مدیریت تخفیفات')
@section('content')

<div class="content-wrapper">


    <div class="content-header">
        <div class="container-fluid px-4">
            <div class="row mb-2 d-flex flex-wrap justify-content-between">

                <h1 class="m-0 text-dark">مدیریت تخفیفات </h1>

                <div>
                    @can('create_discount')
                    <a href="{{route('admin.discount.create')}}" class="btn btn-sm btn-outline-primary p-2">افزودن تخفیف جدید</a>
                    @endcan

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
                            <input type="text" name="search" placeholder="جستجو براساس کد " class="form-control ml-2">
                        </div>

                        <div class="col-lg-4">
                            <button type="submit" class="btn  btn-outline-success ">جستجو</button>
                        </div>

                    </div>
                </form>
               <div class="py-4 px-4 ">

                    <table class="table table-sm">
                        <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>کد تخفیف</th>
                            <th> مقدار</th>
                            <th> نوع</th>
                            <th> وضعیت </th>
                            <th>تاریخ اتمام</th>
                            <th>اقدامات</th>
                        </tr>
                        </thead>
                        <tbody>
                             @foreach($discounts as $discount)

                                <tr>
                                    <td  class="text-align-center">{{$loop->index}}</td>
                                    <td  class="text-align-center">{{$discount->code}}</td>
                                    <td  class="text-align-center">{{$discount->value}}</td>
                                    <td  class="text-align-center">{{$discount->type == 'int' ? 'تومان' : 'درصد'}}</td>
                                    <td  class="text-align-center">{{$discount->expired_at > now() ? 'فعال' : 'غیرفعال '}}</td>
                                    <td  class="text-align-center">{{jdate($discount->expired_at)->format('Y-m-d') }}</td>
                                    <td  class="text-align-center">
                                        <form method="post" action="{{route('admin.discount.destroy' , $discount->id)}}">
                                            @csrf
                                            @method('delete')
                                            @can('update_discount')
                                            <a href="{{route('admin.discount.edit' , $discount->id)}}" class="btn btn-sm btn-success">ویرایش</a>
                                            @endcan
                                            @can('delete_discount')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('آیا مایل به حذف هستید؟')"  title="حذف"
                                            >حذف</button>
                                            @endcan
                                        </form>

                                    </td>
                                </tr>
                             @endforeach

                        </tbody>

                    </table>

               </div>
               <div class="card-footer">
                   {{$discounts->render()}}

               </div>

           </div>

        </div>
    </div>

</div>

@endsection
