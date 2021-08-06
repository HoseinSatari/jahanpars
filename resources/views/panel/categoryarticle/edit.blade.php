@extends('panel.layouts.master')
@section('title' , "ویرایش دسته - {$category->name}")
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
                <h1 class="m-0 text-dark">ویرایش دسته  {{$category->name}}</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="card shadow-sm">

                <div class="py-4 px-4 col-lg-10">
               <form action="{{route('admin.categoryA.update' , $category->id)}}" method="post" enctype="multipart/form-data">
                   @csrf
                   @method('put')
                   <div class="row">
                       <div class="col-lg-6 form-group">
                           <label for="name">نام دسته </label>
                           <input type="text" name="name"
                                  class="form-control @error('name') is-invalid @enderror "
                                  value="{{old('name' , $category->name)}}" id="name" placeholder="نام دسته   ">
                           @error('name')
                           <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                           @enderror
                       </div>

                       <div class="col-lg-6 form-group">
                           <label for="inputEmail3" class="col-sm-2 control-label">دسته مرتبط</label>
                           <select class="form-control" name="parent" id="permissions">
                               <option value="0">دسته اصلی</option>
                               @foreach(\App\CategoryArticle::all() as $cate)
                                   @if($category->id != $cate->id)
                                   <option value="{{ $cate->id }}" {{ $cate->id === $category->parent ? 'selected' : ''  }}>{{ $cate->name }}</option>
                                   @endif
                               @endforeach
                           </select>
                       </div>

                       <div class="col-lg-6 form-group">
                           <label for="view_order">ترتیب نمایش   </label>
                           <input type="number" name="view_order"
                                  class="form-control @error('view_order') is-invalid @enderror "
                                  value="{{old('view_order' , $category->view_order)}}" id="name" placeholder="ترتیب نمایش" required>
                           @error('view_order')
                           <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                           @enderror
                       </div>
                       <div class="col-lg-6 form-group">
                           <label for="name">عکس دسته (اختیاری) </label>
                           <div class="input-group">
                               <input type="text" id="thumbnail" class="form-control" name="image"
                                      value="{{old('image' ,$category->image )}}">
                               <div class="input-group-append">
                                   <div class="input-group-append">
                                       <button class="btn btn-outline-secondary" type="button" id="lfm"
                                               data-input="thumbnail" data-preview="holder">انتخاب
                                       </button>
                                   </div>
                               </div>
                           </div>
                       </div>

                       <div class="col-lg-12">
                           <button class="btn btn-success" type="submit">ویرایش </button>
                       </div>
                   </div>
               </form>
                </div>
            </div>
           </div>
        </div>


</div>

@endsection
