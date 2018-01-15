@extends('admin.gentellela.tpl')

@section('content')
<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
	  <div class="x_title">
	    <h2>分类管理 <small>Stripped table subtitle</small></h2>
	    <ul class="nav navbar-right ">
	      
	     
	        <a href="javascript:;" onclick="add_cat_div()" role="button" ><i class="fa fa-arrows-v">添加</i></a>
	        
	     
	      
	    </ul>
	    <div class="clearfix"></div>
	  </div>
	  <div class="x_content">

    <table class="table table-striped">
      <thead >
        <tr>
          <th>#</th>
          <th>分类名称</th>
          <th>操作</th>
        </tr>
      </thead>
      <tbody id="cat_box">
      	@foreach($categories as $cat)
        <tr id="cat_{{ $cat->id }}">
          <td scope="row" width="20%"></td>
          <td width="60%">
            
              <input id="cat_name_{{ $cat->id }}"  onclick="edit_cat({{ $cat->id }})" type="text" class="form-control" readonly="readonly" placeholder="{{ $cat->name }}" value="{{ $cat->name }}">
            
          </td>

          <td id="cat_{{ $cat->id }}_btns" width="20%">
              <button class="btn btn-default btn-sm del_cat_btn" id="del_cat_{{ $cat->id }}" onclick="del_cat({{ $cat->id }})" type="button">删除</button>
          </td>
        </tr>
        @endforeach
        
      </tbody>
    </table>

</div>
</div>
</div>
</div>
@endsection


@section('scripts')
<script>
  var layer_index;
  function edit_cat(cat_id){
    
    $('#cat_name_'+cat_id).removeAttr('readonly');
    sv_btn_box = $('#cat_'+cat_id+'_btns').find('.update_cat_btn');
    
    if( sv_btn_box.length == 0){
      sv_btn = '<button class="btn btn-default btn-sm update_cat_btn" onclick="update_cat('+cat_id+')"  type="button">保存</button>';
      $('#cat_'+cat_id+'_btns').append(sv_btn);
    }
  }
  function add_cat_div(){
    //
    new_cat = $('#cat_box').find('#new_cat');
    if( new_cat.length == 0){
      new_cat_div = '<tr id="new_cat">'+
            '<td scope="row" width="20%"></td>'+
            '<td width="60%">'+
              
                '<input  type="text" class="form-control" placeholder="" value="" id="new_cat_name">'+
              
            '</td>'+

            '<td width="20%">'+
                '<button class="btn btn-default btn-sm save_cat_btn" onclick="add_cat()"  type="button">保存</button>'+
                '<button class="btn btn-default btn-sm del_cat_btn" onclick="location.reload();" type="button">取消</button>'+
            '</td>'+
          '</tr>';
        $('#cat_box').prepend(new_cat_div);
      }else{
        layer.msg('一次只能添加一个分类');
      }

  }
  function update_cat(cat_id){
    new_name = $('#cat_name_'+cat_id).val();
    $.ajax({
      url:"{{ URL('/'.$background.'/category') }}/"+cat_id,
      type:'POST',
      data:{'name':new_name,'_method':'PUT'},
      beforeSend:function(){
        //
        layer_index = layer.load(2, {
          shade: [0.1,'#fff'] //0.1透明度的白色背景
        });
      },
      success:function(res){
        layer.close(layer_index);
        layer.msg(res,function(){
          location.reload();
        });
      },
      error:function(res){
        layer.close(layer_index);
        console.log(res);
        layer.msg('意外错误 请重试',function(){
          // location.reload();
        });
        // location.reload();
      }
    });
  }
  function add_cat(){
    //
    name = $("#new_cat_name").val();
    $.ajax({
      url:"{{ URL('/'.$background.'/category') }}",
      type:'POST',
      data:{'name':name},
      beforeSend:function(){
        //
        layer_index = layer.load(2, {
          shade: [0.1,'#fff'] //0.1透明度的白色背景
        });
      },
      success:function(res){
        layer.close(layer_index);
        layer.msg(res,function(){
          location.reload();
        });
        // location.reload();
      },
      error:function(res){
        layer.close(layer_index);
        console.log(res);
        layer.msg('意外错误 请重试',function(){
          location.reload();
        });
        // location.reload();
      }
    });
  }
  function del_cat(cat_id){
    layer.confirm('确定要删除？', {
      btn: ['确定','取消'] //按钮
      }, function(){
        $.ajax({
          url:"{{ URL('/'.$background.'/category') }}/"+cat_id,
          data:{'cat_id':cat_id,'_method':'DELETE'},
          type:'POST',
          beforeSend:function(){
            //
            layer_index = layer.load(2, {
              shade: [0.1,'#fff'] //0.1透明度的白色背景
            });
          },
          success:function(res){
            layer.close(layer_index);
            layer.msg(res,function(){
              location.reload();
            });
          },
          error:function(res){
            console.log(res);
            layer.close(layer_index);
            layer.msg('意外错误 请重试',function(){
              location.reload();
            });
          }
        });
      }, function(){
      
      });
    
  }
</script>
@endsection