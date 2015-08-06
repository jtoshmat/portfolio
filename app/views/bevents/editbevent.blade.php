@extends("layout")

@section("content")

	<ul>
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>

<div  class="table-responsive">
  {{ Form::model($bevent, array('url' => 'editbevent/'.$bevent->bid)) }}
  <table class="table table-hover display nowrap dataTable dtr-inline">
  <tbody>

  <tr>
  	<TR> <TH COLSPAN=2>Editing</TH> </TR>
  </tr>


  <tr>
 	<td>Event Name: </td>
  <td>{{Form::text('title')}}</td>
  </tr>


  <tr>
    <TR> <TH COLSPAN=2 style='text-align:center'> 
      {{ Form::hidden('bid', $bevent->id) }}
      {{Form::reset('Reset')}}
      {{ Form::submit('Update', ['name' => 'submit']) }}
        </TH> </TR>
  </tr>

  </tbody>
  </table>
  {{ Form::close() }}
</div>
@stop
 
 
