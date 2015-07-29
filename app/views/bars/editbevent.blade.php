@extends("layout")

@section("content")
<h2>Page status: Work in progress</h2>

<div  class="table-responsive">
  {{ Form::open(array('url' => 'editbevent/'.$bevent->bid)) }}
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
 	<td>Event Name: </td>
  <td>{{Form::text('title', $bevent->title);}}</td>
  </tr>

  <tr>
 	<td>Address: </td>
  <td>.</td>
  </tr>

  <tr>
 	<td>1111 </td>
  <td>.</td>
  </tr>

  <tr>
 	<td>Zip Code: </td>
  <td>.</td>
  </tr>

  <tr>
 	<td>More: </td>
  <td>.</td>
  </tr>

  <tr>
    <TR> <TH COLSPAN=2 style='text-align:center'> 
      {{ Form::hidden('id', $bevent->id) }}
      {{Form::reset('Reset')}}
      {{ Form::submit('Update', ['name' => 'submit']) }}
        </TH> </TR>
  </tr>

  </tbody>
  </table>
  {{ Form::close() }}
</div>
@stop
 
 
