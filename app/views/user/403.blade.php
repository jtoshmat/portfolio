@extends("layout")

@section("content")
 
 

<div  class="table-responsive">
 <h1>{{ Auth::user()->username }}<br /> I am sorry you are not authorized to view this page <br /> Please contact the site administrator</h1>
</div>

@stop
