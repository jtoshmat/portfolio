@extends('master')
@section('content')
	<style type="text/css">
		.tr_head{
			background: #5bc0de;
		}
	</style>
	<div class="panel panel-info">

		<div class="panel-body" style="padding-top:30px">
			<h2>Users -> Roles</h2>
			<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
				<tr class="tr_head">

					<th>Name</th>
					<th>Email</th>
					<th>Roles</th>
					<th>Created</th>
					<th>Last updated</th>
				</tr>
				</thead>

				<tfoot>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Roles</th>
					<th>Created</th>
					<th>Last Updated</th>
				</tr>
				</tfoot>

				<tbody>
				@foreach($members as $member)
					<tr>
						<td><a href="member/{{$member->id}}/view">{{$member->name}}</a></td>
						<td><a href="member/{{$member->id}}/view">{{$member->email}}</a></td>
						<td>
							@foreach($member->role as $role)
								<a href="#">{{$role->title}}</a>,
							@endforeach


						</td>
						<td>{{$member->created_at}}</td>
						<td>{{$member->updated_at}}</td>

					</tr>
				@endforeach
				</tbody>
			</table>
			<div class="pagination"><?php echo $members->render(); ?></div>

		</div>
	</div>
@stop
