@extends("layout")

@section("content")
  <h2>Hello {{ Auth::user()->username }}</h2>
  <p>Welcome to your sparse profile page.</p>

<div  class="table-responsive">
  <table id="example" class="table table-hover display nowrap dataTable dtr-inline">
  	<thead>
  	<tr>
  		<td>ID</td>
  		<td>Promo</td>
  		<td>Address</td>
  		<td>City</td>
  		<td>Zip Code</td>
  		<td>Created</td>
  		<td>Action</td>
  	</tr>
  </thead>
  <tfoot>
  	<tr>
  		<td>ID</td>
  		<td>Promo</td>
  		<td>Address</td>
  		<td>City</td>
  		<td>Zip Code</td>
  		<td>Created</td>
  		<td>Action</td>
  	</tr>
  </tfoot>
  <tbody>
        @foreach($bars as $bar)
         <tr>
            <td>{{$bar->id}}</td>
            <td>{{$bar->promo}}</td>
            <td>{{$bar->address}}</td>
            <td>{{$bar->city}}</td>
            <td>{{$bar->zipCode}}</td>
            <td>{{$bar->created_at}}</td>
            <td>
            	<a class='btn btn-primary' href=#>View</a>
            	<a class='btn btn-warning' href=#>Edit</a>
            	<a class='btn btn-danger' href=#>Delete</a>
            </td>
         </tr>
    @endforeach
    </tbody>
  </table>
</div>

@stop
