@extends('panel.layouts.master')
@section('title' , 'ایجاد شرکت')
@section('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="/js/ckeditor/ckeditor.js"></script>
<script>

    var options = {
        filebrowserImageBrowseUrl: '/admin/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/admin/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
        filebrowserBrowseUrl: '/admin/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/admin/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
    };

    CKEDITOR.replace('descrip', options);
    $('#lfm').filemanager('image');
</script>
    @endsection
@section('content')

    <div class="content-wrapper">


        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-12">
                        <h1 class="m-0 text-dark">افزودن شرکت جدید</h1>
                    </div>
                </div>


            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="card shadow-sm">

                    <div class="py-4 px-4 col-lg-10">


                        <form action="{{route('admin.companys.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-10 form-group">
                                    <label for="name">عنوان</label>
                                    <input type="text" name="title"
                                           class="form-control @error('title') is-invalid @enderror "
                                           value="{{old('title')}}" id="name" placeholder="عنوان ">
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-10">
                                    <label for="inputEmail2" class="col-sm-3 control-label">توضیح کوتاه درباره شرکت</label>
                                    <textarea class="form-control @error('short_text') is-invalid @enderror" name="short_text"
                                              id="short_descrip" cols="30"
                                              rows="4">{{ old('short_text') }}</textarea>
                                    @error('short_text')
                                    <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-10">
                                    <label for="inputEmail3" class="col-sm-2 control-label">توضیحات</label>
                                    <textarea class="form-control @error('text') is-invalid @enderror" name="text"
                                              id="descrip" cols="30"
                                              rows="10">{{ old('text') }}</textarea>
                                    @error('text')
                                    <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-lg-10" >
                                    <label class="col-sm-5 control-label " >تصویر شاخص</label>
                                    <div class="input-group">
                                        <input type="text" id="thumbnail" class="form-control" name="image">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" id="lfm" data-input="thumbnail" data-preview="holder">انتخاب</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-lg-10">
                                    <label for="inputEmail2" class="col-sm-3 control-label">کلمات کلیدی</label>
                                    <textarea class="form-control @error('keyword') is-invalid @enderror" name="keyword"
                                              id="short_descrip" cols="30"
                                              rows="4">{{ old('keyword') }}</textarea>
                                    @error('keyword')
                                    <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-12 form-group p-2">
                                    <input type="checkbox" class="is_active" name="deactive" id="is_active">
                                    <label for="is_active">شرکت غیر فعال باشد </label>
                                </div>
                                <div class="col-lg-12">
                                    <button class="btn btn-success" type="submit">ثبت </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>





@endsection
