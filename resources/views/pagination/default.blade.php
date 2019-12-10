<style>
    .pagination{
        padding: 20px 0;
    }
    .pagination li {
        color: #ec1c23;
        border-top:solid 1px #ddd;
        border-bottom:solid 1px #ddd;
        border-right:solid 1px #ddd;
        padding: 10px;
        cursor: pointer;
        background-color: white;
    }
    .pagination li a{
        color: #ec1c23;
        padding: 5px;
    }
    .pagination li.active{
        background-color: #ec1c23;
    }
    .pagination li.active a{
        color: #fff;
    }
    .pagination li:last-child{
        border-left:solid 1px #ddd;
    }
    .pagination li:hover {
        background-color: #ec1c23;
    }
    .pagination li:hover a {
        color: #fff;
        border-color: #ec1c23;
    }
</style>
@if ($paginator->lastPage() > 1)
    <ul class="pagination justify-content-center">
        <li class="{{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
            <a href="{{ $paginator->url(1) }}"><i class="fa {{trans('site.rightPagination')}}" aria-hidden="true"></i> </a>
        </li>
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <li class="{{ ($paginator->currentPage() == $i) ? 'active' : '' }}">
                <a href="{{ $paginator->url($i) }}">{{ $i }}</a>
            </li>
        @endfor
        <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
            <a href="{{ $paginator->url($paginator->currentPage()+1) }}"><i class="fa {{trans('site.leftPagination')}}"
                                                                            aria-hidden="true"></i></a>
        </li>
    </ul>
@endif