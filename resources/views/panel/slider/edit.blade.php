@extends('panel.layouts.master')
@section('title' , "ویرایش اسلاید")
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
                <h1 class="m-0 text-dark">ویرایش اسلاید</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
           <div class="card shadow-sm p-2">
               <div class="py-4 px-4 col-lg-10">
               <form action="{{route('admin.slider.update' , $slider->id)}}" method="post" enctype="multipart/form-data">
                   @csrf
                   @method('put')

                   <div class="row">
                       <div class="col-lg-6 form-group">
                           <label for="name">عنوان فرعی </label>
                           <input type="text" name="subtitle"
                                  class="form-control @error('subtitle') is-invalid @enderror "
                                  value="{{old('subtitle' , $slider->subtitle)}}" id="name" placeholder="عنوان فرعی ">
                           @error('subtitle')
                           <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                           @enderror
                       </div>
                       <div class="col-lg-6 form-group">
                           <label for="name">عنوان </label>
                           <input type="text" name="title"
                                  class="form-control @error('title') is-invalid @enderror "
                                  value="{{old('title' , $slider->title)}}" id="name" placeholder="عنوان  ">
                           @error('title')
                           <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                           @enderror
                       </div>
                       <div class="col-lg-6 form-group">
                           <label for="name">متن </label>
                           <input type="text" name="body"
                                  class="form-control @error('body') is-invalid @enderror "
                                  value="{{old('body' ,$slider->body)}}" id="name" placeholder="متن  ">
                           @error('body')
                           <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                           @enderror
                       </div>

                       <div class="col-lg-6 form-group">
                           <label for="name">عکس اسلاید (برای نمایش صحیح عرض را روی 1920 و ارتفاع 1000 بگذارید)</label>
                           <div class="input-group">
                               <input type="text" id="thumbnail" class="form-control" name="image" value="{{old('image' , $slider->image)}}">
                               <div class="input-group-append">
                                   <div class="input-group-append">
                                       <button class="btn btn-outline-secondary" type="button" id="lfm" data-input="thumbnail" data-preview="holder">انتخاب</button>
                                   </div>
                               </div>
                           </div>
                       </div>

                       <div class="col-lg-6 form-group">
                           <label for="name">متن دکمه (اختیاری) </label>
                           <input type="text" name="button"
                                  class="form-control @error('button') is-invalid @enderror "
                                  value="{{old('button' , $slider->button)}}" id="name" placeholder="متن دکمه ">
                           @error('button')
                           <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                           @enderror
                       </div>

                       <div class="col-lg-6 form-group">
                           <label for="name">لینک (اختیاری) </label>
                           <input type="text" name="link"
                                  class="form-control @error('link') is-invalid @enderror "
                                  value="{{old('link' , $slider->link)}}" id="name" placeholder="https://jahan-pars.ir/product/1 ">
                           @error('link')
                           <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                           @enderror
                       </div>
                       <div class="col-lg-6 form-group">
                           <label for="name">ترتیب نمایش  </label>
                           <input type="number" name="order"
                                  class="form-control @error('order') is-invalid @enderror "
                                  value="{{old('order')}}" id="name" placeholder="ترتیب نمایش">
                           @error('order')
                           <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                           @enderror
                       </div>

                       <div class="col-lg-12 form-group p-2">
                           <input type="checkbox" class="is_active" name="is_active" id="is_active" @if(!$slider->is_active) checked @endif>
                           <label for="is_active">اسلاید غیرفعال باشد  </label>
                       </div>

                       <div class="col-lg-12">
                           <button class="btn btn-success" type="submit">ویرایش اسلاید</button>
                       </div>
                   </div>

               </form>
               </div>
           </div>
        </div>
    </div>

</div>

@endsection
