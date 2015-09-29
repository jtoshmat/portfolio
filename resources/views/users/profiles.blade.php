@extends('master')
@section('content')
<style type="text/css">
	.profiles_avatar{
		width: 50px;
		height:50px;
	}

	.myownprofile_class{
		background: #D9EDF7 !important;
		color: #204D74 !important;
	}
	.inactive_profiles{
		background: #000 !important;
	}


</style>
	<div class="panel panel-info">

		<div class="panel-body" style="padding-top:30px">

			<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
				<tr>
					<th>Avatar</th>
					<th>Name</th>
					<th>Email</th>
					<th>Admin</th>
					<th>Active</th>
					<th>Expired</th>
					<th>Created</th>
					<th>Last updated</th>
					<th>Action</th>
				</tr>
				</thead>

				<tfoot>
				<tr>
					<th>Avatar</th>
					<th>Name</th>
					<th>Email</th>
					<th>Admin</th>
					<th>Active</th>
					<th>Expired</th>
					<th>Created</th>
					<th>Last Updated</th>
					<th>Action</th>
				</tr>
				</tfoot>

				<tbody>
				@foreach($users as $user)
				<?php
					$myownprofile_class = '';

					if(Auth::user()->id == $user->id){
						$myownprofile_class = "class=myownprofile_class";
					}

				?>

				<tr {{$myownprofile_class}}>
					<td><img class="profiles_avatar" src="../../img/users/{{$user->avatar}}"></td>
					<td>{{$user->name}}</td>
					<td>{{$user->email}}</td>
					<td>{{($user->role)?'Yes':'No'}}</td>
					<td>{{($user->active)?'Yes':'No'}}</td>
					<td>coming</td>
					<td>{{$user->created_at}}</td>
					<td>{{$user->updated_at}}</td>
					<td>
						@if($admin==1)
							@if($user->role==1)
								<a class="btn btn-default" href="admin/{{$user->id}}/nonadmin">NonAdmin</a>
							@else
								<a class="btn btn-danger" href="admin/{{$user->id}}/admin">Make Admin</a>
							@endif
						@endif

						<a class="btn btn-info" href="{{url('users/profile/'.$user->id)}}">Edit</a>

						@if($admin==1)
							@if($user->active==1)
								<a class="btn btn-danger" href="activate/{{$user->id}}/deactivate">Deactivate</a>
							@else
								<a class="btn btn-success" href="activate/{{$user->id}}/activate">Activate</a>
							@endif
						@endif
					</td>
				</tr>
				@endforeach
				</tbody>
			</table>
			@if ($admin==1)
			<div class="pagination"><?php echo $users->render(); ?></div>
			@endif
		</div>
	</div>
@stop
