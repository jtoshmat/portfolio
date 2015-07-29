@extends("layout")

@section("content")
 
 <a href="{{ URL::route("bars") }}">Bars</a> | <a  href="{{ route('bars/editbar', array('id' => $bars->id))
 }}">Edit</a>  >> {{$bars->promo}}
 <br />
<br />

<div  class="table-responsive">
	<a class='btn btn-warning' href="{{ route('games/addgame', array('id' => $bars->id)) }}">Add Game</a>
  <table class="table table-hover display nowrap dataTable dtr-inline">
  
  <tbody>
  <tr>
  	<tr> <th colspan=2>Viewing</th> </tr>
  </tr>
  
  <tr>
 	<td>ID: </td>
 	<td>1</td>
  </tr>

  <tr>
 	<td>Bar Name: </td>
 	<td>{{$bars->promo}}</td>
  </tr>

  <tr>
 	<td>Address: </td>
 	<td>{{$bars->address}}</td>
  </tr>

  <tr>
 	<td>City: </td>
 	<td>{{$bars->city}}</td>
  </tr>

  <tr>
 	<td>Zip Code: </td>
 	<td>{{$bars->zipcode}}</td>
  </tr>

  <tr>
 	<td>More: </td>
 	<td>Something else</td>
  </tr>

  </tbody>
  </table>

</div>

@stop