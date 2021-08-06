@extends('panel.layouts.master')
@section( 'title','مدیریت مقالات')
@section('content')

<div class="content-wrapper">


    <div class="content-header">
        <div class="container-fluid px-4">
            <div class="row mb-2 d-flex flex-wrap justify-content-between">

                <h1 class="m-0 text-dark">مدیریت مقالات </h1>

                <div>
                    @can('create_article')
                    <a href="{{route('admin.article.create')}}" class="btn btn-sm btn-outline-primary p-2">افزودن مقالات جدید</a>
                    @endcan

                    <a href="{{route('admin.panel')}}" class="btn btn-sm btn-outline-secondary p-2">بازگشت</a>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
           <div class="card shadow-sm">
               <form action="" method="get" id="active">
                   <input type="hidden" name="article" value="2">
               </form>
               <form action="" method="get" id="deactive">
                   <input type="hidden" name="article" value="1">
               </form>
               <form action="" method="get" id="visit">
                   <input type="hidden" name="visit" value="1">
               </form>


                <form action="" method="get">

                    <div class="row py-2">
                        <div class="col-lg-3 mr-2">
                            <input type="text" name="search" placeholder="جستجو براساس نام ،توضیحات , نام سازنده مقاله , دسته بندی" class="form-control ml-2">
                        </div>

                        <div class="col-lg-8">
                            <button type="submit" class="btn  btn-outline-success  ">جستجو</button>
                            <button class="btn btn-outline-gold " onclick="event.preventDefault(); document.getElementById('active').submit()">مقالات فعال </button>
                            <button class="btn btn-outline-dark " onclick="event.preventDefault(); document.getElementById('deactive').submit()">مقالات غیرفعال </button>
                            <button class="btn btn-outline-blue " onclick="event.preventDefault(); document.getElementById('visit').submit()">مقالات پربازدید </button>

                        </div>

                    </div>
                </form>
               <div class="py-4 px-4 ">
                   <div class="table-responsive">
                    <table class="table table-sm">
                        <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th> عکس شاخص</th>
                            <th>ایجاد کننده </th>
                            <th>سرتیتر  </th>
                            <th>توضیح کوتاه</th>
                            <th>تعداد بازدید</th>
                            <th>تعداد بازدیدکنندگان</th>
                            <th>اقدامات</th>
                        </tr>
                        </thead>
                        <tbody>
                           @if($articles->count())
                             @foreach($articles as $article)
                                <tr>
                                    <td  class="text-align-center">{{$loop->index}}</td>
                                    <td  class="text-align-center"><img src="{{$article->image}}" class="rounded-circle" width="75px" height="75px" alt="{{$article->title}}"></td>
                                    <td  class="text-align-center">{{$article->user->name}}</td>
                                    <td  class="text-align-center"><a href="{{route('single.article' , $article->slug)}}">{{$article->title}}</a></td>
                                    <td  class="text-align-center">{{$article->short_text}}</td>
                                    <td  class="text-align-center"><i class="badge badge-green">{{$article->visitor()}}</i></td>
                                    <td  class="text-align-center"><i class="badge badge-green">{{$article->visit()->count()}}</i></td>
                                    <td  class="text-align-center">
                                        <form method="post" action="{{route('admin.article.destroy' , $article->id)}}">
                                            @csrf
                                            @method('delete')
                                            @can('update_article')
                                            <a href="{{route('admin.article.edit' , $article->id)}}" class="btn btn-sm btn-success">ویرایش</a>
                                            @endcan
                                            @can('delete_article')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('آیا مایل به حذف هستید؟')"  title="حذف"
                                            >حذف</button>
                                            @endcan
                                        </form>

                                    </td>
                                </tr>
                             @endforeach

                           @else
                              <td colspan="8"> <p class="col-12" style="text-align: center; font-size: 20px">مقاله ای ثبت نشده است.  </p></td>
                           @endif

                        </tbody>

                    </table>
                   </div>
               </div>
               <div class="card-footer">
                   {{$articles->render()}}

               </div>

           </div>

        </div>
    </div>

</div>

@endsection
