@extends('panel.layouts.master')
@section( 'title','مدیریت کاربران')
@section('content')

<div class="content-wrapper">


    <div class="content-header">
        <div class="container-fluid px-4">
            <div class="row mb-2 d-flex flex-wrap justify-content-between">

                <h1 class="m-0 text-dark">مدیریت کاربران </h1>

                <div>
                    @can('create_user')
                    <a href="{{route('admin.user.create')}}" class="btn btn-sm btn-outline-primary p-2">افزودن کاربر جدید</a>
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
                            <input type="text" name="search" placeholder="جستجو براساس نام ،شماره تماس" class="form-control ml-2">
                        </div>

                        <div class="col-lg-4">
                            <button type="submit" class="btn  btn-outline-success ">جستجو</button>
                            @can('show_admin')
                            <a href="{{route('admin.user.index')}}?admin=1" class="btn btn-outline-secondary mr-2">
                                نمایش کاربران مدیر
                            </a>
                            @endcan
                        </div>

                    </div>
                </form>
               <div class="py-4 px-4 ">

                    <table class="table table-sm">
                        <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>نام و نام خانوادگی</th>
                            <th>شماره تماس</th>
                            <th> ایمیل</th>
                            <th>وضعیت ایمیل</th>
                            <th>ادرس</th>
                            <th>اقدامات</th>
                        </tr>
                        </thead>
                        <tbody>
                             @foreach($users as $user)
                                <tr>
                                    <td  class="text-align-center">{{$user->id}}</td>
                                    <td  class="text-align-center">{{$user->name}}</td>
                                    <td  class="text-align-center">{{$user->phone}}</td>
                                    <td  class="text-align-center">{{$user->email}}</td>
                                    @if($user->email_verified_at)
                                        <td><span class="badge badge-success">فعال</span></td>
                                    @else
                                        <td><span class="badge badge-danger">غیرفعال</span></td>
                                    @endif
                                    <td  class="text-align-center">{{$user->address}}</td>
                                    <td  class="text-align-center">
                                        <form method="post" action="{{route('admin.user.destroy' , $user->id)}}">
                                            @csrf
                                            @method('delete')
                                            @can('update_user')
                                            <a href="{{route('admin.user.edit' , $user->id)}}" class="btn btn-sm btn-success">ویرایش</a>
                                            @endcan
                                            @can('delete_user')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('آیا مایل به حذف هستید؟')"  title="حذف"
                                            >حذف</button>
                                            @endcan
                                            @can('permission_user')
                                            <a href="{{route('admin.user.permission' , $user->id)}}" class="btn btn-yellow btn-sm">دسترسی</a>
                                            @endcan
                                        </form>

                                    </td>
                                </tr>
                             @endforeach

                        </tbody>

                    </table>

               </div>
               <div class="card-footer">
                   {{$users->render()}}

               </div>

           </div>

        </div>
    </div>

</div>

@endsection
