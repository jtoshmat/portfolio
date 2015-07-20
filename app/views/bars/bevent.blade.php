

@extends("layout")

@section("content")

<br />

<div  class="table-responsive">
  <table class="table table-hover display nowrap dataTable dtr-inline">
  
  <tbody>
  <tr>
  	<tr> <th colspan=2>Viewing</th> </tr>
  </tr>
  
  <tr>
 	<td>ID: </td>
 	<td>{{$bevent->id}}</td>
  </tr>

  <tr>
 	<td>Bar ID: </td>
 	<td>{{$bevent->barid}}</td>
  </tr>

  <tr>
 	<td>Title: </td>
 	<td>{{$bevent->title}}</td>
  </tr>

  <tr>
 	<td>Created: </td>
 	<td>{{$bevent->created_at}}</td>
  </tr>

  <tr>
 	<td>Updated: </td>
 	<td>{{$bevent->updated_at}}</td>
  </tr>

  <tr>
 	<td>More: </td>
 	<td>Something else</td>
  </tr>

  </tbody>
  </table>
</div>

@stop