@extends('panel.layouts.master')
@section( 'title','مدیریت نظرات')
@section('scripts')
    <script>
        $('#sendComment').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            let parent_id = button.data('id');

            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('input[name="parent_id"]').val(parent_id)

        })


    </script>
@endsection


@section('content')

    <div class="content-wrapper">


        <div class="content-header">
            <div class="container-fluid px-4">
                <div class="row mb-2 d-flex flex-wrap justify-content-between">

                    <h1 class="m-0 text-dark">مدیریت نظرات </h1>

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
                                <input type="text" name="search" placeholder="جستجو براساس نظر , نام , ایمیل "
                                       class="form-control ml-2">
                            </div>
                            <div class="col-lg-1">
                                <button type="submit" class="btn  btn-outline-success ">جستجو</button>
                            </div>
                        </div>
                    </form>
                    <div class="py-4 px-4 ">

                        <table class="table table-sm">
                            <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th> نام کاربر</th>
                                <th>نام نمایش</th>
                                <th>ایمیل</th>
                                <th> نظر</th>
                                <th> صفحه</th>
                                <th>اقدامات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($comments as $comment)
                                <tr>
                                    <td class="text-align-center">{{$loop->index}}</td>
                                    <td class="text-align-center">@if($comment->user_id) <i class="badge badge-light">{{$comment->user->name}}</i>   @else <i class="badge badge-danger">عضو سایت نیست</i>    @endif</td>
                                    <td class="text-align-center">{{$comment->name}}</td>
                                    <td class="text-align-center"><i class="badge badge-gray-400">{{$comment->email}}</i></td>
                                    <td class="text-align-center">{{$comment->comment}}</td>
                                    <td class="text-align-center">
                                        @if($comment->commentable_type != null and $comment->commentable_id != null)
                                            @if($comment->commentable_type == 'App\Product')
                                                <a href="{{route('single' , ['slug' => \App\Product::find($comment->commentable_id)->slug])}}">{{\App\Product::find($comment->commentable_id)->title}}</a>
                                            @else
                                                <a href="{{route('single.article' , ['slug' => \App\Article::find($comment->commentable_id)->slug])}}">{{\App\Article::find($comment->commentable_id)->title}}</a>
                                            @endif
                                        @endif

                                    </td>
                                    <td class="text-align-center">
                                        @if(!$comment->approved)
                                            @can('update_comment')
                                                <form method="post"
                                                      action="{{route('admin.comments.approve' , $comment->id)}}">
                                                    @csrf
                                                    @method('put')
                                                    <button type="submit" class="btn btn-sm btn-success mb-2">تایید
                                                        نظر
                                                    </button>
                                                </form>
                                            @endcan
                                        @endif
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
                                        @can('update_comment')
                                            <span class="btn btn-sm btn-primary mt-2" data-toggle="modal"
                                                  data-target="#sendComment" data-product="{{$comment->product_id}}"
                                                  data-id="{{$comment->id}}">ارسال نظر  </span>

                                        @endcan
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>

                    </div>
                    <div class="card-footer">
                        {{$comments->render()}}

                    </div>

                </div>

            </div>
        </div>

    </div>
    <div class="modal fade mt-5" id="sendComment">
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

                    <div class="modal-body">
                        <div class="form-group mr-3 ml-3">
                            <label for="message-text" class="col-form-label">نام نمایشی : (الزامی)</label>
                            <input type="text" name="name" class="form-control">
                        </div>

                        <div class="form-group mr-3 ml-3">
                            <label for="message-text" class="col-form-label"> پیام دیدگاه: (الزامی)</label>
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
