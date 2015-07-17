@extends('layout')

@section('content')
  <h2>Welcome "{{ Auth::user()->username }}" to the protected page!</h2>
  <p>Your user ID is: {{ Auth::user()->id }}</p>
@stop

<?php
$bars = DB::table('bars')->select('id', 'promo', 'address','city','zipCode')->get();

?>



<table class="table">
	<tr>
		<td>ID</td>
		<td>Name</td>
		<td>Address</td>
		<td>City</td>
		<td>Zip Code</td>
	</tr>

	<?php
		foreach ($bars as $bar):
	?>
	<tr>
		<td>{{$bar->id}}<td>
		<td>{{$bar->promo}}<td>
		<td>{{$bar->address}}<td>
		<td>{{$bar->city}}<td>
		<td>{{$bar->zipCode}}<td>
	</tr>
	<?php
		endforeach;
	?>
</table>