@extends('panel.layouts.master')
@section('title' , ' ویرایش عکس')
@section('content')
@section('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>

        $("#lfm").filemanager('image');

    </script>



@endsection

<div class="content-wrapper">


    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12">
                    <h1 class="m-0 text-dark">ویرایش عکس  </h1>
                </div>
            </div>


        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="card shadow-sm">

                <div class="py-4 px-4 col-lg-10">

                    <form action="{{route('admin.gallery.update' , ['product' => $product->id , 'gallery' => $gallery->id]  )}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <div class="card-body">
                            <div class="row image-field" id="image">
                                <div class="col-5">
                                    <div class="form-group">
                                        <label>تصویر</label>
                                        <div class="input-group">
                                            <input type="text" value="{{$gallery->image}}" id="thumbnail" class="form-control image_label"
                                                   name="image"
                                                   aria-label="Image" aria-describedby="button-image">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary button-image"
                                                        data-input="thumbnail" id="lfm" data-preview="holder"
                                                        type="button">انتخاب
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="form-group">
                                        <label>عنوان تصویر</label>
                                        <input type="text" value="{{$gallery->alt}}" name="alt" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">ویرایش تصویر </button>
                                <a href="{{ route('admin.gallery.index' , ['product' => $product->id]) }}"
                                   class="btn btn-default float-left">لغو</a>
                            </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>


@endsection
