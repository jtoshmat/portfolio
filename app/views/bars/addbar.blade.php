@extends("layout")
@section("content")
<?php
$readonly = 'readonly';
if ($admin===1){
	$readonly = '';
}
?>
<div class="container add-bar">
  <div class="page-header">
    <h2>Add a Bar</h2>
  </div>
  <div class="row">
    <div class="col-sm-8">
      {{ Form::open(array("url" => "addbar", "class" => "form-add-bar", "files" => true)) }}
        <div class="form-group">
          {{-- TODO: This needs to have some kind of user lookup to match email to user ID. --}}
          {{ Form::label(null, "Owner/Admin Email Address") }}
          {{Form::email('email', $username,  ["class" => "form-control", ''.$readonly.'', "placeholder" => "email used to login to admin tool"])}}
        </div>
        <div class="form-group">
          {{ Form::label("barname", "Bar Name") }}
          {{ Form::text("barname", Input::old("barname"), ["class" => "form-control", "required"]) }}
        </div>
        <div class="form-group">
          {{ Form::label("address", "Address") }}
          {{ Form::text("address", Input::old("address"), ["class" => "form-control", "required"]) }}
        </div>
        <div class="form-group">
          {{ Form::text("address2", Input::old("address2"), ["class" => "form-control", "placeholder" => "optional"]) }}
        </div>
        <div class="form-group">
          {{ Form::label("city", "City") }}
          {{ Form::text("city", Input::old("city"), ["class" => "form-control", "required"]) }}
        </div>
        <div class="row">
          <div  class="col-sm-6">
            <div class="form-group">
              {{ Form::label("state", "State/Province/Region") }}
              {{-- Add javascript handler to swap this out for a select dropdown as necessary on country field change. --}}
              {{ Form::text("state", Input::old("state"), ["class" => "form-control", "required"]) }}
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              {{ Form::label("zipcode", "Postal Code") }}
              {{ Form::text("zipcode", Input::old("zipcode"), ["class" => "form-control", "required"]) }}
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              {{ Form::label("country", "Country") }}
              {{ Form::select("country", array(
                "AF" => "Afghanistan",
                "AL" => "Albania",
                "DZ" => "Algeria",
                "AS" => "American Samoa",
                "AD" => "Andorra",
                "AO" => "Angola",
                "AI" => "Anguilla",
                "AG" => "Antigua and Barbuda",
                "AR" => "Argentina",
                "AM" => "Armenia",
                "AW" => "Aruba",
                "AU" => "Australia",
                "AT" => "Austria",
                "AZ" => "Azerbaijan",
                "BS" => "Bahamas",
                "BH" => "Bahrain",
                "BD" => "Bangladesh",
                "BB" => "Barbados",
                "BY" => "Belarus",
                "BE" => "Belgium",
                "BZ" => "Belize",
                "BJ" => "Benin",
                "BM" => "Bermuda",
                "BT" => "Bhutan",
                "BO" => "Bolivia",
                "BA" => "Bosnia and Herzegovina",
                "BW" => "Botswana",
                "BR" => "Brazil",
                "VG" => "British Virgin Islands",
                "IO" => "British Indian Ocean Territory",
                "BN" => "Brunei",
                "BG" => "Bulgaria",
                "BF" => "Burkina Faso",
                "BI" => "Burundi",
                "KH" => "Cambodia",
                "CM" => "Cameroon",
                "CA" => "Canada",
                "CV" => "Cape Verde",
                "KY" => "Cayman Islands",
                "CF" => "Central African Republic",
                "TD" => "Chad",
                "CL" => "Chile",
                "CN" => "China",
                "CX" => "Christmas Island",
                "CO" => "Colombia",
                "KM" => "Comoros Islands",
                "CD" => "Congo, Democratic Republic of the",
                "CG" => "Congo, Republic of the",
                "CK" => "Cook Islands",
                "CR" => "Costa Rica",
                "CI" => "Cote D'ivoire",
                "HR" => "Croatia",
                "CY" => "Cyprus",
                "CZ" => "Czech Republic",
                "DK" => "Denmark",
                "DJ" => "Djibouti",
                "DM" => "Dominica",
                "DO" => "Dominican Republic",
                "TP" => "East Timor",
                "EC" => "Ecuador",
                "EG" => "Egypt",
                "SV" => "El Salvador",
                "GQ" => "Equatorial Guinea",
                "ER" => "Eritrea",
                "EE" => "Estonia",
                "ET" => "Ethiopia",
                "FK" => "Falkland Islands (Malvinas)",
                "FO" => "Faroe Islands",
                "FJ" => "Fiji",
                "FI" => "Finland",
                "FR" => "France",
                "GF" => "French Guiana",
                "PF" => "French Polynesia",
                "TF" => "French Southern Territories",
                "GA" => "Gabon",
                "GM" => "Gambia",
                "GE" => "Georgia",
                "DE" => "Germany",
                "GH" => "Ghana",
                "GI" => "Gibraltar",
                "GR" => "Greece",
                "GL" => "Greenland",
                "GD" => "Grenada",
                "GP" => "Guadeloupe",
                "GU" => "Guam",
                "GT" => "Guatemala",
                "GN" => "Guinea",
                "GW" => "Guinea-Bissau",
                "GY" => "Guyana",
                "HT" => "Haiti",
                "VA" => "Holy See (Vatican City State)",
                "HN" => "Honduras",
                "HK" => "Hong Kong",
                "HU" => "Hungary",
                "IS" => "Iceland",
                "IN" => "India",
                "ID" => "Indonesia",
                "IQ" => "Iraq",
                "IE" => "Republic of Ireland",
                "IL" => "Israel",
                "IT" => "Italy",
                "JM" => "Jamaica",
                "JP" => "Japan",
                "JO" => "Jordan",
                "KZ" => "Kazakhstan",
                "KE" => "Kenya",
                "KI" => "Kiribati",
                "KR" => "South Korea",
                "XK" => "Kosovo",
                "KW" => "Kuwait",
                "KG" => "Kyrgyzstan",
                "LA" => "Laos",
                "LV" => "Latvia",
                "LB" => "Lebanon",
                "LS" => "Lesotho",
                "LR" => "Liberia",
                "LI" => "Liechtenstein",
                "LT" => "Lithuania",
                "LU" => "Luxembourg",
                "MO" => "Macau",
                "MK" => "Macedonia",
                "MG" => "Madagascar",
                "MW" => "Malawi",
                "MY" => "Malaysia",
                "MV" => "Maldives",
                "ML" => "Mali",
                "MT" => "Malta",
                "MH" => "Marshall Islands",
                "MQ" => "Martinique",
                "MR" => "Mauritania",
                "MU" => "Mauritius",
                "YT" => "Mayotte",
                "MX" => "Mexico",
                "FM" => "Micronesia",
                "MD" => "Moldova, Republic of",
                "MC" => "Monaco",
                "MN" => "Mongolia",
                "ME" => "Montenegro",
                "MS" => "Montserrat",
                "MA" => "Morocco",
                "MZ" => "Mozambique",
                "MM" => "Myanmar",
                "NA" => "Namibia",
                "NR" => "Nauru",
                "NP" => "Nepal",
                "NL" => "Netherlands",
                "AN" => "Netherlands Antilles",
                "NC" => "New Caledonia",
                "NZ" => "New Zealand",
                "NI" => "Nicaragua",
                "NE" => "Niger",
                "NG" => "Nigeria",
                "NU" => "Niue",
                "NF" => "Norfolk Island",
                "MP" => "Northern Mariana Islands",
                "NO" => "Norway",
                "OM" => "Oman",
                "PK" => "Pakistan",
                "PW" => "Palau",
                "PA" => "Panama",
                "PG" => "Papua New Guinea",
                "PY" => "Paraguay",
                "PE" => "Peru",
                "PH" => "Philippines",
                "PN" => "Pitcairn Island",
                "PL" => "Poland",
                "PT" => "Portugal",
                "PR" => "Puerto Rico",
                "QA" => "Qatar",
                "RE" => "Reunion",
                "RO" => "Romania",
                "RU" => "Russian Federation",
                "RW" => "Rwanda",
                "KN" => "Saint Kitts and Nevis",
                "LC" => "Saint Lucia",
                "VC" => "Saint Vincent and the Grenadines",
                "WS" => "Samoa",
                "SM" => "San Marino",
                "ST" => "Sao Tome and Principe",
                "SA" => "Saudi Arabia",
                "SN" => "Senegal",
                "RS" => "Serbia",
                "SC" => "Seychelles",
                "SL" => "Sierra Leone",
                "SG" => "Singapore",
                "SK" => "Slovakia",
                "SI" => "Slovenia",
                "SB" => "Solomon Islands",
                "SO" => "Somalia",
                "ZA" => "South Africa",
                "ES" => "Spain",
                "LK" => "Sri Lanka",
                "SH" => "St. Helena",
                "PM" => "St. Pierre and Miquelon",
                "SR" => "Suriname",
                "SZ" => "Swaziland",
                "SE" => "Sweden",
                "CH" => "Switzerland",
                "TW" => "Taiwan",
                "TJ" => "Tajikistan",
                "TZ" => "Tanzania",
                "TH" => "Thailand",
                "TG" => "Togo",
                "TK" => "Tokelau",
                "TO" => "Tonga",
                "TT" => "Trinidad and Tobago",
                "TN" => "Tunisia",
                "TR" => "Turkey",
                "TM" => "Turkmenistan",
                "TC" => "Turks and Caicos Islands",
                "TV" => "Tuvalu",
                "UG" => "Uganda",
                "UA" => "Ukraine",
                "AE" => "United Arab Emirates",
                "GB" => "United Kingdom",
                "US" => "United States",
                "UY" => "Uruguay",
                "UZ" => "Uzbekistan",
                "VU" => "Vanuatu",
                "VE" => "Venezuela",
                "VN" => "Viet Nam",
                "VI" => "Virgin Islands (U.S.)",
                "WF" => "Wallis and Futuna Islands",
                "EH" => "Western Sahara",
                "YE" => "Yemen",
                "ZM" => "Zambia",
                "ZW" => "Zimbabwe"
              ), Input::old("country") ? Input::old("country") : "US", ["class" => "form-control", "required"]) }}
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              {{ Form::label("timezone", "Time Zone") }}
              {{ Timezone::selectForm("US/Central", "Select a timezone", ["class" => "form-control", "name" => "timezone"]) }}
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
              {{ Form::label("website", "Website") }} <small class="text-muted">optional</small>
              {{ Form::text("website", Input::old("url"), ["class" => "form-control", "placeholder" => "http://www.mywebsite.com"]) }}
            </div>
          </div>
        </div>
        <div class="form-group">
          {{ Form::label("logo", "Upload Logo") }} <small class="text-muted">optional</small>
          <div class="bar-logo-container">
          </div>
          {{ Form::file('logo', ["class" => "bar-logo-upload", "accept" => "image/x-png, image/gif, image/jpeg"]) }}
        </div>
        <div class="form-group">
          {{ Form::label("description", "Promo/Description") }} <small class="text-muted">optional</small>
          {{ Form::textarea("description", Input::old("description"), ["class" => "form-control character-limit", "maxlength" => "1000"]) }}
          <div class="character-count">1000 characters remaining</div>
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

        <div class="text-right">
          {{ Form::submit("Add Bar", ["class" => "btn btn-primary"]) }}
        </div>
      {{ Form::close() }}
    </div>
  </div>
</div>
@stop
