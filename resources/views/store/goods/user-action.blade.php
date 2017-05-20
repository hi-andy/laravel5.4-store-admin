{{--<a class="btn btn-success" href="show/{{ $goods_id }}"><i class="glyphicon glyphicon-zoom-in icon-white"></i>查看 </a>--}}
<a class="btn btn-info" href="edit/{{ $goods_id }}"><i class="glyphicon glyphicon-edit icon-white"></i> 编辑 </a>

< class="btn btn-danger" href="delete/{{ $goods_id }}"><i class="glyphicon glyphicon-trash icon-white"></i>删除</>
<form action="delete/{{ $goods_id->id }}" method="POST" style="display: inline;"><a class="btn btn-danger" href="delete/{{ $goods_id }}"><i class="glyphicon glyphicon-trash icon-white"></i>删除</a></form>
