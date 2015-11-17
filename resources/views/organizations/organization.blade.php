@extends('master')
@section('content')
	<div class="panel panel-info">

		<div class="panel-body" style="padding-top:30px">
			<span class="breadcrumb">
				<a href="/admin/districts">District</a> |
				<a href="/admin/organizations">Organizations</a> |
				{{$data->title}}

			</span><hr />


			<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<tr class="tr_head"><td><h2>{{$data->title}}</h2></td></tr>
				<tr><td><strong>Description:</strong> {{$data->description}}</td></tr>
				<tr><td><strong>Created:</strong> {{$data->created_at}}</td></tr>
				<tr><td><strong>Updated:</strong> {{$data->updated_at}}</td></tr>

				@if(count($data->groups)>0)
				<tr><td><h3>Groups ({{count($data->groups)}}): <a title="Add new" class="btn btn-success btn_add_new" href="#">+</a></h3><hr /></td></tr>
				<tr><td>

						<table class="table table-striped table-bordered" cellspacing="0" width="100%">
							<tr class="tr_head2">
								<td>School Names</td>
								<td>Description</td>
							</tr>

							@foreach($data->groups as $group)
								<tr>
									<td><a href="/admin/group/{{$group->id}}/view">{{$group->title}}</a> </td>
									<td>{{$group->description}}</td>
								</tr>
							@endforeach
							</table>

				</td></tr>
				@endif

				@if(count($data->principals)>0)
					<tr><td><h3>Principals ({{count($data->principals)}}):<a title="Add new" class="btn btn-success btn_add_new" href="#">+</a></h3><hr /></td></tr>
					<tr><td>

							<table class="table table-striped table-bordered" cellspacing="0" width="100%">
								<tr class="tr_head2">
									<td>Children Names</td>
									<td>Usernames</td>
								</tr>

								@foreach($data->principals as $principal)
									<tr>
										<td><a href="/admin/user/{{$principal->id}}/view">{{$principal->name}}</a> </td>
										<td>{{$principal->slug}}</td>
									</tr>
								@endforeach
							</table>

						</td></tr>
				@endif

				@if(count($data->teachers)>0)
					<tr><td><h3>Principals ({{count($data->teachers)}}):<a title="Add new" class="btn btn-success btn_add_new" href="#">+</a></h3><hr /></td></tr>
					<tr><td>

							<table class="table table-striped table-bordered" cellspacing="0" width="100%">
								<tr class="tr_head2">
									<td>Teachers Names</td>
									<td>Usernames</td>
								</tr>

								@foreach($data->teachers as $teacher)
									<tr>
										<td><a href="/admin/user/{{$teacher->id}}/view">{{$teacher->name}}</a> </td>
										<td>{{$teacher->slug}}</td>
									</tr>
								@endforeach
							</table>

						</td></tr>
				@endif


				@if(count($data->users)>0)
				<tr><td><h3>Users ({{count($data->users)}}):<a title="Add new" class="btn btn-success btn_add_new" href="#">+</a></h3><hr /></td></tr>

								<tr><td>

										<table class="table table-striped table-bordered" cellspacing="0" width="100%">
											<tr class="tr_head2">
												<td>User</td>
												<td>Slug</td>
											</tr>

											@foreach($data->users as $user)
												<tr>
													<td><a href="/admin/user/{{$user->id}}/view">{{$user->name}}</a> </td>
													<td>{{$user->slug}}</td>
												</tr>
											@endforeach
											</table>

				</td></tr>
				@endif





			</table>

		</div>
	</div>
<h3 style="text-align: center">Upload Excel file</h3>
		{!! Form::open(array('url' => 'api/admin/importexcel', 'files'=>true, 'class' => 'form-horizontal', 'role' => 'form', 'id' =>
		'uploadcsvform'))	!!}
		<div class="input-group" style="text-align: center">
			{!! Form::file('yourcsv') !!}
		</div>
		<div class="col-sm-12 controls" style="text-align: center">
			{!! Form::hidden('organization_id',$data->id) !!}
			{!! Form::reset('Reset', array('class' => 'btn btn-default', 'id' => 'btn-reset')) !!}
			{!! Form::submit('Upload', array('class' => 'btn btn-success', 'id' => 'btn-upload')) !!}
		</div>
	{!! Form::close() !!}

@stop
