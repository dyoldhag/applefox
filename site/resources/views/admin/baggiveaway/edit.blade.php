@extends('admin.index')
@section('content')


<!-- Content Header (Page header) -->
<section class="content-header">
      <h1>Chain</h1>
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
          <form class="form-horizontal" method="POST" action="{{ url('admin/baggiveaway/edit/'.$data->id) }}" enctype="multipart/form-data">
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

                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                  <label for="name" class="col-sm-2 control-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" laceholder="Name" value="{{$data->name}}">
                    @if ($errors->has('name'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('name') }}</span>
                      </span>
                    @endif
                  </div>
                </div>

              </div>
              <!-- /.box-body -->
              <div class="text-center">
                <a href="{{url('/admin/baggiveaway/')}}" class="btn btn-default">Back</a>
                <button type="submit" class="btn btn-info">Update</button>
              </div>
              <!-- /.box-footer -->
              </div>
          </form>


      </div>
    </div>
  </div>

  @include('admin.baggiveaway.outlet.index')
</section>
@endsection
