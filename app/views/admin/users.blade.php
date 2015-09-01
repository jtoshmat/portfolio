@extends("layout")
@section("content")
<div class="container">
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
                </tr>
            @endforeach
        </table>
    </div>
</div>
@stop
