@extends('panel.layouts.master')
@section('title' , 'ایجاد دسته جدید')
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
                        <h1 class="m-0 text-dark">افزودن دسته جدید</h1>
                    </div>
                </div>


            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="card shadow-sm">

                    <div class="py-4 px-4 col-lg-10">

                        <form action="{{route('admin.categoryA.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 form-group">
                                    <label for="name">نام دسته </label>
                                    <input type="text" name="name"
                                           class="form-control @error('name') is-invalid @enderror "
                                           value="{{old('name')}}" id="name" placeholder="نام دسته" required>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label for="view_order">ترتیب نمایش </label>
                                    <input type="number" name="view_order"
                                           class="form-control @error('view_order') is-invalid @enderror "
                                           value="{{old('view_order')}}" id="name" placeholder="ترتیب نمایش" required>
                                    @error('view_order')
                                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label for="name">عکس بنر </label>
                                    <div class="input-group">
                                        <input type="text" id="thumbnail" class="form-control" name="image"
                                               value="{{old('image' )}}">
                                        <div class="input-group-append">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="button" id="lfm"
                                                        data-input="thumbnail" data-preview="holder">انتخاب
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if(request('parent'))
                                    @php
                                        $parent = \App\CategoryArticle::find(request('parent'));
                                    @endphp
                                    <div class="col-lg-6 form-group">
                                        <label for="name">نام دسته والد </label>
                                        <input type="text"
                                               class="form-control"
                                               value="{{$parent->name}}" disabled>
                                        <input type="hidden" name="parent" value="{{$parent->id}}">

                                    </div>


                                @endif


                                <div class="col-lg-12">
                                    <button class="btn btn-success" type="submit">ثبت</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>





@endsection
