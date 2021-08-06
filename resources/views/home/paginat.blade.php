<div class="styled-pagination text-center">
    <ul class="clearfix">
        <li class="prev"><a href="{{$paginator->previousPageUrl()}}"><span class="fa fa-angle-right"></span> </a></li>
        @foreach($paginator->getUrlRange(1, $paginator->lastPage()) as $pagenumber => $pagelink)
        <li @if($paginator->currentPage() == $pagenumber) class="active"  @endif><a href="{{$pagelink}}">{{$pagenumber}}</a></li>
        @endforeach

        <li class="next"><a href="{{$paginator->nextPageUrl()}}"><span class="fa fa-angle-left"></span> </a></li>
    </ul>
</div>
