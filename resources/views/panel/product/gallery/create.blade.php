@extends('panel.layouts.master')
@section('title' , ' ویرایش عکس')
@section('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>

        let createNewPic = ({ id }) => {
            return `
                    <div class="row image-field" id="image-${id}">
                        <div class="col-5">
                            <div class="form-group">
                                 <label>تصویر</label>
                                 <div class="input-group">
                                    <input type="text" id="thumbnail${id}" class="form-control image_label" name="images[${id}][image]"
                                           aria-label="Image" aria-describedby="button-image">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary button-image"    id="${id}" data-input="thumbnail${id}" type="button">انتخاب</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-group">
                                 <label>عنوان تصویر</label>
                                 <input type="text" name="images[${id}][alt]" class="form-control">
                            </div>
                        </div>
                         <div class="col-2">
                            <label >اقدامات</label>
                            <div>
                                <button type="button" class="btn btn-sm btn-warning" onclick="document.getElementById('image-${id}').remove()">حذف</button>
                            </div>
                        </div>
                    </div>
                `

             }
        $('#add_product_image').click(function() {
            let imagesSection = $('#images_section');
            let id = imagesSection.children().length;

            imagesSection.append(
                createNewPic({
                    id
                })
            );

        });
        $('#add_product_image').click();

        let image;
        $('body').on('click','.button-image' , (event) => {
            event.preventDefault();
            id = event.target.id
            image = $(event.target).closest('.image-field');

            {!! \File::get(public_path('/vendor/laravel-filemanager/js/stand-alone-button.js')) !!}

            $('#'+id).filemanager('image');
        });

        // set file link
        function fmSetLink($url) {
            image.find('.image_label').first().val($url);
        }
    </script>

<script>

</script>


@endsection
@section('content')


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

                    <form class="form-horizontal" action="{{ route('admin.gallery.store' , ['product' => $product->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">
                            {{--                        <h6>ویژگی محصول</h6>--}}
                            {{--                        <hr>--}}
                            <div id="images_section">

                            </div>
                            <button class="btn btn-sm btn-danger" type="button" id="add_product_image">تصویر جدید</button>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">ثبت تصاویر</button>
                            <a href="{{ route('admin.gallery.index' , ['product' => $product->id]) }}" class="btn btn-default float-left">لغو</a>
                        </div>
                        <!-- /.card-footer -->
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>


@endsection
