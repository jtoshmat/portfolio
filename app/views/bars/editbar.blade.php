@extends("layout")

@section("content")
 
 <a href="{{ URL::route("user/profile") }}">Bars</a> |  <a href="{{ route('bars/bar', array('id' => $bars->id)) }}">View</a> >> {{$bars->promo}}
 <br />
<br />

<div  class="table-responsive">
  {{ Form::open(array('url' => 'updatebar')) }}
  <table class="table table-hover display nowrap dataTable dtr-inline">
  <tbody>

  <tr>
  	<TR> <TH COLSPAN=2>Editing</TH> </TR>
  </tr>
  
  <tr>
 	<td>ID: </td>
 	<td>1</td>
  </tr>

  <tr>
 	<td>Bar Name: </td>
  <td>{{Form::text('promo', $bars->promo);}}</td>
  </tr>

  <tr>
 	<td>Address: </td>
  <td>{{Form::text('address', $bars->address);}}</td>
  </tr>

  <tr>
 	<td>City: </td>
  <td>{{Form::text('city', $bars->city);}}</td>
  </tr>

  <tr>
 	<td>Zip Code: </td>
  <td>{{Form::text('zipcode', $bars->zipCode);}}</td>
  </tr>

  <tr>
 	<td>More: </td>
  <td>{{Form::text('name', 'Something else');}}</td>
  </tr>

  <tr>
    <TR> <TH COLSPAN=2 style='text-align:center'> 
      {{ Form::hidden('id', $bars->id) }}
      {{Form::reset('Reset')}}
      {{ Form::submit('Update', ['name' => 'submit']) }}
        </TH> </TR>
  </tr>

  </tbody>
  </table>
  {{ Form::close() }}
</div>
@stop
 
 
