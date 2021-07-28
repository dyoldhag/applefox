@extends('admin.index')
@section('content')


<!-- Content Header (Page header) -->
<section class="content-header">
      <h1>Win fridge</h1>
      <ol class="breadcrumb">
        <li><a href="{{url('admin/winfridge')}}"><i class="fa fa-apple"></i> Win fridge</a></li>
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
                  <th style="width: 71px">IC number</th>
                  <th style="width: 60px;">Phone</th>
                  <th>Email</th>
                  <th>Preferred</th>
                  <th>Number</th>
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
        "dom": '<"dataTables_wrapper form-inline dt-bootstrap no-footer" <"row" <"toolbar col-sm-2"> <"col-sm-7"l> <"col-sm-3"f> > rt'+
              '<"row" <"col-sm-5"i><"col-sm-7"p>><"clear">',
              "initComplete":   function(){
                  $("div.toolbar").html('<a href="{{ route('winfridge.export.file',['type'=>'xlsx']) }}" class="btn btn-primary btn-sm" style="width: calc(50% - 5px);"><i class="fa fa-file-excel-o"></i> Excel</a> <a style="width: calc(50% - 5px);" href="{{ route('winfridge.export.file',['type'=>'csv']) }}" class="btn btn-primary btn-sm pull-right"><i class="fa fa-download"></i> CSV</a>');
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
              { 
                  "searchable"    : false, 
                  "targets"       : [1,2,3,4,5,6] 
              },
          ],
          "processing": false,
          "serverSide": true,
          // "ordering": true,
          "bInfo" : true,
          "lengthChange": true,
          "autoWidth": false,
          "pageLength": 50,
          "order": [],
          "ajax": "{{url('admin/winfridge/data')}}",
          "pagingType": "full_numbers",
          "columns": [
                      { data: "name" },
                      { data: "icnumber" },
                      { data: "phone" },
                      { data: "email" },
                      { data: "preferred" },
                      { data: "number" },
                      { data: "created_at" }
                    ],
          "fnDrawCallback": function (oSettings) {}
      });
  });
  </script>
  @endsection
@endsection