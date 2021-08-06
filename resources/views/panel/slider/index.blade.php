@extends('panel.layouts.master')
@section( 'title','مدیریت اسلایدر')
@section('content')

<div class="content-wrapper">


    <div class="content-header">
        <div class="container-fluid px-4">
            <div class="row mb-2 d-flex flex-wrap justify-content-between">

                <h1 class="m-0 text-dark">مدیریت اسلایدر </h1>

                <div>
                    @can('create_slider')
                    <a href="{{route('admin.slider.create')}}" class="btn btn-sm btn-outline-primary p-2">افزودن اسلاید جدید</a>
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
                            <input type="text" name="search" placeholder="جستجو براساس عنوان ، عنوان فرعی متن " class="form-control ml-2">
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
                            <th>عکس</th>
                            <th>عنوان فرعی</th>
                            <th>عنوان </th>
                            <th> متن</th>
                            <th>  نمایش</th>
                            <th>لینک </th>
                            <th>اقدامات</th>
                        </tr>
                        </thead>
                        <tbody>
                             @foreach($sliders as $slid)
                                <tr>
                                    <td  class="text-align-center">{{$loop->index}}</td>
                                    <td  class="text-align-center"><img src="{{$slid->image}}" class="rounded-circle" width="75" height="75" alt=""></td>
                                    <td  class="text-align-center">{{$slid->subtitle}}</td>
                                    <td  class="text-align-center">{{$slid->title}}</td>
                                    <td  class="text-align-center">{{$slid->body}}</td>
                                    <td  class="text-align-center"><i class="badge badge-info">{{$slid->order}}</i></td>
                                    <td  class="text-align-center"><a href="{{$slid->link}}">{{$slid->link}}</a></td>
                                    <td  class="text-align-center">
                                        <form method="post" action="{{route('admin.slider.destroy' , $slid->id)}}">
                                            @csrf
                                            @method('delete')
                                            @can('update_slider')
                                            <a href="{{route('admin.slider.edit' , $slid->id)}}" class="btn btn-sm btn-success">ویرایش</a>
                                            @endcan
                                            @can('delete_slider')
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
                   {{$sliders->render()}}

               </div>

           </div>

        </div>
    </div>

</div>

@endsection
