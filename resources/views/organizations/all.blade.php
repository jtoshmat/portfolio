@extends('master')
@section('content')
	<style type="text/css">
		.tr_head{
			background: #5bc0de;
		}
	</style>
	<div class="panel panel-info">

		<div class="panel-body" style="padding-top:30px">
			<h2>Organizations</h2>
			{{--*/  $errorClass = (session('flag'))?session('flag'):'info' /*--}}
			@if (count($errors) > 0)
				<div class="alert alert-{{$errorClass}}" role="alert">
					@foreach($errors->all() as $error)
						<p>
							<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
							<span class="sr-only">Error:</span>
							{{ $error }}
						</p>
					@endforeach
				</div>
			@endif

			{!! Form::open(array('url' => '/organizations', 'class' => 'form-horizontal', 'role' =>
		'form', 'id' =>'loginform'))	!!}
			<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
				<tr class="tr_head">
					<th>Title</th>
					<th>Users</th>
					<th>Created</th>
					<th>Last updated</th>
					<th>Delete</th>
				</tr>
				</thead>

				<tfoot>
				<tr>
					<th>Title</th>
					<th>Users</th>
					<th>Created</th>
					<th>Last updated</th>
					<th>Delete</th>
				</tr>
				</tfoot>

				<tbody>
				@foreach($data as $viewdata)
					<tr>
						<td>

							{!! Form::text('title[]', $viewdata->title, array('class' => 'form-control', 'placeholder' => 'title', 'id' =>
							'form-title', 'type' => 'text', 'required' => 'required')) !!}

						</td>
						<td>
							@if(!is_null($viewdata->groups))
							classes
							@endif
						</td>
						<td>{{$viewdata->created_at}}</td>
						<td>{{$viewdata->updated_at}}
							{!! Form::hidden('id[]', $viewdata->id) !!}
						</td>
						<td>
							{!! Form::checkbox('delete[]', $viewdata->id, false) !!}
						</td>
					</tr>
				@endforeach
				<tr>
					<td>
						{!! Form::text('newtitle', null, array('class' => 'form-control', 'placeholder' => 'New title', 'id' =>
						'form-title', 'type' => 'text')) !!}
					</td>
					<td>0</td>
					<td> </td>
					<td></td>
					<td></td>
				</tr>
				</tbody>
			</table>



			<div class="form-group" style="margin-top:10px; text-align: center">
				<!-- Button -->

				<div class="col-sm-12 controls">
					{!! Form::reset('Reset', array('class' => 'btn btn-default', 'id' => 'btn-reset')) !!}
					{!! Form::submit('Update', array('class' => 'btn btn-success', 'id' => 'btn-update')) !!}
				</div>
			</div>


			{!! Form::close() !!}
			<div class="pagination"><?php echo $data->render(); ?></div>

		</div>
	</div>
@stop
