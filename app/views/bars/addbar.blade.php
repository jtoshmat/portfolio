@extends("layout")

@section("content")
 
<br />


<ul>
	@foreach($errors->all() as $error)
		<li>{{ $error }}</li>
	@endforeach
</ul>


<div  class="table-responsive">
  {{ Form::open(array('url' => 'addbar')) }}
  <table class="table table-hover display nowrap dataTable dtr-inline">
  <tbody>

  <tr>
  	<TR> <TH COLSPAN=2>Editing</TH> </TR>
  </tr>
  


  <tr>
 	<td>Bar Name: </td>
  <td>{{Form::text('barname')}}</td>
  </tr>

  <tr>
 	<td>Address: </td>
  <td>{{Form::text('address')}}</td>
  </tr>

  <tr>
 	<td>City: </td>
  <td>{{Form::text('city')}}</td>
  </tr>


  <tr>
 	<td>State: </td>
  <td>{{Form::text('state')}}</td>
  </tr>

  <tr>
 	<td>Zip Code: </td>
  <td>{{Form::text('zipcode')}}</td>
  </tr>




  <tr>
    <TR> <TH COLSPAN=2 style='text-align:center'> 
     
      {{Form::reset('Reset')}}
      {{ Form::submit('Add', ['name' => 'submit']) }}
        </TH> </TR>
  </tr>

  </tbody>
  </table>
  {{ Form::close() }}
</div>
@stop
 
 
