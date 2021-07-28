<a href="#" class="btn btn-block btn-info btn-sm" title="Edit" data-toggle="modal" data-target="#modal-add-shop{{ $data->id }}">
<!-- <span class="glyphicon glyphicon-edit"></span>  -->Detail
</a>

<div class="modal fade" id="modal-add-shop{{ $data->id }}">
    <div class="modal-dialog">
      <div class="modal-content">
      <div class="box box-primary">
            <div class="box-body box-profile">
            <form class="form-horizontal form-horizontal{{$data->id}}" method="POST" action="{{ url('admin/'.$type.'/update/'.$data->id) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            
              <img class="profile-user-img img-responsive img-circle" src="{{ asset('/admin/dist/img/noavatar.png') }}" alt="{{ Auth::user()->name }}">
              <h3 class="profile-username text-center">{{ $data->name }}</h3>
              <p class="text-muted text-center">{{ $data->email }}</p>

              <div class="box-body">
                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}" style="width: 100%;margin: auto;">
                  <label for="name" class="col-sm-2 control-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="name{{$data->id}}" name="name" laceholder="Name" value="{{$data->name}}" style="width: 100%;" disabled>
                    @if ($errors->has('name'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('name') }}</span>
                      </span>
                    @endif
                  </div>
                </div>
              </div>

              <div class="box-body">
                <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}" style="width: 100%;margin: auto;">
                  <label for="email" class="col-sm-2 control-label">Email</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="email{{$data->id}}" name="email" laceholder="Email" value="{{$data->email}}" style="width: 100%;" disabled>
                  </div>
                </div>
              </div>

              <div class="box-body">
                <div class="form-group {{ $errors->has('icnumber') ? ' has-error' : '' }}" style="width: 100%;margin: auto;">
                  <label for="icnumber" class="col-sm-2 control-label">IC</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="icnumber{{$data->id}}" name="icnumber" laceholder="IC number" value="{{$data->icnumber}}" style="width: 100%;" disabled>
                  </div>
                </div>
              </div>

              <div class="box-body">
                <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}" style="width: 100%;margin: auto;">
                  <label for="phone" class="col-sm-2 control-label">Phone</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="phone{{$data->id}}" name="phone" laceholder="Phone" value="{{$data->phone}}" style="width: 100%;" disabled>
                    @if ($errors->has('phone'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('phone') }}</span>
                      </span>
                    @endif
                  </div>
                </div>
              </div>

              <div class="box-body">
                <div class="form-group {{ $errors->has('icnumber') ? ' has-error' : '' }}" style="width: 100%;margin: auto;">
                  <label for="icnumber" class="col-sm-2 control-label">IC</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="icnumber{{$data->id}}" name="icnumber" laceholder="IC number" value="{{$data->icnumber}}" style="width: 100%;" disabled>
                  </div>
                </div>
              </div>

              <div class="box-body">
                <div class="form-group {{ $errors->has('street') ? ' has-error' : '' }}" style="width: 100%;margin: auto;">
                  <label for="street" class="col-sm-2 control-label">Street</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="street{{$data->id}}" name="icnumber" laceholder="street" value="{{$data->street}}" style="width: 100%;" disabled>
                  </div>
                </div>
              </div>

              <div class="box-body">
                <div class="form-group {{ $errors->has('city') ? ' has-error' : '' }}" style="width: 100%;margin: auto;">
                  <label for="city" class="col-sm-2 control-label">City</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="icnumber{{$data->id}}" name="icnumber" laceholder="city" value="{{$data->city}}" style="width: 100%;" disabled>
                  </div>
                </div>
              </div>


              <div class="box-body">
                <div class="form-group {{ $errors->has('postcode') ? ' has-error' : '' }}" style="width: 100%;margin: auto;">
                  <label for="postcode" class="col-sm-2 control-label">Postcode</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="postcode{{$data->id}}" name="postcode" laceholder="Postcode" value="{{$data->postcode}}" style="width: 100%;" disabled>
                  </div>
                </div>
              </div>

              <div class="box-body">
                <div class="form-group {{ $errors->has('number_foxes') ? ' has-error' : '' }}" style="width: 100%;margin: auto;">
                  <label for="number_foxes" class="col-sm-2 control-label">Foxes</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="number_foxes{{$data->id}}" name="number_foxes" laceholder="Postcode" value="{{$data->number_foxes}}" style="width: 100%;" disabled>
                  </div>
                </div>
              </div>

              <div class="box-body">
                <div class="form-group {{ $errors->has('number_foxes') ? ' has-error' : '' }}" style="width: 100%;margin: auto;">
                  <label for="number_foxes" class="col-sm-2 control-label">Images</label>
                  <div class="col-sm-10">
                    @if($data->images)
                      @foreach(explode(',', $data->images) as $img)
                      <div class="col-md-3 text-center">
                        <img src="{{ url($img) }}" alt="{{$data->name}}" width="150">
                      </div>
                      @endforeach
                    @endif
                  </div>
                </div>
              </div>



              <!-- <div class="form-group" style="width: 100%;margin: 7px auto;line-height: 5px;">
                <label for="active" class="col-sm-2 control-label">Admin</label>
                <div class="col-sm-10">
                  <label style="margin-left: 6px;">
                    <input type="checkbox" class="minimal" value="1" name="admin" {{$data->admin?'checked':''}}>
                  </label>
                </div>
              </div>

              <div class="form-group" style="width: 100%;margin: 7px auto;line-height: 5px;">
                <label for="active" class="col-sm-2 control-label">Active</label>
                <div class="col-sm-10">
                  <label style="margin-left: 6px;">
                    <input type="checkbox" class="minimal" value="1" name="active" {{$data->active?'checked':''}}>
                  </label>
                </div>
              </div>
               -->

                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  <!-- <button type="submit" class="btn btn-info">Update</button> -->
                </div>
            </form>
            </div>
            <!-- /.box-body -->
          </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

<script type="text/javascript">
  $(document).ready(function () {
    $('input[type="checkbox"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    $('[data-mask]').inputmask();
  })
  jQuery('.form-horizontal{{$data->id}}').validate({      	   
    success: function(label) {},
    rules: {
            name{{$data->id}}: {required: true},																														
        },
        messages: {
            name{{$data->id}}: {},																																								
        }
  });
</script>
