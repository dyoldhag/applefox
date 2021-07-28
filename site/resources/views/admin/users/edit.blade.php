<a href="#" class="btn btn-block btn-info btn-sm" title="Edit" data-toggle="modal" data-target="#modal-add-shop{{ $data->id }}">
<span class="glyphicon glyphicon-edit"></span> Edit
</a>

<div class="modal fade" id="modal-add-shop{{ $data->id }}">
    <div class="modal-dialog">
      <div class="modal-content">
      <div class="box box-primary">
            <div class="box-body box-profile">
            <form class="form-horizontal" method="POST" action="{{ url('admin/'.$type.'/update/'.$data->id) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            
              <img class="profile-user-img img-responsive img-circle" src="{{ asset('/admin/dist/img/noavatar.png') }}" alt="{{ Auth::user()->name }}">
              <h3 class="profile-username text-center">{{ $data->name }}</h3>
              <p class="text-muted text-center">{{ $data->email }}</p>
              <div class="box-footer no-padding">
                <ul class="nav nav-stacked">

                  @if ($type != 'pre-launch')
                  <li><a> Birthday <span class="pull-right badge bg-aqua">
                    @if ($data->birthday)
                      {{ $data->birthday }}
                    @else
                      N/A
                    @endif
                  </span></a></li>
                  <li><a>Phone <span class="pull-right badge bg-aqua">
                    @if ($data->phone)
                      {{ $data->phone }}
                    @else
                      N/A
                    @endif
                  </span></a></li>
                  <li><a>Address <span class="pull-right badge bg-aqua">
                    @if ($data->address)
                      {{ $data->address }}
                    @else
                      N/A
                    @endif
                  </span></a></li>
                  @endif

                  @if ($type == 'users')
                  <li><a>Admin <span class="pull-right">
                    <label>
                      <input type="checkbox" class="minimal" value="1" name="admin" {{ $data->admin?'checked':'' }}>
                    </label>
                  </span></a></li>
                  @endif

                  <li><a>Active <span class="pull-right">
                    <label>
                      <input type="checkbox" class="minimal" value="1" name="active" {{ $data->active?'checked':'' }}>
                    </label>
                  </span></a></li>
                </ul>
              </div>
              

                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-info">Update</button>
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
  })
</script>
