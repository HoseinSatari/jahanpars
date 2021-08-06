@extends('panel.layouts.master')
@section('title' , "ویرایش شرکت - {$company->name}")
@section('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="/js/ckeditor/ckeditor.js"></script>
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
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
                <h1 class="m-0 text-dark">ویرایش اطلاعات  {{$company->name}}</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
           <div class="card shadow-sm p-2">
               <form action="{{route('admin.companys.update' , $company->id)}}" method="post" enctype="multipart/form-data">
                   @csrf
                   @method('put')
                   <div class="row">
                       <div class="col-lg-10 form-group">
                           <label for="name">عنوان</label>
                           <input type="text" name="title"
                                  class="form-control @error('title') is-invalid @enderror "
                                  value="{{old('title' , $company->title)}}" id="name" placeholder="عنوان ">
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
                                     rows="4">{{ old('short_text' , $company->short_text) }}</textarea>
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
                                     rows="10">{{ old('text' , $company->text) }}</textarea>
                           @error('text')
                           <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                           @enderror
                       </div>

                       <div class="form-group col-lg-10" >
                           <label class="col-sm-5 control-label " >تصویر شاخص</label>
                           <div class="input-group">
                               <input type="text" id="thumbnail" value="{{$company->image}}" class="form-control" name="image">
                               <div class="input-group-append">
                                   <button class="btn btn-outline-secondary" type="button" id="lfm" data-input="thumbnail" data-preview="holder">انتخاب</button>
                               </div>
                           </div>
                       </div>

                       <div class="form-group col-lg-10">
                           <label for="inputEmail2" class="col-sm-3 control-label">کلمات کلیدی</label>
                           <textarea class="form-control @error('keyword') is-invalid @enderror" name="keyword"
                                     id="short_descrip" cols="30"
                                     rows="4">{{ old('keyword' , $company->keyword) }}</textarea>
                           @error('keyword')
                           <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                           @enderror
                       </div>
                       <div class="col-lg-12 form-group p-2">
                           <input type="checkbox" class="is_active" name="deactive" id="is_active" @if(!$company->is_active) checked @endif>
                           <label for="is_active">شرکت غیر فعال باشد </label>
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

@endsection
