@extends('panel.layouts.master')
@section('title' , 'ایجاد کاربر')
@section('content')

    <div class="content-wrapper">


        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-12">
                        <h1 class="m-0 text-dark">افزودن کاربر جدید</h1>
                    </div>
                </div>


            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="card shadow-sm">

                    <div class="py-4 px-4 col-lg-10">


                        <form action="{{route('admin.user.store')}}" method="post" enctype="multipart/form-data">
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
                                    <label for="email">ایمیل </label>
                                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror " id="email"
                                           value="{{old('email')}}" placeholder="ایمیل را وارد کنید ">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                                    @enderror
                                </div>


                                <div class="col-lg-6 form-group">
                                    <label for="password">رمز عبور </label>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror " id="password"
                                           value="{{old('password')}}" placeholder="***">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label for="password_confirmation">تکرار رمز </label>
                                    <input type="password" name="password_confirmation" class="form-control "
                                           id="password_confirmation" value="{{old('password_confirmation')}}"
                                           placeholder="***">
                                </div>

                                <div class="col-lg-12 form-group">
                                    <label for="address">آدرس </label>
                                    <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" cols="30"
                                              placeholder="آدرس را وارد کنید" rows="10">{{old('address')}}</textarea>
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                                    @enderror
                                </div>
                                <div class="col-lg-12 form-group p-2">
                                    <input type="checkbox" class="is_active" name="is_active" id="is_active">
                                    <label for="is_active">کاربر فعال </label>
                                </div>

                                <div class="col-lg-12 form-group p-2">
                                    <input type="checkbox" class="is_active" name="is_staff" id="is_staff">
                                    <label for="is_staff">کاربر مدیر </label>
                                </div>
                                <div class="col-lg-12">
                                    <button class="btn btn-success" type="submit">ثبت نام</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>





@endsection
