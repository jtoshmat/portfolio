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
    <div class="table-responsive">
        <table id="bars-listing-table" class="table table-hover bar-listings-table" cellspacing="0">
            @foreach($users as $user)
                <tr>
                    <td>
                        <a href="{{ url("admin/users/" . $user->id) }}">{{$user->username}}</a>
                    </td>
                    <td>
                        {{ Form::open(array("url" => "user/delete/".$user->id,)) }}
                        {{ Form::submit("Delete User", ["class" => "btn btn-primary"]) }}
                        {{ Form::close() }}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
@stop
