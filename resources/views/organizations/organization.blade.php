@extends('master')
@section('content')
	<div class="panel panel-info">

		<div class="panel-body" style="padding-top:30px">
			<span class="breadcrumb">
				<a href="/districts">District</a> |
				<a href="/organizations">Organizations</a> |
				{{$data->title}}

			</span><hr />
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

			<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<tr class="tr_head"><td><h2>{{$data->title}}</h2></td></tr>
				<tr><td><strong>Description:</strong> {{$data->description}}</td></tr>
				<tr><td><strong>Created:</strong> {{$data->created_at}}</td></tr>
				<tr><td><strong>Updated:</strong> {{$data->updated_at}}</td></tr>

				<tr><td><h3>Groups ({{count($data->groups)}}): <a title="Add new" class="btn btn-success btn_add_new" href="#">+</a></h3><hr /></td></tr>
				<tr><td>

						<table class="table table-striped table-bordered" cellspacing="0" width="100%">
							<tr class="tr_head2">
								<td>School Names</td>
								<td>Description</td>
							</tr>

							@foreach($data->groups as $group)
								<tr>
									<td><a href="/group/{{$group->id}}/view">{{$group->title}}</a> </td>
									<td>{{$group->description}}</td>
								</tr>
							@endforeach
							</table>

				</td></tr>



				<tr><td><h3>Users ({{count($data->users)}}):<a title="Add new" class="btn btn-success btn_add_new" href="#">+</a></h3><hr /></td></tr>

								<tr><td>

										<table class="table table-striped table-bordered" cellspacing="0" width="100%">
											<tr class="tr_head2">
												<td>User</td>
												<td>Slug</td>
											</tr>

											@foreach($data->users as $user)
												<tr>
													<td><a href="/user/{{$user->id}}/view">{{$user->name}}</a> </td>
													<td>{{$user->slug}}</td>
												</tr>
											@endforeach
											</table>

												</td></tr>




			</table>

		</div>
	</div>
@stop
