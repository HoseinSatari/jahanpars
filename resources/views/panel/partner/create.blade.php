@extends('panel.layouts.master')
@section('title' , 'ایجاد کارمند')
@section('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    $('#lfm').filemanager('image');
</script>
    @endsection
@section('content')

    <div class="content-wrapper">


        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-12">
                        <h1 class="m-0 text-dark">افزودن کارمند جدید</h1>
                    </div>
                </div>


            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="card shadow-sm">

                    <div class="py-4 px-4 col-lg-10">


                        <form action="{{route('admin.partners.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 form-group">
                                    <label for="name">نام و نام خانوادگی</label>
                                    <input type="text" name="name"
                                           class="form-control @error('name') is-invalid @enderror "
                                           value="{{old('name')}}" id="name" placeholder="نام و نام خانوادگی ">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label for="phone">شماره تماس</label>
                                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror " id="phone"
                                           value="{{old('phone')}}" placeholder="شماره تماس را وارد کنید ">
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label for="jobe">سِمَت </label>
                                    <input type="text" name="jobe" class="form-control @error('jobe') is-invalid @enderror " id="jobe"
                                           value="{{old('email')}}" placeholder="شغل را وارد کنید ">
                                    @error('jobe')
                                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                                    @enderror
                                </div>

                                <div class="form-group col-lg-6" >
                                    <label class="col-sm-5 control-label " >تصویر شاخص</label>
                                    <div class="input-group">
                                        <input type="text" id="thumbnail" class="form-control" name="image">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" id="lfm" data-input="thumbnail" data-preview="holder">انتخاب</button>
                                        </div>
                                    </div>
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
