@extends('admin.index')
@section('content')


<!-- Content Header (Page header) -->
<section class="content-header">
      <h1>User</h1>
      <ol class="breadcrumb">
        <li><a href="{{url('admin/users')}}"><i class="fa fa-users"></i> Users</a></li>
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
            <!-- <div class="pull-right">
              <a href="{{url('admin/user/create')}}" class="btn btn-block btn-danger">
                <span class="glyphicon glyphicon-plus-sign"></span> New</a>
            </div>
            <br>
            <br> -->
            <table id="table" class="table table-bordered table-hover" style="width:100% !important;">
              <thead>
                <tr>
                  <th>Email</th>
                  <th>Date created</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>

  </section>

  @section('script')
  <script type="text/javascript">
    var oTable;
    $(document).ready(function () {
      oTable = $('#table').DataTable({
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
          "ajax": "{{ url('admin/'.$type.'/data') }}",
          "pagingType": "full_numbers",
          "columns": [
                      { data: "email" },
                      { data: "created_at" },
                    ],
          "fnDrawCallback": function (oSettings) {}
      });
  });
  </script>
  @endsection
@endsection
