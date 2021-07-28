@extends('admin.index')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Bag giveaway</h1>
    <ol class="breadcrumb">
      <li><a href="{{url('admin/baggiveaway')}}"><i class="fa fa-building"></i> Bag giveaway</a></li>
      <li class="active">List</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">

  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body">
          <table id="table" class="table table-bordered table-hover" style="width:100% !important;">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Outlet</th>
                  <th>Active</th>
                  <th>Sort</th>
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
          <form class="form-horizontal" method="POST" action="{{ url('admin/baggiveaway/store') }}" enctype="multipart/form-data">
          {{ csrf_field() }}

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
              <h4 class="modal-title">Add Chain</h4>
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
@if(isset($type))
  var oTable;
  $(document).ready(function () {
      oTable = $('#table').DataTable({
          "dom": '<"dataTables_wrapper form-inline dt-bootstrap no-footer" <"row" <"toolbar col-sm-2"> <"col-sm-7"l> <"col-sm-3"f> > rt'+
              '<"row" <"col-sm-5"i><"col-sm-7"p>><"clear">',
              "initComplete":   function(){
                  $("div.toolbar").html('<button type="button" class="btn btn-block btn-danger btn-sm" data-toggle="modal" data-target="#modal-add"><span class="glyphicon glyphicon-plus-sign"></span> New Chain</button>');
              },
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
          // "columnDefs": [
          //   { className: 'text-center', targets: [0,4,5,6,7] },
          // ],
          "processing": true,
          "serverSide": true,
          "ordering": false,
          "bInfo" : true,
          "lengthChange": true,
          "autoWidth": false,
          "order": [],
          "ajax": "{{ url('admin/'.$type.'/data') }}",
          "pagingType": "simple_numbers",
          "columns": [
                      { data: "name" },
                      { data: "outlet" },
                      { data: "active" },
                      { data: "sort" },
                      { data: "created_at" },
                      { data: "action" }
                    ],
          "drawCallback": function () {
            $('.dataTables_paginate > .pagination').addClass('pagination-sm no-margin pull-right');
          }
      });
  });
@endif
</script>
@endsection

@endsection
