@extends("layout")

@section("content")

<br />

<?php
foreach ($bars as $bar){
}


?>

<ul>
	@foreach($errors->all() as $error)
		<li>{{ $error }}</li>
	@endforeach
</ul>

<div  class="table-responsive">

	<a class='btn btn-warning' href="{{ route('games/addgame', array('id' => $bar->id)) }}">Add Game</a>

  {{ Form::open(array('url' => 'editbar')) }}
  <table class="table table-hover display nowrap dataTable dtr-inline">
  <tbody>

  <tr>
  	<TR> <TH COLSPAN=2>Editing</TH> </TR>
  </tr>

  <tr>
	  <td>Logo:</td>
	  <td>
		  <?php

		  $root = $_SERVER["DOCUMENT_ROOT"];
		  $bar->filename = empty($bar->filename)?'/img/yourcompanylogo.png':'/img/uploads/'.$bar->filename;
			  ?>
		  <img class="barlogo" src="{{$bar->filename}}">
	  <br />
		  <img class="upload_user_image" id="id_{{$bar->id}}" src="img/upload.png">

	  </td>
  </tr>

  <tr>
 	<td>ID: </td>
 	<td>{{$bar->id}}</td>
  </tr>

  <tr>
 	<td>Bar Name: </td>
  <td>{{Form::text('barname', $bar->barname)}}</td>
  </tr>

  <tr>
 	<td>Address: </td>
  <td>{{Form::text('address', $bar->address)}}</td>
  </tr>

  <tr>
 	<td>City: </td>
  <td>{{Form::text('city', $bar->city)}}</td>
  </tr>

  <tr>
 	<td>State: </td>
  <td>{{Form::text('state', $bar->state)}}</td>
  </tr>

  <tr>
 	<td>Zip Code: </td>
  <td>{{Form::text('zipcode', $bar->zipcode)}}</td>
  </tr>


  <tr>
 	<td>Approved: </td>
  <td>
	  {{
	   Form::select('approved', array(1 => 'Approved', 0 => 'Disapproved'), $bar->approved);
	  }}

  </td>
  </tr>

  <tr>
 	<td>Active: </td>
  <td>
	  {{
	   Form::select('active', array(1 => 'Active', 0 => 'Incactive'), $bar->active);
	  }}

  </td>
  </tr>


  <tr>
    <TR> <TH COLSPAN=2 style='text-align:center'> 
  
      {{Form::reset('Reset')}}
		  {{Form::hidden('id', $bar->id)}}
      {{ Form::submit('Update', ['name' => 'submit']) }}
        </TH> </TR>
  </tr>

  </tbody>
  </table>
  {{ Form::close() }}
</div>
@stop
 
 
