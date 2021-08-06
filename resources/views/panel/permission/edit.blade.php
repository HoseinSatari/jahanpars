@extends('panel.layouts.master')
@section('title' , 'ویرایش دسترسی')
@section('content')

    <div class="content-wrapper">


        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-12">
                        <h1 class="m-0 text-dark">ویرایش دسترسی</h1>
                    </div>
                </div>


            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="card shadow-sm">

                    <div class="py-4 px-4 col-lg-10">


                        <form action="{{route('admin.permission.update' , $permission->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-lg-6 form-group">
                                    <label for="name"> دسترسی   </label>
                                    <input type="text" name="name"
                                           class="form-control @error('name') is-invalid @enderror "
                                           value="{{old('name', $permission->name)}}" id="name" placeholder="دسترسی  ">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label for="name">عنوان دسترسی   </label>
                                    <input type="text" name="label"
                                           class="form-control @error('label') is-invalid @enderror "
                                           value="{{old('label' , $permission->label)}}" id="name" placeholder="عنوان دسترسی  ">
                                    @error('label')
                                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                                    @enderror
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
