@extends('admin.index')
@section('content')


<!-- Content Header (Page header) -->
<section class="content-header">
      <h1>Outlet</h1>
      <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{url('admin/baggiveaway')}}">Bag giveaway</a></li>
        <li class="active">Edit</li>
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
            <h3 class="box-title">Edit Chain</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form class="form-horizontal" method="POST" action="{{ url('admin/outlet/edit/'.$data->id) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            @if(session()->has('message'))
              <div class="box-body">
                <div class="callout callout-info">
                <p><i class="icon fa fa-check"></i> {{ session()->get('message') }}</p>
                </div>
              </div>
            @endif
            <div class="box-body">
              @if($data->image)
              <div class="col-md-3 text-center">
              <img src="{{ url($data->image) }}" alt="{{$data->name}}" width="150">
              </div>
              @endif

              <div class="@if($data->image) col-md-9 @else col-md-12 @endif">
                <div class="form-group">
                  <label for="active" class="col-sm-2 control-label">Active</label>
                  <div class="col-sm-10">
                    <label>
                      <input type="checkbox" class="minimal" value="1" name="active" {{$data->active?'checked':''}}>
                    </label>
                  </div>
                </div>

                <div class="form-group {{ $errors->has('sort') ? ' has-error' : '' }}">
                  <label for="link" class="col-sm-2 control-label">Sort</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="sort" name="sort" laceholder="Sort" value="{{$data->sort}}">
                    @if ($errors->has('link'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('sort') }}</span>
                      </span>
                    @endif
                  </div>
                </div>

                <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                  <label for="title" class="col-sm-2 control-label">Title</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="title" name="title" laceholder="Title" value="{{$data->title}}">
                    @if ($errors->has('title'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('title') }}</span>
                      </span>
                    @endif
                  </div>
                </div>

                <div class="form-group {{ $errors->has('redemption_dates') ? ' has-error' : '' }}">
                  <label for="redemption_dates" class="col-sm-2 control-label">Redemption dates</label>
                  <div class="col-sm-10">
                    <textarea class="textarea" style="width: 100%;height: 100px" id="redemption_dates" name="redemption_dates">{{ $data->redemption_dates }}</textarea>
                    @if ($errors->has('redemption_dates'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('redemption_dates') }}</span>
                      </span>
                    @endif
                  </div>
                </div>

              </div>
              <!-- /.box-body -->
              <div class="text-center">
                <a href="{{url('/admin/baggiveaway/edit/'.$data->chain_id)}}" class="btn btn-default">Back</a>
                <button type="submit" class="btn btn-info">Update</button>
              </div>
              <!-- /.box-footer -->
              </div>
          </form>


      </div>
    </div>
  </div>

</section>
@endsection
@section('script')
<script type="text/javascript">
  $(document).ready(function () {
    setTimeout(function(){
        $('.callout').fadeOut( "slow" );
      }, 3000);
    $('input[type="checkbox"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
  })
</script>
@endsection