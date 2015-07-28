@extends("layout")

@section("content")


<div  class="table-responsive">
  {{ Form::open(array('url' => 'addbevent')) }}
  <table class="table table-hover display nowrap dataTable dtr-inline">
  <tbody>

  <tr>
  	<TR> <TH COLSPAN=2>Adding a new event</TH> </TR>
  </tr>


  <tr>
 	<td>Event Title: </td>
  <td>{{Form::text('title');}}</td>
  </tr>


  <tr>
    <TR> <TH COLSPAN=2 style='text-align:center'>
		  {{Form::hidden('uid', $uid)}}
		  {{Form::hidden('barid', $barid)}}
		  {{Form::reset('Reset')}}
		  {{ Form::submit('Add', ['name' => 'submit']) }}
        </TH> </TR>
  </tr>

  </tbody>
  </table>
  {{ Form::close() }}
</div>
@stop
 
 
