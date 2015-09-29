@extends('master')
@section('content')

	@if (count($errors) > 0)
		<div class="alert alert-danger" role="alert">
			@foreach($errors->all() as $error)
				<p>
					<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
					<span class="sr-only">Error:</span>
					{{ $error }}
				</p>
			@endforeach
		</div>
	@endif

	<div class="panel panel-info">
	<h1>Payment Center</h1>
	</div>
@stop
