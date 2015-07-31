
<ul>
	@foreach($errors->all() as $error)
		<li>{{ $error }}</li>
	@endforeach
</ul>

@if(!isset($action))



{{ Form::open(array('url' => 'upload/1', 'files' => true)) }}
<p>Upload your logo</p>

<p>
	{{ Form::label('avatar', 'Avatar') }}
	{{ Form::file('avatar') }}
	{{ Form::hidden('bid', $bid) }}
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