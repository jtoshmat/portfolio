@extends("layout")
@section("content")


	<ul>
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>

	@if(!isset($action))



		{{ Form::open(array('url' => 'uploadcsv', 'files' => true)) }}
		<p>Upload your logo</p>

		<p>
			{{ Form::label('filename', 'CSV File') }}
			{{ Form::file('csvfile') }}
			{{ Form::hidden('bid', 1) }}
		</p>

		<p>
			{{ Form::submit('Submit') }}
		</p>
		{{ Form::close() }}
	@else
		<hr />
		<div style="text-align: center"><button onclick="window.close();"  id="close_upload_window">Close the
				window</button></div>
	@endif


	<script type="text/javascript">
		window.opener.location.href = window.opener.location.href;
	</script>



@stop
