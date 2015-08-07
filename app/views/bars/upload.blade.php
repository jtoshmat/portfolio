<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="/css/main.css">
  <title>Packers Everywhere</title>
</head>
<body>
  <div class="container">
    <div class="panel panel-default" style="margin-top: 15px;">
      <div class="panel-heading"><h2 class="panel-title">Upload Logo</h2></div>
      <div class="panel-body">
      {{ Form::open(array('url' => 'upload/'. $bid, 'files' => true, 'id' => 'upload-form')) }}
        @if ($filename)
        <div class="text-center">
          <img src="/img/uploads/{{ $filename }}" alt="">
        </div>
        <script>
          if (window.localStorage) {
            localStorage.setItem('barFile', '/img/uploads/{{ $filename }}');
          }
        </script>
        @endif

        <div class="form-group">
          {{ Form::label('avatar', 'Choose an image') }}
        	{{ Form::file('avatar', null, ["accept" => "image/x-png, image/gif, image/jpeg"]) }}
        	{{ Form::hidden('bid', $bid) }}
        </div>
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
        {{ Form::submit("Submit", ["class" => "btn btn-primary"]) }}
        <button type="button" class="btn btn-default" onclick="window.close();">Close Window</button>
      {{ Form::close() }}
      </div>
    </div>
  </div>
</body>
</html>
