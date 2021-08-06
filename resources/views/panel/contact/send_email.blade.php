@extends('panel.layouts.master')
@section('title' , 'ارسال ایمیل ')
@section('content')

    <div class="content-wrapper">


        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-12">
                        <h1 class="m-0 text-dark">ارسال ایمیل </h1>
                    </div>
                </div>


            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="card shadow-sm">

                    <div class="py-4 px-4 col-lg-10">


                        <form action="{{route('admin.contact_send_email' , $id->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 form-group">
                                    <label for="subject">موضوع ایمیل</label>
                                    <input type="text" name="subject"
                                           class="form-control @error('subject') is-invalid @enderror "
                                           value="{{old('subject')}}" id="subject" placeholder="موضوع">
                                    @error('subject')
                                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                                    @enderror
                                </div>
                                <input type="hidden" name="email" value="{{$id->email}}">
                                <div class="col-lg-6 form-group">
                                    <label for="subject">ادرس ایمیل مقصد </label>
                                    <input type="email"
                                           class="form-control  "
                                           value="{{$id->email}}" id="subject" disabled>
                                </div>

                                <div class="col-lg-6 form-group">
                                    <label for="text">متن ایمیل </label>
                                    <textarea name="text" class="form-control @error('text') is-invalid @enderror" id=""
                                              cols="30" rows="10">{{old('text')}}</textarea>
                                    @error('text')
                                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                                    @enderror
                                </div>

                                <div class="col-lg-12">
                                    <button class="btn btn-success" type="submit">ارسال ایمیل</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>





@endsection
