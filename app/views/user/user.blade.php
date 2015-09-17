@extends("layout")
@section("content")
  <div class="container edit-user">
    <div class="page-header">
      <h2>Edit User <small>{{ $user->username }}</small></h2>
    </div>
    <div class="row">
      <div class="col-sm-8">
        {{ Form::open(array("url" => "user/edit", "class" => "form-edit-user")) }}
        <div class="form-group">
          {{ Form::label("username", "Username") }}
          {{ Form::email("username", $user->username,  ["class" => "form-control", "readonly", "placeholder" => "email used to login to admin tool", "required"]) }}
        </div>
        <div class="form-group">
          {{ Form::label("email", "Email") }}
          {{ Form::text("email", $user->email, ["class" => "form-control", "required"]) }}
        </div>
        <div class="form-group">
          {{ Form::label("password", "Password") }}
          {{ Form::password("password", ["class" => "form-control", "placeholder" => "Enter and confirm new password to change."]) }}
        </div>
        <div class="form-group">
          {{ Form::label("password_confirmation", "Confirm Password") }}
          {{ Form::password("password_confirmation", ["class" => "form-control"]) }}
        </div>
        @if (count($errors) > 0)
        <?php
         foreach($errors->all() as $error){
             $class = 'alert alert-danger';  
             if($error=='Updated'){
                $class = 'alert alert-success'; 
             }
         }
         ?>
        <div class="{{$class}}" role="alert">
          @foreach($errors->all() as $error)
            <p>
              <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
              <span class="sr-only">Error:</span>
              {{ $error }}
            </p>
          @endforeach
        </div>
        @endif
        {{ Form::hidden("id", $user->id) }}
        <div class="row">
          <div class="col-xs-6">
            {{-- TODO(jjandoc): Add in functional delete button for admins. --}}
            {{-- @if ($admin)
            <ul id="edit-user-actions" class="list-inline edit-actions">
              <li>
                {{ Form::open(array("url" => "user/delete/".$user->id, "class" => "delete-user-form")) }}
                <a href="#" id="delete-user"><span class="glyphicon glyphicon-trash" data-toggle="tooltip" data-placement="bottom" title="Delete" aria-hidden="true"></span><span class="sr-only">Delete User</span></a>
                {{ Form::close() }}
              </li>
            </ul>
            @endif --}}
          </div>
          <div class="col-xs-6 text-right">
            {{ Form::submit("Update", ["class" => "btn btn-primary"]) }}
          </div>
        </div>
        {{ Form::close() }}
      </div>
    </div>
  </div>
@stop
