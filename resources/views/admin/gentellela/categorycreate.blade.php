@extends('admin.gentellela.tpl')

@section('content')
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>添加分类 <small>different form elements</small></h2>
        
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form data-parsley-validate class="form-horizontal form-label-left" action="{{ URL('/'.$background.'/category') }}" method="POST">
			{{ csrf_field() }}
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">分类名称<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="name" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
          
          
          
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              
              <button type="submit" class="btn btn-success">添加</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
@endsection