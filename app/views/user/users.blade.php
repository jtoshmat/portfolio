@extends("layout")

@section("content")
 
 
 <a href="{{ URL::route("user/profile") }}">Home</a> |   >> Users
 <br />
<br />

<div  class="table-responsive">
  <table id="example" class="table table-hover display nowrap dataTable dtr-inline">
  	<thead>
  	<tr>
  		<td>ID</td>
  		<td>Username</td>
  		<td>Email</td>
  		<td>Password</td>
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
  		<td>Password</td>
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
            <td>{{$user->password}}</td>
            <td>{{$user->created_at}}</td>
           <td>{{$user->modified_at}}</td>
            <td>
            	<a class='btn btn-primary' href="{{ route('bars/bar', array('email' => '1')) }}">View</a>
            	<a class='btn btn-warning' href="{{ route('bars/editbar', array('email' => 'use')) }}">Edit</a>
            	<a class='btn btn-danger delete_bar' id='id_2' href=#>Delete</a>
            </td>
         </tr>
    @endforeach
    </tbody>
  </table>
</div>

@stop

