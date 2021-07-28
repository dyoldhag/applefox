@extends('admin.index')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
      <h1>Prizes</h1>
      <ol class="breadcrumb">
        <li><a href="{{url('admin/prizes')}}"><i class="fa fa-gift"></i> Prizes</a></li>
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
                    <th>Image</th>
                    <th>Name</th>
                    <th>Total</th>
                    <th>Awarded</th>
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
  </section>

@section('script')
<script type="text/javascript">
@if(isset($type))
  var oTable;
  $(document).ready(function () {
      oTable = $('#table').DataTable({
          "dom": '<"dataTables_wrapper form-inline dt-bootstrap no-footer" <"row" <"toolbar col-sm-1"> <"col-sm-8"l> <"col-sm-3"f> > rt'+
              '<"row" <"col-sm-5"i><"col-sm-7"p>><"clear">',
              "initComplete":   function(){
                  $("div.toolbar").html('<a href="{{url('admin/prizes/create')}}" class="btn btn-block btn-danger btn-sm"><span class="glyphicon glyphicon-plus-sign"></span> New</a>');
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
          "columnDefs": [
            { className: 'text-center', targets: [0,4,5,6,7] },
          ],
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
                      { data: "image" },
                      { data: "name" },
                      { data: "total" },
                      { data: "awarded" },
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
