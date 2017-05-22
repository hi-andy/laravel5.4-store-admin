{{--<a class="btn btn-success" href="show/{{ $goods_id }}"><i class="glyphicon glyphicon-zoom-in icon-white"></i>查看 </a>--}}
<a class="btn btn-info" href="edit/{{ $goods_id }}"><i class="glyphicon glyphicon-edit icon-white"></i> 编辑 </a>
<form action="destroy/{{ $goods_id }}" method="POST" style="display: inline">
    {!! csrf_field() !!}
    <button class="btn btn-danger"><i class="glyphicon glyphicon-trash icon-white"></i>删除</button>
</form>
