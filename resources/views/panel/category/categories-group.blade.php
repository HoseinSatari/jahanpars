<ul class="list-group list-group-flush">
    @foreach($categories as $cate)
        <li class="list-group-item">
            <div class="d-flex">
                <span>{{ $cate->name }}</span>
                <div class="actions mr-2">
                    <form action="{{ route('admin.category.destroy', $cate->id) }}" id="cate-{{ $cate->id }}-delete" method="POST">
                        @csrf
                        @method('delete')
                    </form>
                    @if(!request()->delete)
                        @can('delete_category')
                    <a href="#" onclick="event.preventDefault(); document.getElementById('cate-{{ $cate->id }}-delete').submit()" class="badge badge-danger">حذف</a>
                        @endcan
                    @can('edit_category')
                    <a href="{{ route('admin.category.edit' , $cate->id) }}" class="badge badge-primary">ویرایش</a>
                            @endcan
                        @can('create_category')
                    <a href="{{ route('admin.category.create') }}?parent={{ $cate->id }}" class="badge badge-warning">ثبت زیر دسته</a>
                            @endcan
                        <span class="badge badge-success">{{$cate->view_order}}@if($cate->parent == 0) -دسته پدر @endif</span>
                    @else
                        <form action="{{ route('admin.category.restor' , $cate->id) }}" method="post">
                            @csrf
                            @method('put')
                            <button class="badge badge-success">برگشت از حذف</button>
                        </form>

                    @endif
                </div>
            </div>
            @if($cate->child->count())
                @include('panel.category.categories-group' , [ 'categories' => $cate->child])
            @endif
        </li>
    @endforeach
</ul>
