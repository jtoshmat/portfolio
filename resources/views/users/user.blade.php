@extends('master')
@section('content')
	<style type="text/css">
		.tr_head{
			background: #5bc0de!important;
		}
	</style>
	<div class="panel panel-info">

		<div class="panel-body" style="padding-top:30px">
			<span class="breadcrumb">
				<a href="/districts">District</a> |
				<a href="/organizations">Organizations</a> |
				<a href="/groups">Groups</a> |


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
				<tr class="tr_head"><td><h2>{{$data->name}}</h2></td></tr>




				<tr><td><h3>Guardians ({{count($data->guardians)}}):<a title="Add new" class="btn btn-success btn_add_new" href="#">+</a></h3><hr /></td></tr>
				<tr><td>

						<table class="table table-striped table-bordered" cellspacing="0" width="100%">
							<tr class="tr_head2">
								<td>Guardians Names</td>
								<td>Usernames</td>
							</tr>

							@foreach($data->guardians as $guardian)
								<tr>
									<td><a href="/user/{{$guardian->id}}/view">{{$guardian->name}}</a> </td>
									<td>{{$guardian->slug}}</td>
								</tr>
							@endforeach
						</table>

					</td></tr>

				<tr><td><h3>Children ({{count($data->children)}}):<a title="Add new" class="btn btn-success btn_add_new" href="#">+</a></h3><hr /></td></tr>
				<tr><td>

						<table class="table table-striped table-bordered" cellspacing="0" width="100%">
							<tr class="tr_head2">
								<td>Children Names</td>
								<td>Usernames</td>
							</tr>

							@foreach($data->children as $children)
								<tr>
									<td><a href="/user/{{$children->id}}/view">{{$children->name}}</a> </td>
									<td>{{$children->slug}}</td>
								</tr>
							@endforeach
						</table>

					</td></tr>

				<tr><td><h3>Siblings (0):<a title="Add new" class="btn btn-success btn_add_new" href="#">+</a></h3><hr /></td></tr>
				<tr><td>

						<table class="table table-striped table-bordered" cellspacing="0" width="100%">
							<tr class="tr_head2">
								<td>Children Names</td>
								<td>Usernames</td>
							</tr>
							<tr>
									<td>Coming Soon</td>
									<td>Work in progress</td>
								</tr>

						</table>

					</td></tr>


				<tr><td><h3>Roles({{count($data->role)}}):<a title="Add new" class="btn btn-success btn_add_new" href="#">+</a></h3><hr /></td></tr>
				<tr><td>

						<table class="table table-striped table-bordered" cellspacing="0" width="100%">
							<tr class="tr_head2">
								<td>Role</td>
								<td>Description</td>
							</tr>
							@foreach($data->role as $role)
							<tr>
								<td>{{$role->title}}</td>
								<td>{{$role->description}}</td>
							</tr>
							@endforeach
						</table>

					</td></tr>



			</table>

		</div>
	</div>
@stop
