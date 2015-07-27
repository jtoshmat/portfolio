@extends("layout")

@section("content")

 
 <a href="{{ URL::route("bars") }}">Home</a> |  <a href="{{ URL::route("register") }}">Register</a>  >> Users
 <br />
<br />

@if($message)
 <ul>

		 <li>{{ $message}}</li>

 </ul>
@endif

<div  class="table-responsive">
  <table id="example" class="table table-hover display nowrap dataTable dtr-inline">
  	<thead>
  	<tr>
  		<td>ID</td>
  		<td>Username</td>
  		<td>Email</td>
  		<td>Created</td>
  		<td>Modified</td>
  		<td>Action</td>
  	</tr>
  </thead>
  <tfoot>
  	<tr>
  		<td>ID</td>
  		<td>Username</td>
  		<td>Email</td>
  		<td>Created</td>
  		<td>Modified</td>
  		<td>Action</td>
  	</tr>
  </tfoot>
  <tbody>
        @foreach($users as $user)
         <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->username}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->created_at}}</td>
           <td>{{$user->updated_at}}</td>
            <td>
            	<a class='btn btn-primary' href="{{ route('user/viewuser', array('id' => $user->id)) }}">View</a>
            	<a class='btn btn-warning' href="{{ route('user', array('id' => $user->id)) }}">Edit</a>
            	<a class='btn btn-danger delete_user' id='id_{{$user->id}}' href=#>Delete</a>
            </td>
         </tr>
    @endforeach
    </tbody>
  </table>
</div>

@stop

