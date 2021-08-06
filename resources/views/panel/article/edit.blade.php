@extends('panel.layouts.master')
@section('title' , "ویرایش مقاله - {$article->title}")
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
        CKEDITOR.replace('text', options);

        $('#lfm').filemanager('image');


        $('#categories').select2({
            'placeholder': 'دسته بندی مورد نظر را انتخاب کنید'
        })

    </script>
@endsection
@section('content')

    <div class="content-wrapper">


        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-12">
                        <h1 class="m-0 text-dark">ویرایش مقاله {{$article->title}}</h1>
                    </div>
                </div>


            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="card shadow-sm">

                    <div class="py-4 px-4 col-lg-10">


                        <form action="{{route('admin.article.update' , ['article' => $article->id] )}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')



                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label ">سرتیتر (عنوان) : </label>
                                    <input type="text" name="title"
                                           class="form-control @error('title') is-invalid @enderror" id="inputEmail3"
                                           placeholder="نام محصول را وارد کنید" value="{{ old('title' , $article->title) }}">
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail2" class="col-sm-3 control-label">توضیح کوتاه درباره مقاله :</label>
                                    <textarea class="form-control @error('short_text') is-invalid @enderror" name="short_text"
                                              id="short_text" cols="30"
                                              rows="4">{{ old('short_text', $article->short_text) }}</textarea>
                                    @error('short_text')
                                    <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">متن مقاله :</label>
                                    <textarea class="form-control @error('text') is-invalid @enderror" name="text"
                                              id="text" cols="30"
                                              rows="10">{{ old('text' , $article->text) }}</textarea>
                                    @error('text')
                                    <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label " >تصویر شاخص</label>
                                    <div class="input-group">
                                        <input type="text" id="thumbnail" value="{{old('image' , $article->image)}}" class="form-control" name="image">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" id="lfm" data-input="thumbnail" data-preview="holder">انتخاب</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">دسته بندی ها</label>
                                    <select class="form-control @error('category') is-invalid @enderror"
                                            name="category[]" id="categories" multiple>
                                        @foreach(\App\CategoryArticle::all() as $category)
                                            <option value="{{ $category->id }}" {{in_array($category->id , $article->category()->pluck('id')->toarray()) ? 'selected' : ''}}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                    <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                    @enderror
                                </div>

                                <div class="col-lg-12 form-group p-2">
                                    <input type="checkbox" class="is_active" name="deactive" id="is_active" @if(!$article->is_active) checked @endif>
                                    <label for="is_active">مقاله غیر فعال باشد </label>
                                </div>
                            </div>



                            <div class="col-lg-12">
                                <button class="btn btn-success" type="submit">ویرایش</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
