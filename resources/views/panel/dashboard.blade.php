@extends('panel.layouts.master')
@section('scripts')
    <script>
        $('#sendComment').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            let parent_id = button.data('id');
            let product_id = button.data('product');
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('input[name="parent_id"]').val(parent_id)
            modal.find('input[name="product_id"]').val(product_id)
        })


    </script>
    @endsection
@section('content')

    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-12">
                        <h1 class="m-0 text-dark">پیشخوان</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    @can('show_user')
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner fa-num">
                                    <h3>{{\App\User::where('created_at' , '>=' , now()->subDay(30))->count()}}</h3>
                                    <p>کاربران 30 روز اخیر</p>
                                </div>
                                <div class="icon">
                                    <i class="fal fa-users"></i>
                                </div>
                                <a href="{{route('admin.user.index')}}" class="small-box-footer">
                                    مشاهده بیشتر <i class="fad fa-arrow-circle-left"></i>
                                </a>
                            </div>
                        </div>
                    @endcan

                    @can('show_order')
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                                <div class="inner fa-num">
                                    <h3>{{\App\Order::where('created_at' , '>=' , now()->subDay(30))->count()}}</h3>
                                    <p>سفارشات 30 روز اخیر</p>
                                </div>
                                <div class="icon">
                                    <i class="fal fa-envelope"></i>
                                </div>
                                <a href="{{route('admin.orders.index')}}" class="small-box-footer">
                                    مشاهده بیشتر <i class="fad fa-arrow-circle-left"></i>
                                </a>
                            </div>
                        </div>
                    @endcan
                    @can('view products')
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-danger">
                                <div class="inner fa-num">
                                    <h3>{{\App\visit::where('created_at' , '>=' , now()->subDay(30))->where('visitable_type' ,'App\Product')->count()}}</h3>
                                    <p> بازدید 30 روز اخیر محصولات </p>
                                </div>
                                <div class="icon">
                                    <i class="fal fa-envelope"></i>
                                </div>
                                <a href="{{route('admin.product.index')}}" class="small-box-footer">
                                    مشاهده بیشتر <i class="fad fa-arrow-circle-left"></i>
                                </a>
                            </div>
                        </div>
                    @endcan
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner fa-num">
                                <h3>{{\App\visit::where('created_at' , '>=' , now()->subDay(30))->where('visitable_type' ,'App\Article')->count()}}</h3>
                                <p>   بازدید 30 روز اخیر مقالات</p>
                            </div>
                            <div class="icon">
                                <i class="fal fa-envelope"></i>
                            </div>
                            <a href="{{route('admin.article.index')}}" class="small-box-footer">
                                مشاهده بیشتر <i class="fad fa-arrow-circle-left"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row p-2">
                    @can('show_user')

                        <div class="card shadow-sm py-2 px-2 col-sm-11 col-lg-6 col-md-11">
                            <div class="p-4">
                                <h4 class="text-secondary">جدیدترین اعضای سایت</h4>
                            </div>
                            <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                <th>#</th>
                                <th>نام</th>
                                <th>شماره تماس</th>
                                <th>تاریخ ثبت نام</th>
                                </thead>
                                <tbody>
                                @foreach (\App\User::orderBy('created_at' , 'asc')->take(10)->get() as $user)

                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->phone}}</td>
                                        <td>{{jdate($user->created_at)->ago()}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            </div>

                        </div>
                    @endcan
                    @can('show_product')
                        <div class="card shadow-sm py-2 px-2   col-6col-sm-11 col-lg-6 col-md-11">
                            <div class="p-4">
                                <h4 class="text-secondary">آخرین محصولات سایت</h4>
                            </div>
                            <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                <th>#</th>
                                <th>تصویر</th>
                                <th>نام محصول</th>
                                <th>دسته بندی محصول</th>
                                <th>قیمت</th>
                                </thead>
                                <tbody>

                                @foreach(\App\Product::orderBy('created_at' , 'asc')->take(10)->get() as $product)
                                    <tr>
                                        <td>{{$product->id}}</td>
                                        <td><img src="{{$product->image}}" class="rounded-circle" width="75px"
                                                 height="75px" alt="{{$product->title}}"></td>
                                        <td>{{$product->title}}</td>
                                        <td>
                                            @foreach($product->categories as $cat)
                                                <span class="badge badge-light">{{$cat->name}}</span>
                                            @endforeach
                                        </td>
                                        <td>{{number_format($product->price)}} تومان</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                    @endcan
                    @can('show_comment')
                        <div class="card shadow-sm py-2 px-2   col-sm-11 col-lg-6 col-md-11">
                            <div class="p-4">
                                <h4 class="text-secondary">نظرات تایید نشده </h4>
                            </div>
                            <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                <th>#</th>
                                <th>نام</th>
                                <th>ایمیل</th>
                                <th>نظر</th>
                                <th>محصول</th>
                                <th>عملیات</th>
                                </thead>
                                <tbody>

                                @foreach(\App\Comment::where('approved' , 0)->orderBy('created_at' , 'asc')->take(10)->get() as $comment)
                                    <tr>
                                        <td>{{$comment->id}}</td>
                                        <td>{{$comment->name}}</td>
                                        <td>{{$comment->email}}</td>
                                        <td>{{$comment->comment}}</td>
                                        <td>{{$comment->product_id}}</td>
                                        <td>@can('update_comment')
                                                <form method="post"
                                                      action="{{route('admin.comments.approve' , $comment->id)}}">
                                                    @csrf
                                                    @method('put')
                                                    <button type="submit" class="btn btn-sm btn-success mb-2">تایید
                                                        نظر
                                                    </button>
                                                </form>
                                            @endcan

                                            @can('delete_comment')
                                                <form method="post"
                                                      action="{{route('admin.comments.delete' , $comment->id)}}">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('آیا مایل به حذف هستید؟')"
                                                            title="حذف"
                                                    >حذف
                                                    </button>
                                                </form>
                                            @endcan
                                            <span class="btn btn-sm btn-primary mt-2" data-toggle="modal"
                                                  data-target="#sendComment" data-product="{{$comment->product_id}}"
                                                  data-id="{{$comment->id}}">ارسال نظر  </span></td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            </div>

                        </div>
                    @endcan
                </div>
            </div>
        </div>

    </div>
    <div class="modal fade mt-5"  id="sendComment" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ارسال نظر</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('admin.comments.send')}}" method="post" id="sendCommentForm">
                    @csrf
                    <input type="hidden" name="parent_id">
                    <input type="hidden" name="product_id">
                    <div class="modal-body">
                        <div class="form-group mr-3 ml-3">
                            <label for="message-text" class="col-form-label">نام نمایشی : (الزامی)</label>
                            <input type="text" name="name" class="form-control">
                        </div>

                        <div class="form-group mr-3 ml-3">
                            <label for="message-text" class="col-form-label"> پیام دیدگاه:  (الزامی)</label>
                            <textarea name="comment" class="form-control" id="message-text"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">لغو</button>
                        <button type="submit" class="btn btn-primary">ارسال نظر</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
