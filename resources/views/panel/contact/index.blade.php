@extends('panel.layouts.master')
@section( 'title','مدیریت پیام ها')

@section('content')

<div class="content-wrapper">


    <div class="content-header">
        <div class="container-fluid px-4">
            <div class="row mb-2 d-flex flex-wrap justify-content-between">

                <h1 class="m-0 text-dark">مدیریت پیام ها </h1>

                <div>
                    <a href="{{route('admin.panel')}}" class="btn btn-sm btn-outline-secondary p-2">بازگشت</a>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
           <div class="card shadow-sm">


                <form action="" method="get">

                    <div class="row py-2">
                        <div class="col-lg-3 mr-2">
                            <input type="text" name="search" placeholder="  جستجو براساس نام ، ایمیل ,شماره تماس" class="form-control ml-2">
                        </div>

                        <div class="col-lg-4">
                            <button type="submit" class="btn  btn-outline-success ">جستجو</button>
                        </div>

                    </div>
                </form>
               <div class="py-4 px-4 ">

                    <table class="table table-sm">
                        <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>نام</th>
                            <th>شماره تماس</th>
                            <th> ایمیل</th>
                            <th>سایت</th>
                            <th>متن پیام</th>
                            <th>اقدامات</th>
                        </tr>
                        </thead>
                        <tbody>
                             @foreach($contacts as $contact)
                                <tr>
                                    <td  class="text-align-center">{{$loop->index}}</td>
                                    <td  class="text-align-center">{{$contact->name}}</td>
                                    <td  class="text-align-center">{{$contact->phone}}</td>
                                    <td  class="text-align-center">{{$contact->email}}</td>
                                    <td  class="text-align-center">{{$contact->site ?? 'سایت ندارد'}}</td>
                                    <td  class="text-align-center">{{$contact->text}}</td>
                                    <td  class="text-align-center">
                                        <form method="post" action="{{route('admin.contact.delete' , $contact->id)}}">
                                            @csrf
                                            @method('delete')
                                            @if(!$contact->approved)
                                            @can('update_contact')
                                            <a href="" onclick="event.preventDefault(); document.getElementById('seen').submit()" class="btn btn-sm btn-success" oncancel="document.getElementById('seen').submit()"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            @endcan
                                            @endif
                                            @can('delete_contact')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('آیا مایل به حذف هستید؟')"  title="حذف"
                                            >حذف</button>
                                            @endcan
                                            @can('send_email')
                                                <a href="{{route('admin.contact.send' , $contact->id)}}" class="btn btn-sm btn-info">ارسال ایمیل</a>
                                            @endcan
                                        </form>
                                        <form action="{{route('admin.contact.approved' , $contact->id)}}" id="seen" method="post">
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                             @endforeach

                        </tbody>

                    </table>

               </div>
               <div class="card-footer">
                   {{$contacts->render()}}

               </div>

           </div>

        </div>
    </div>

</div>

@endsection
