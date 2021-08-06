@extends('panel.layouts.master')
@section( 'title','مدیریت شرکت ها')
@section('content')

    <div class="content-wrapper">


        <div class="content-header">
            <div class="container-fluid px-4">
                <div class="row mb-2 d-flex flex-wrap justify-content-between">

                    <h1 class="m-0 text-dark">مدیریت شرکت ها </h1>

                    <div>
                        @can('create_company')
                            <a href="{{route('admin.companys.create')}}" class="btn btn-sm btn-outline-primary p-2">افزودن
                                شرکت جدید</a>
                        @endcan

                        <a href="{{route('admin.panel')}}" class="btn btn-sm btn-outline-secondary p-2">بازگشت</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="card shadow-sm">

                    <form action="" method="get" id="active">
                        <input type="hidden" name="active" value="1">
                    </form>
                    <form action="" method="get" id="deactive">
                        <input type="hidden" name="deactive" value="1">
                    </form>
                    <form action="" method="get">


                        <div class="row py-2">
                            <div class="col-lg-3 mr-2">
                                <input type="text" name="search" placeholder=" جستجو براساس عنوان ، متن , سازنده"
                                       class="form-control ml-2">
                            </div>

                            <div class="col-lg-4">
                                <button type="submit" class="btn  btn-outline-success ">جستجو</button>
                                <button class="btn btn-outline-indigo "
                                        onclick="event.preventDefault(); document.getElementById('active').submit()">
                                    شرکت های فعال
                                </button>
                                <button class="btn btn-outline-indigo "
                                        onclick="event.preventDefault(); document.getElementById('deactive').submit()">
                                    شرکت های غیرفعال
                                </button>
                            </div>

                        </div>
                    </form>
                    <div class="py-4 px-4 ">

                        <table class="table table-sm">
                            <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th> عکس</th>
                                <th>نام سازنده</th>
                                <th>عنوان </th>
                                <th>متن کوتاه</th>
                                <th>وضعیت </th>
                                <th>بازدید </th>
                                <th>بازدیدکنندگان </th>
                                <th>اقدامات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($companys as $company)
                                <tr>
                                    <td class="text-align-center">{{$loop->index}}</td>
                                    <td class="text-align-center"><img src="{{$company->image}}"
                                                                       class="rounded-circle"
                                                                       alt="{{$company->title}}" width="75px"
                                                                       height="75px"></td>
                                    <td class="text-align-center">{{$company->user->name}}</td>
                                    <td class="text-align-center">{{$company->title}}</td>
                                    <td class="text-align-center">{{$company->short_text}}</td>
                                    <td class="text-align-center">@if($company->is_active) <i class="badge badge-success">فعال</i>   @else  <i class="badge badge-danger">غیرفعال</i>  @endif</td>
                                    <td class="text-align-center"><i class="badge badge-success">{{$company->visitor()}}</i></td>
                                    <td class="text-align-center"><i class="badge badge-success">{{$company->visit()->count()}}</i></td>
                                    <td class="text-align-center">
                                        <form method="post" action="{{route('admin.companys.destroy' , $company->id)}}">
                                            @csrf
                                            @method('delete')
                                            @can('update_company')
                                                <a href="{{route('admin.companys.edit' , $company->id)}}"
                                                   class="btn btn-sm btn-success">ویرایش</a>
                                            @endcan
                                            @can('delete_company')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('آیا مایل به حذف هستید؟')" title="حذف"
                                                >حذف
                                                </button>
                                            @endcan
                                        </form>

                                    </td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>

                    </div>
                    <div class="card-footer">
                        {{$companys->render()}}

                    </div>

                </div>

            </div>
        </div>

    </div>

@endsection
