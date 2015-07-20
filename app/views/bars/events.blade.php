
@extends("layout")

@section("content")
 
 
 <a href="{{ URL::route("user/profile") }}">Home</a> |   >> Events
 <br />
<br />

<div  class="table-responsive">
  <table id="example" class="table table-hover display nowrap dataTable dtr-inline">
  	<thead>
  	<tr>
  		<td>ID</td>
  		<td>Bar ID</td>
  		<td>Title</td>
  		<td>Dscription</td>
  		<td>Created</td>
  		<td>Modified</td>
  		<td>Action</td>
  	</tr>
  </thead>
  <tfoot>
  	<tr>
  		<td>ID</td>
  		<td>Bar ID</td>
  		<td>Title</td>
  		<td>Dscription</td>
  		<td>Created</td>
  		<td>Modified</td>
  		<td>Action</td>
  	</tr>
  </tfoot>
  <tbody>
        @foreach($events as $event)
         <tr>
            <td>Coming soon</td>
            <td>...</td>
            <td>...</td>
            <td>...</td>
            <td>...</td>
           <td>...</td>
            <td>
            	<a class='btn btn-primary' href="{{ route('bars/events', array('id' => '1')) }}">View</a>
            	<a class='btn btn-warning' href="{{ route('bars/events', array('id' => '1')) }}">Edit</a>
            	<a class='btn btn-danger delete_event' id='id_2' href=#>Delete</a>
            </td>
         </tr>
    @endforeach
    </tbody>
  </table>
</div>

@stop

