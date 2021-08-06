@extends('panel.layouts.master')
@section( 'title',' مدیریت دسته بندی مقالات')
@section('content')

<div class="content-wrapper">


    <div class="content-header">
        <div class="container-fluid px-4">
            <div class="row mb-2 d-flex flex-wrap justify-content-between">

                <h1 class="m-0 text-dark">مدیریت دسته بندی مقالات </h1>

                <div>
                    @can('create_categroy_article')
                    <a href="{{route('admin.categoryA.create')}}" class="btn btn-sm btn-outline-primary p-2">افزودن دسته جدید</a>
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

                        <div class="col-lg-1">
                            <button type="submit" class="btn  btn-outline-success ">جستجو</button>

                        </div>

                </form>
               <a href="{{route('admin.categoryA.index')}}?delete=1" class="btn btn-outline-yellow">دسته های حذف شده</a>
               <a href="{{route('admin.categoryA.index')}}" class="btn btn-outline-blue mr-2">نمایش دسته ها</a>
           </div>
               <div class="py-4 px-4 ">

                    @include('panel.categoryarticle.categories-group', ['categories' => $categories])

               </div>
               <div class="card-footer">


               </div>

           </div>

        </div>
    </div>

</div>

@endsection
