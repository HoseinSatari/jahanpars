@extends('panel.layouts.master')
@section('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm').filemanager('image');
    </script>
@endsection
@section('title' , 'تنظیمات ')
@section('content')

<div class="content-wrapper">


    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12">
                    <h1 class="m-0 text-dark">تنظیمات</h1>
                </div>
            </div>


        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="card shadow-sm">

                <div class="py-4 px-4 col-lg-10">

                    <form action="{{route('admin.option.index' )}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label ">نام سایت</label>
                                <input type="text" name="sitename"
                                       class="form-control @error('sitename') is-invalid @enderror" id="inputEmail3"
                                       placeholder="نام سایت را وارد کنید" value="{{ old('sitename' , $option->sitename) }}">
                                @error('sitename')
                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label " >لوگو </label>
                                <div class="input-group">
                                    <input type="text" id="thumbnail" value="{{$option->image}}" class="form-control @error('image') is-invalid @enderror" name="image">
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                    @enderror
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="lfm" data-input="thumbnail" data-preview="holder">انتخاب</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label ">توضیح درباره سایت </label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="" cols="30" rows="3">{{ old('description' , $option->description) }}</textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label ">کلمات کلیدی (با کارکتر "," جدا کنید ) </label>
                                <textarea name="keyword" class="form-control @error('keyword') is-invalid @enderror" id="" cols="30" rows="3">{{ old('keyword' , $option->keyword) }}</textarea>
                                @error('keyword')
                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label ">شماره برای نمایش و پشتیبانی </label>
                                <input type="text" name="phone"
                                       class="form-control @error('phone') is-invalid @enderror" id="inputEmail3"
                                       placeholder="شماره" value="{{ old('phone' , $option->phone) }}">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label ">شماره برای ارسال پیامک ثبت سفارش </label>
                                <input type="text" name="phoneadmin"
                                       class="form-control @error('phoneadmin') is-invalid @enderror" id="inputEmail3"
                                       placeholder="شماره" value="{{ old('phoneadmin' , $option->phoneadmin) }}">
                                @error('phoneadmin')
                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label ">ایمیل    </label>
                                <input type="email" name="email"
                                       class="form-control @error('email') is-invalid @enderror" id="inputEmail3"
                                       placeholder="ایمیل" value="{{ old('email' , $option->email) }}">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label ">ادرس   </label>
                                <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="" cols="30" rows="3">{{ old('address' , $option->address) }}</textarea>
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label ">لینک لوکیشن   </label>
                                <textarea name="location" class="form-control @error('location') is-invalid @enderror" id="" cols="30" rows="2">{{ old('location' , $option->location) }}</textarea>
                                @error('location')
                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label ">اینستاگرام </label>
                                <input type="text" name="instagram"
                                       class="form-control @error('instagram') is-invalid @enderror" id="inputEmail3"
                                       placeholder="اینستاگرام" value="{{ old('instagram' , $option->instagram) }}">
                                @error('instagram')
                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label ">واتساپ </label>
                                <input type="text" name="whatsup"
                                       class="form-control @error('whatsup') is-invalid @enderror" id="inputEmail3"
                                       placeholder="واتساپ" value="{{ old('whatsup' , $option->whatsup) }}">
                                @error('whatsup')
                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label ">تلگرام </label>
                                <input type="text" name="telegram"
                                       class="form-control @error('telegram') is-invalid @enderror" id="inputEmail3"
                                       placeholder="تلگرام" value="{{ old('telegram' , $option->telegram) }}">
                                @error('telegram')
                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                @enderror
                            </div>

                            <div class="col-lg-12 form-group p-2">
                                <input type="checkbox" class="is_active" name="deactive" id="is_active" {{$option->is_active == '0' ? 'checked' : ''}}>
                                <label for="is_active">سایت غیرفعال باشد </label>
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
