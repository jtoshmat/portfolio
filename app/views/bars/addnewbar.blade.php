@extends("layout")

@section("content")
 
<br />

<div  class="table-responsive">
  {{ Form::open(array('url' => 'addnewbar')) }}
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
  <td>{{Form::text('promo', '')}}</td>
  </tr>

  <tr>
 	<td>Address: </td>
  <td>{{Form::text('address', '')}}</td>
  </tr>

  <tr>
 	<td>City: </td>
  <td>{{Form::text('city', '')}}</td>
  </tr>

  <tr>
 	<td>Zip Code: </td>
  <td>{{Form::text('zipcode', '')}}</td>
  </tr>

  <tr>
 	<td>More: </td>
  <td>{{Form::text('name', 'Something else')}}</td>
  </tr>

  <tr>
    <TR> <TH COLSPAN=2 style='text-align:center'> 
     
      {{Form::reset('Reset')}}
      {{ Form::submit('Update', ['name' => 'submit']) }}
        </TH> </TR>
  </tr>

  </tbody>
  </table>
  {{ Form::close() }}
</div>
@stop
 
 
