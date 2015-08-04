@extends("layout")
@section("content")
<?php
foreach ($bars as $bar){
}


?>
<div class="container">
  <div class="page-header">
    <h2>{{ $bar->barname }}</h2>
  </div>
  <div class="row">
    <div class="col-sm-8">
      {{ Form::open(array("url" => "editbar/".$bar->id, "class" => "form-signup")) }}
        <div class="form-group">
          {{ Form::label("barname", "Bar Name") }}
          {{Form::text("barname", $bar->barname, ["class" => "form-control", "required"])}}
        </div>
        <div class="form-group">
          {{ Form::label("address", "Address") }}
          {{ Form::text("address", $bar->address, ["class" => "form-control", "required"]) }}
        </div>
        <div class="form-group">
          {{ Form::label("city", "City") }}
          {{ Form::text("city", $bar->city, ["class" => "form-control", "required"]) }}
        </div>
        <div class="row">
          <div  class="col-sm-6">
            <div class="form-group">
              {{ Form::label("state", "State") }}
              {{ Form::select('state', array(
                "AL" => "Alabama",
                "AK" => "Alaska",
                "AZ" => "Arizona",
                "AR" => "Arkansas",
                "CA" => "California",
                "CO" => "Colorado",
                "CT" => "Connecticut",
                "DE" => "Delaware",
                "DC" => "District of Columbia",
                "FL" => "Florida",
                "GA" => "Georgia",
                "HI" => "Hawaii",
                "ID" => "Idaho",
                "IL" => "Illinois",
                "IN" => "Indiana",
                "IA" => "Iowa",
                "KS" => "Kansas",
                "KY" => "Kentucky",
                "LA" => "Louisiana",
                "ME" => "Maine",
                "MD" => "Maryland",
                "MA" => "Massachusetts",
                "MI" => "Michigan",
                "MN" => "Minnesota",
                "MS" => "Mississippi",
                "MO" => "Missouri",
                "MT" => "Montana",
                "NE" => "Nebraska",
                "NV" => "Nevada",
                "NH" => "New Hampshire",
                "NJ" => "New Jersey",
                "NM" => "New Mexico",
                "NY" => "New York",
                "NC" => "North Carolina",
                "ND" => "North Dakota",
                "OH" => "Ohio",
                "OK" => "Oklahoma",
                "OR" => "Oregon",
                "PA" => "Pennsylvania",
                "RI" => "Rhode Island",
                "SC" => "South Carolina",
                "SD" => "South Dakota",
                "TN" => "Tennessee",
                "TX" => "Texas",
                "UT" => "Utah",
                "VT" => "Vermont",
                "VA" => "Virginia",
                "WA" => "Washington",
                "WV" => "West Virginia",
                "WI" => "Wisconsin",
                "WY" => "Wyoming",
              ), $bar->state, ["class" => "form-control", "required"]) }}
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              {{ Form::label("zipcode", "Zip Code") }}
              {{ Form::text("zipcode", $bar->zipcode, ["class" => "form-control", "required"]) }}
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              {{ Form::label("phone", "Phone") }}
              {{ Form::text("phone", $bar->phone, ["class" => "form-control", "required"]) }}
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              {{ Form::label("website", "Website") }}
              {{ Form::text("website", $bar->website, ["class" => "form-control", "placeholder" => "optional"]) }}
            </div>
          </div>
        </div>
        <div class="form-group">
          {!-- TODO: Upload button doesn't work. --}
          <button class="btn btn-default" type="button">Upload Logo</button>
        </div>
        <div class="form-group">
          {{ Form::label("description", "Promo/Description") }}
          {{ Form::textarea("description", $bar->description, ["class" => "form-control", "placeholder" => "optional", "maxlength" => "500"]) }}
          <div class="text-right"><small>500 character limit</small></div>
        </div>
  {{--<tr>
 	<td>Approved: </td>
  <td>
	  {{
	   Form::select('approved', array(1 => 'Approved', 0 => 'Disapproved'), $bar->approved);
	  }}

  </td>
  </tr>

  <tr>
 	<td>Active: </td>
  <td>
	  {{
	   Form::select('active', array(1 => 'Active', 0 => 'Incactive'), $bar->active);
	  }}

  </td>
  </tr>--}}

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
        {{ Form::hidden("id", $bar->id) }}
        <div class="row">
          <div class="col-xs-6">
            <ul class="list-inline edit-bar-actions">
            {!-- TODO: these glyphicon buttons don't work yet. --}
            <li>
              <a href="#"><span class="glyphicon glyphicon-ok" data-toggle="tooltip" data-placement="top" title="Approve" aria-hidden="true"></span><span class="sr-only">Approve Bar</span></a>
            </li>
            <li>
              <a href="#"><span class="glyphicon glyphicon-remove" data-toggle="tooltip" data-placement="top" title="Reject" aria-hidden="true"></span><span class="sr-only">Reject Bar</span></a>
            </li>
            <li>
              <a href="#" id="delete-bar" data-barid="{{ $bar->id }}"><span class="glyphicon glyphicon-trash" data-toggle="tooltip" data-placement="top" title="Delete" aria-hidden="true"></span><span class="sr-only">Delete Bar</span></a>
            </li>
            <li>
          </ul>
        </div>
        <div class="col-xs-6 text-right">
          {{ Form::submit("Update Bar", ["class" => "btn btn-primary"]) }}
        </div>
      {{ Form::close() }}
    </div>
  </div>
</div>
@stop

