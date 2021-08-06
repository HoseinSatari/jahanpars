@extends('panel.layouts.master')
@section( 'title','مدیریت گالری')
@section('content')

    <div class="content-wrapper">


        <div class="content-header">
            <div class="container-fluid px-4">
                <div class="row mb-2 d-flex flex-wrap justify-content-between">

                    <h1 class="m-0 text-dark">مدیریت گالری </h1>

                    <div>
                        @can('create_gallery')
                            <a href="{{route('admin.gallery.create' , ['product' => $product->id])}}" class="btn btn-sm btn-outline-primary p-2">افزودن عکس جدید</a>
                        @endcan

                        <a href="{{route('admin.panel')}}" class="btn btn-sm btn-outline-secondary p-2">بازگشت</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">تصاویر</h3>


                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    @if($images->count())
                                    @foreach($images as $image)
                                        <div class="col-sm-2">
                                            <a href="{{ url($image['image']) }}">
                                                <img src="{{ url($image['image']) }}" class="img-fluid mb-2" alt="{{ url($image['alt']) }}">
                                            </a>

                                            <form action="{{ route('admin.gallery.destroy' , ['product' => $product->id , 'gallery' => $image->id]) }}" id="image-{{ $image->id }}" method="post">
                                                @method('delete')
                                                @csrf
                                            </form>
                                           @can('update_gallery')
                                            <a href="{{ route('admin.gallery.edit' , ['product' => $product->id , 'gallery' => $image->id]) }}" class="btn btn-sm btn-primary">ویرایش</a>
                                            @endcan
                                            @can('delete_gallery')
                                            <a href="#" class="btn btn-sm btn-danger" onclick="document.getElementById('image-{{ $image->id }}').submit()">حذف</a>
                                            @endcan
                                        </div>
                                    @endforeach
                                    @else
                                        <p class="col-12" style="text-align: center; font-size: 20px">عکسی برای گالری محصول ثبت نشده است.  </p>
                                    @endif
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                {{ $images->render() }}
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection
