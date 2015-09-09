@extends("layout")
@section("content")
<div class="container">
  @if(Session::has('message'))
  <div class="alert alert-success" role="alert">
    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
    <span class="sr-only">Error:</span>
    {{ Session::get('message') }}
  </div>
  @endif
  @if(Session::has('error'))
  <div class="alert alert-danger" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span class="sr-only">Error:</span>
    {{ Session::get('error') }}
  </div>
  @endif
  <div class="page-header">
    <h2>Edit Users</h2>
  </div>
  <div class="table-responsive loading">
    <table id="user-listing-table" class="table table-hover user-listings-table" cellspacing="0">
      <thead>
        <tr>
          <th>ID</th>
          <th>Username</th>
          <th>Role</th>
          <th>Created On</th>
          <th><span class="sr-only">Actions</span></th>
        </tr>
      </thead>
      <tbody>
      @foreach($users as $user)
        <tr>
          <td>{{ $user->id }}</td>
          <td>
            <a href="{{ url("admin/users/" . $user->id) }}">{{$user->username}}</a>
          </td>
          <td>
          @if ($user->admin == 1)
            Admin
          @else
            Bar Owner
          @endif
          </td>
          <td>
            {{$user->created_at}}
          </td>
          <td>
            <div class="edit-actions">
            {{ Form::open(array("url" => "user/delete/".$user->id, "class" => "delete-user-form")) }}
              <a href="{{ url("admin/users/" . $user->id) }}"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="bottom" title="Edit" aria-hidden="true"></span><span class="sr-only"><span class="sr-only">Edit User</span></a>
              <a href="#" class="delete-user"><span class="glyphicon glyphicon-trash" data-toggle="tooltip" data-placement="bottom" title="Delete" aria-hidden="true"></span><span class="sr-only">Delete User</span></a>
            {{ Form::close() }}
            </div>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>
@stop
