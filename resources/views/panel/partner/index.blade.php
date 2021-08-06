@extends('panel.layouts.master')
@section( 'title','مدیریت کارمندان')
@section('content')

    <div class="content-wrapper">


        <div class="content-header">
            <div class="container-fluid px-4">
                <div class="row mb-2 d-flex flex-wrap justify-content-between">

                    <h1 class="m-0 text-dark">مدیریت کارمندان </h1>

                    <div>
                        @can('create_partner')
                            <a href="{{route('admin.partners.create')}}" class="btn btn-sm btn-outline-primary p-2">افزودن
                                کارمند جدید</a>
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
                                <input type="text" name="search" placeholder="جستجو براساس نام ،شماره تماس"
                                       class="form-control ml-2">
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
                                <th> عکس</th>
                                <th>نام و نام خانوادگی</th>
                                <th>شماره تماس</th>
                                <th>سِمَت</th>
                                <th>اقدامات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($partners as $partner)
                                <tr>
                                    <td class="text-align-center">{{$loop->index}}</td>
                                    <td class="text-align-center"><img src="{{$partner->image}}"
                                                                       class="rounded-circle"
                                                                       alt="{{$partner->name}}" width="75px"
                                                                       height="75px"></td>
                                    <td class="text-align-center">{{$partner->name}}</td>
                                    <td class="text-align-center">{{$partner->phone}}</td>
                                    <td class="text-align-center">{{$partner->jobe}}</td>
                                    <td class="text-align-center">
                                        <form method="post" action="{{route('admin.partners.destroy' , $partner->id)}}">
                                            @csrf
                                            @method('delete')
                                            @can('update_partner')
                                                <a href="{{route('admin.partners.edit' , $partner->id)}}"
                                                   class="btn btn-sm btn-success">ویرایش</a>
                                            @endcan
                                            @can('delete_partner')
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
                        {{$partners->render()}}

                    </div>

                </div>

            </div>
        </div>

    </div>

@endsection
