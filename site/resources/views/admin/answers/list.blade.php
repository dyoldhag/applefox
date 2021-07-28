@extends('admin.index')
@section('content')


<!-- Content Header (Page header) -->
<section class="content-header">
      <h1>Answers</h1>
      <ol class="breadcrumb">
        <li><a href="{{url('admin/answers')}}"><i class="fa fa-users"></i> Answers</a></li>
        <li class="active">List</li>
      </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-xs-12">
      @if(session()->has('message'))
        <div class="alert alert-warning alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-warning"></i> Alert!</h4>
          {{ session()->get('message') }}
        </div>
      @endif
        <div class="box">
          <div class="box-body">
            <table id="table" class="table table-bordered table-hover" style="width:100% !important;">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>IC number</th>
                  <th>Street</th>
                  <th>City</th>
                  <th>Postcode</th>
                  <th>Number</th>
                  <th>Date created</th>
                  <th style="width:40px;" class="action text-center">Action</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal-add">
      <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" method="POST" action="{{ url('admin/users/store') }}" enctype="multipart/form-data">
            {{ csrf_field() }}

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Add User</h4>
              </div>

              <div class="box-body">
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
              </div>

              <div class="box-body">
                <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                  <label for="email" class="col-sm-2 control-label">Email</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" name="email" laceholder="Email" value="{{old('email')}}">
                    @if ($errors->has('email'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('email') }}</span>
                      </span>
                    @endif
                  </div>
                </div>
              </div>

              <div class="box-body">
                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                  <label for="password" class="col-sm-2 control-label">Password</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password" laceholder="Password" value="{{old('password')}}">
                    @if ($errors->has('password'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('password') }}</span>
                      </span>
                    @endif
                  </div>
                </div>
              </div>

              <div class="box-body">
                <div class="form-group {{ $errors->has('birthday') ? ' has-error' : '' }}">
                  <label for="birthday" class="col-sm-2 control-label">Birthday</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="birthday" name="birthday" value="{{old('birthday')}}" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                    @if ($errors->has('birthday'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('birthday') }}</span>
                      </span>
                    @endif
                  </div>
                </div>
              </div>

              <div class="box-body">
                <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                  <label for="phone" class="col-sm-2 control-label">Phone</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="phone" name="phone" laceholder="Phone" value="{{old('phone')}}">
                    @if ($errors->has('phone'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('phone') }}</span>
                      </span>
                    @endif
                  </div>
                </div>
              </div>

              <div class="box-body">
                <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                  <label for="address" class="col-sm-2 control-label">Address</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="address" name="address" laceholder="Address" value="{{old('address')}}">
                    @if ($errors->has('address'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('address') }}</span>
                      </span>
                    @endif
                  </div>
                </div>
              </div>


              <!-- /.box-body -->
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info">Add</button>
              </div>
            </form>
        </div>
      </div>
    </div>

  </section>


  @section('script')
  <script type="text/javascript">
  $('[data-mask]').inputmask();
  jQuery('.form-horizontal').validate({
    success: function(label) {},
    rules: {
            name: {required: true},
            email: {required: true,email: true},
            password: {required: true},																																
        },
        messages: {
            name: {},
            email: {},
            password: {},
        }
    });

    var oTable;
    $(document).ready(function () {
      oTable = $('#table').DataTable({
          @if ($type == 'users')
          "dom": '<"dataTables_wrapper form-inline dt-bootstrap no-footer" <"row" <"toolbar col-sm-1"> <"col-sm-8"l> <"col-sm-3"f> > rt'+
              '<"row" <"col-sm-5"i><"col-sm-7"p>><"clear">',
          "initComplete":   function(){
              $("div.toolbar").html('<button type="button" class="btn btn-block btn-danger btn-sm" data-toggle="modal" data-target="#modal-add"><span class="glyphicon glyphicon-plus-sign"></span> New</button>');
          },
          @endif
          "oLanguage": {
              "sProcessing": "{{ trans('table.processing') }}",
              "sLengthMenu": "{{ trans('table.showmenu') }}",
              "sZeroRecords": "{{ trans('table.noresult') }}",
              "sInfo": "{{ trans('table.show') }}",
              "sEmptyTable": "{{ trans('table.emptytable') }}",
              "sInfoEmpty": "{{ trans('table.view') }}",
              "sInfoFiltered": "{{ trans('table.filter') }}",
              "sInfoPostFix": "",
              "sSearch": "{{ trans('table.search') }}:",
              "sUrl": "",
              "oPaginate": {
                  "sFirst": "{{ trans('table.start') }}",
                  "sPrevious": "{{ trans('table.prev') }}",
                  "sNext": "{{ trans('table.next') }}",
                  "sLast": "{{ trans('table.last') }}"
              }
          },
          "processing": false,
          // "serverSide": true,
          // "ordering": true,
          "bInfo" : true,
          "lengthChange": true,
          "autoWidth": false,
          "order": [],
          "ajax": "{{url('admin/'.$type.'/data')}}",
          "pagingType": "full_numbers",
          "columns": [
                      { data: "name" },
                      { data: "email" },
                      { data: "phone" },
                      { data: "icnumber" },
                      { data: "street" },
                      { data: "city" },
                      { data: "postcode" },
                      { data: "number_foxes" },
                      { data: "created_at" },
                      { data: "action" }
                    ],
          "fnDrawCallback": function (oSettings) {}
      });
  });
  </script>
  @endsection
@endsection
