@extends('panel.layouts.master')
@section('title' , 'ویرایش کد تخفیف')
@section('content')

<div class="content-wrapper">



    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12">
                <h1 class="m-0 text-dark">ویرایش کد تخفیف  </h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
           <div class="card shadow-sm p-2">

               <form action="{{route('admin.discount.update' , $discount->id)}}" method="post" enctype="multipart/form-data">
                   @csrf
                   @method('put')
                   <div class="row">
                       <div class="col-lg-6 form-group">
                           <label for="name">کد</label>
                           <input type="text" name="code"
                                  class="form-control @error('code') is-invalid @enderror "
                                  value="{{old('code' , $discount->code)}}" id="name" placeholder="کد تخفیف">
                           @error('code')
                           <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                           @enderror
                       </div>
                       <div class="col-lg-6 form-group">
                           <label for="phone">نوع تخفیف </label>
                           <select name="type" class="form-control @error('phone') is-invalid @enderror ">
                               <option value="int" {{$discount->type == 'int' ? 'selected' : ''}}>تومان</option>
                               <option value="percen" {{$discount->type == 'Percen' ? 'selected' : ''}}>درصد</option>

                           </select>
                           @error('type')
                           <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                           @enderror
                       </div>
                       <div class="col-lg-6 form-group">
                           <label for="email">مقدار تخفیف </label>
                           <input type="text" name="value"
                                  class="form-control @error('value') is-invalid @enderror " id="value"
                                  value="{{old('value' , $discount->value)}}" placeholder="مقدار تخفیف ">
                           @error('value')
                           <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                           @enderror
                       </div>
                       <div class="col-lg-6 form-group">
                           <label for="email" id="lable">تاریخ انقضا  </label>
                           <input type="text" name="expired_at"
                                  class="example1 form-control @error('expired_at') is-invalid @enderror "
                                  value="{{old('expired_at' , $discount->expired_at)}}" placeholder="تاریخ  ">
                           @error('expired_at')
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
<script type="text/javascript">
    $(document).ready(function() {

        {!! \File::get(public_path('/date/jquery-1.12.0.min.js')) !!}
        {!! \File::get(public_path('/date/persian-date.min.js')) !!}
        {!! \File::get(public_path('/date/persian-datepicker.min.js')) !!}
        $(".example1").pDatepicker({
            format : "YYYY-MM-DD",
        });
    });
</script>
@endsection
