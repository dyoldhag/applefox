@extends('admin.index')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
      <h1>Prizes</h1>
      <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{url('admin/prizes')}}">Prizes</a></li>
        <li class="active">Edit Prizes</li>
      </ol>
  </section>
  <!-- Main content -->
  <section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-lg-12 col-xs-12">
      <div class="box box-primary">
        <!-- /.box-header -->
        <!-- form start -->


          <div class="box-header with-border">
            <h3 class="box-title">New</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form class="form-horizontal" method="POST" action="{{ url('admin/prizes/store/') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="box-body">

              <div class="col-md-12">

                <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                  <label for="image" class="col-sm-2 control-label">Image</label>
                  <div class="col-sm-10">
                    <input type="file" class="form-control" name="image" id="image" placeholder="Image" >
                    @if ($errors->has('image'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('image') }}</span>
                      </span>
                    @endif
                  </div>
                </div>

                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                  <label for="name" class="col-sm-2 control-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" laceholder="Name" value="{{old('name')}}">
                    @if ($errors->has('name'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('name') }}</span>
                      </span>
                    @endif
                  </div>
                </div>

                <div class="form-group {{ $errors->has('total') ? ' has-error' : '' }}">
                  <label for="total" class="col-sm-2 control-label">Total</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="total" name="total" laceholder="Total" value="{{old('total')}}">
                    @if ($errors->has('total'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('total') }}</span>
                      </span>
                    @endif
                  </div>
                </div>

                <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                  <label for="description" class="col-sm-2 control-label">Description</label>
                  <div class="col-sm-10">
                    <textarea id="description" name="description" placeholder="Description"
                      style="width: 100%; height: 80px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{old('description')}}</textarea>
                    @if ($errors->has('description'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('description') }}</span>
                      </span>
                    @endif
                  </div>
                </div>

                <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">Content</label>
                  <div class="col-sm-10">
                    <textarea class="textarea" id="content" name="content" placeholder="Place some text here"
                      style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{old('content')}}</textarea>
                  </div>
                </div>

              </div>
              <!-- /.box-body -->
              <div class="text-center">
                <a href="{{url('/admin/prizes/')}}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-info">Add</button>
              </div>
              <!-- /.box-footer -->
              </div>
          </form>



      </div>
    </div>
  </div>
</section>

@section('script')
<link rel="stylesheet" href="{{ asset('/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
<script src="{{ asset('/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $('#content').wysihtml5({
      toolbar: {
        "font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
        "emphasis": true, //Italics, bold, etc. Default true
        "lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
        "html": true, //Button which allows you to edit the generated HTML. Default false
        "link": true, //Button to insert a link. Default true
        "image": true, //Button to insert an image. Default true,
        "color": true, //Button to change color of font  
        "blockquote": true, //Blockquote
      }
    });
    $('input[type="checkbox"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
  })
</script>
@endsection

@endsection
