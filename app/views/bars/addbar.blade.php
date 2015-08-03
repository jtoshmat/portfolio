@extends("layout")
@section("content")
<div class="container">
  <div class="row">
    <div class="col-sm-6">
      <div class="panel panel-default">
        <div class="panel-heading"><h2 class="panel-title">Add a Bar</h2></div>
        <div class="panel-body">
        {{ Form::open(array("url" => "addbar", "class" => "form-signup")) }}
          <div class="form-group">
            {{ Form::label("barname", "Bar Name") }}
            {{ Form::text("barname", Input::old("barname"), ["class" => "form-control", "required"]) }}
          </div>
          <div class="form-group">
            {{ Form::label("address", "Address") }}
            {{ Form::text("address", Input::old("address"), ["class" => "form-control", "required"]) }}
          </div>
          <div class="form-group">
            {{ Form::label("city", "City") }}
            {{ Form::text("city", Input::old("city"), ["class" => "form-control", "required"]) }}
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                {{ Form::label("zipcode", "Zip Code") }}
                {{ Form::text("zipcode", Input::old("zipcode"), ["class" => "form-control", "required"]) }}
              </div>
            </div>
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
                ), Input::old("state"), ["class" => "form-control", "required"]) }}
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                {{ Form::label("phone", "Phone") }}
                {{ Form::text("phone", Input::old("phone"), ["class" => "form-control", "required"]) }}
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                {{ Form::label("website", "Website") }}
                {{ Form::text("website", Input::old("url"), ["class" => "form-control", "placeholder" => "optional"]) }}
              </div>
            </div>
          </div>
          <div class="form-group">
            <button class="btn btn-default" type="button" disabled="">Upload Logo</button>
          </div>
          <div class="form-group">
            {{ Form::label("description", "Promo/Description") }}
            {{ Form::textarea("description", Input::old("description"), ["class" => "form-control", "placeholder" => "optional"]) }}
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

          {{ Form::submit("Add Bar", ["class" => "btn btn-primary"]) }}
        {{ Form::close() }}
        </div>
      </div>
    </div>
  </div>
</div>
@stop
