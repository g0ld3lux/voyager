@extends('voyager::master')

@section('css')
	<!-- DataTables -->
    <link rel="stylesheet" href="{{ VOYAGER_ASSETS_PATH }}/plugins/datatables/dataTables.bootstrap.css">
@stop

@section('page_header')

	@if(Session::has('message'))
      <div class="alert callout alert-{{ Session::get('alert-class', 'info') }}"><i class="fa fa-{{ Session::get('alert-icon', 'info-circle') }}"></i> {{ Session::get('message') }} <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>
    @endif

	<i class="fa fa-user"></i> {{ $dataType->display_name_plural }} <a href="/admin/{{ $dataType->slug }}/create" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add New</a>
@stop

@section('content')

	<div class="row">
		<table id="users" class="table table-bordered">
	        <thead>
	          <tr>
	          	@foreach($dataType->browseRows as $rows)
	          		<th>{{ $rows->field }}</th>
	          	@endforeach
	          	<th class="actions">Actions</th>
	          </tr>
	        </thead>
	        <tbody>
	       		@foreach($dataTypeContent as $data)
	          		<tr>
	          			@foreach($dataType->browseRows as $row)
	          				<td>

	          					@if($row->type == 'image')
	          						<img src="<?= url('/') . '/' . $data->{$row->field};  ?>" style="width:100px">
	          					@else
	          						{{ $data->{$row->field} }}
	          					@endif
	          				</td>
	          			@endforeach
	          			<td></td>
	          		</tr>
	          	@endforeach
	        </tbody>
	      </table>
    </div>

<?php /*
    <div class="modal modal-danger fade" tabindex="-1" id="delete_user_modal" role="dialog">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-trash-o"></i> Are you sure you want to delete the user, <span id="delete_user_name"></span>?</h4>
	      </div>
	      <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>
            <form action="/admin/users" id="delete_user_form" method="POST">
            	<input type="hidden" name="_method" value="DELETE">
            	<input type="hidden" name="_token" value="{{ csrf_token() }}">
            	<input type="submit" class="btn btn-outline" value="Yes, Delete This User">
          	</form>
          </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal --> */
	?>
@stop

@section('javascript')
	<!-- DataTables -->
    <script src="{{ VOYAGER_ASSETS_PATH }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ VOYAGER_ASSETS_PATH }}/plugins/datatables/dataTables.bootstrap.min.js"></script>

    <script>
      $(document).ready(function(){
        $('#users').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "aoColumnDefs": [
	          { 'bSortable': false, 'aTargets': [ -1 ] }
	       ]
        });

      });

      $('#delete_user_id').click(function(){
      	window.location = '/admin/users/de'
      });
    </script>
@stop