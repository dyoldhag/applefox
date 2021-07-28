<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="box-header" style="padding-left: 0;">
              <h3 class="box-title">Outlet</h3>
            </div>
          </div>
          <div class="col-md-6">
            <div class="pull-right">
                <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-target="#modal-add-code">
                <span class="glyphicon glyphicon-plus-sign"></span> New</button>
            </div>
          </div>
        </div>
        <table id="table" class="table table-bordered table-hover" style="width:100% !important;">
          <thead>
            <tr>
              <th>Name</th>
              <th>Redemption dates</th>
              <th>Active</th>
              <th>Sort</th>
              <th>Created at</th>
              <th style="width:40px;" class="action text-center">Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-add-code">
  <div class="modal-dialog">
    <div class="modal-content">
        <form class="form-horizontal-row" method="POST" action="{{ url('admin/outlet/store') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
          <input type="hidden" class="form-control" id="chain_id" name="chain_id" laceholder="chain_id" value="{{ $data->id }}">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
              <h4 class="modal-title">Add Outlet</h4>
            </div>
            <br />
            <div class="box-body">
              <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                <label for="title" class="col-sm-3 control-label">Title</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="title" name="title" value="{{ old('title') or null }}">
                  @if ($errors->has('title'))
                    <span class="help-block">
                      <span class="help-block">{{ $errors->first('title') }}</span>
                    </span>
                  @endif
                </div>
              </div>
            </div>
            <div class="box-body">
              <div class="form-group {{ $errors->has('redemption_dates') ? ' has-error' : '' }}">
                <label for="redemption_dates" class="col-sm-3 control-label">Redemption dates</label>
                <div class="col-sm-9">
                  <textarea class="textarea" style="width: 100%;height: 100px" id="redemption_dates" name="redemption_dates">{{ old('redemption_dates') or null }}</textarea>
                  @if ($errors->has('redemption_dates'))
                    <span class="help-block">
                      <span class="help-block">{{ $errors->first('redemption_dates') }}</span>
                    </span>
                  @endif
                </div>
              </div>
            </div>
            <br />
            <!-- /.box-body -->
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-info">Add</button>
            </div>
        </form>
    </div>
  </div>
</div>
 

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

    jQuery('.form-horizontal-row').validate({      	   
      success: function(label) {},
      rules: {
            title: {required: true},																														
            redemption_dates: {required: true},
          },
          messages: {
            title: {},																																									
            redemption_dates: {},
          }
    });

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
          "bInfo" : true,
          "lengthChange": true,
          "autoWidth": false,
          "order": [],
          "ajax": "{{ url('admin/outlet/data/'.$data->id) }}",
          "pagingType": "full_numbers",
          "columns": [
            { data: "title" },
            { data: "redemption_dates" },
            { data: "active" },
            { data: "sort" },
            { data: "created_at" },
            { data: "action" }
          ],
          "fnDrawCallback": function (oSettings) {}
      });
  });
  </script>
@endsection