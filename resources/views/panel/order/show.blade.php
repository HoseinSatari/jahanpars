@extends('panel.layouts.master')
@section( 'title','محصولات سفارش ')
@section('content')

    <div class="content-wrapper">


        <div class="content-header">
            <div class="container-fluid px-4">
                <div class="row mb-2 d-flex flex-wrap justify-content-between">

                    <h1 class="m-0 text-dark">محصولات سفارش  </h1>

                    <div>
                        <a href="{{route('admin.panel')}}" class="btn btn-sm btn-outline-secondary p-2">بازگشت</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="card shadow-sm">
                    <div class="py-4 px-4 ">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <th>آیدی محصول</th>
                                    <th>عکس </th>
                                    <th>نام محصول</th>
                                    <th> قیمت محصول</th>
                                    <th>تعداد سفارش</th>
                                </tr>

                                @foreach($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td><img src="{{ $product->image }}" alt="{{$product->title}}" width="75px" height="75px" class="rounded-circle"></td>
                                        <td><a href="{{route('single' , $product->slug)}}">{{ $product->title }}</a></td>
                                        <td><i class="badge badge-gold">{{ number_format($product->pivot->price )}}تومان </i></td>
                                        <td>{{ $product->pivot->quantity }}</td>
                                    </tr>
                                @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{$products->render()}}

                    </div>

                </div>

            </div>
        </div>

    </div>

@endsection
