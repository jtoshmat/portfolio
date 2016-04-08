@extends('layouts.master')
@section('content')



    @include('layouts.header', ['some' => 'data'])

    <div id="pin-bar" class="loggedin-yes">

        <div class="item">
            <a href="#main">Home</a>
        </div>

        <div class="item">
            <a href="#caretraxx-usage-mobile-checkin">
                Mobile checkin
            </a>
            <a href="" class="pin"></a>
        </div>

        <div class="pin-view">
            <a href="">pin current view</a>
        </div>
    </div>

    <div class="feedback">
        <a href="">feedback</a>
    </div>

        <section id="main" class="notabs">
            <div class="login loggedin-no">
                <h1>Please Login</h1>
                @include('forms.login', ['some' => 'data'])
            </div>
            <div class="loggedin-yes initial">
                <div class="col-third">
                    <a href="#caretraxx-usage-enrollment" class="button-large">
                        <img src="img/btn-caretraxx.png" alt="caretraxx Usage">
                        caretraxx Usage
                    </a>
                </div>
                <div class="col-third">
                    <a href="#patient-flow-wait-time" class="button-large">
                        <img src="img/btn-patient-flow.png" alt="Patient Flow">
                        Patient Flow
                    </a>
                </div>
                <div class="col-third">
                    <a href="#care-quality-response-rate" class="button-large">
                        <img src="img/btn-care-quality.png" alt="Care Quality">
                        Care Quality
                    </a>
                </div>
            </div>
        </section>

        <section id="forgot-pass" class="notabs">
            <div class="login">
                <h1>Forgot password</h1>
                <form action="#" id="pass-form">
                    <label>
                        enter email
                        <input name="userid" type="text" placeholder="user@example.com">
                    </label>
                    <a href="#main">Back</a>
                    <button>Send</button>
                </form>
            </div>
        </section>

        <section id="forgot-pass-sent" class="notabs">
            <div class="login">
                <h1>New password sent</h1>
                <p>A new password has been generated and sent to your email adress.</p>
                <p>Please, check your inbox in a few minutes.</p>
                <p>Make sure to change your password after login to keep your account secure.</p>
                <button onclick="logout(); return false;">Back</button>
            </div>
        </section>

        <!-- caretraxx USAGE -->

        <section id="caretraxx-usage-enrollment" data-category="caretraxx-usage">
            <h1>caretraxx Usage</h1>
            <div class="breadcrums">
                <a href="#caretraxx-usage">caretraxx Usage</a>
                &gt;
                <a href="#caretraxx-usage-enrollment">Enrollment</a>
            </div>
            <ul class="tabs">
                <li><a href="#caretraxx-usage-enrollment" class="active">Enrollment</a></li>
                <li><a href="#caretraxx-usage-mobile-checkin">Mobile Checkin</a></li>
                <li><a href="#caretraxx-usage-chat">Chat</a></li>
                <li><a href="#caretraxx-usage-mobile-appointments">Mobile Appointments</a></li>
            </ul>
            <div id="chart2a" class="chartcontainer"></div>
            <!-- img src="img/line-graph-placeholder.png" alt="caretraxx usage enrollment graph" -->
            <a href="#caretraxx-usage-enrollment-month">
            </a>
        </section>
        <section id="caretraxx-usage-enrollment-month" data-category="caretraxx-usage" data-subcategory="caretraxx-usage-enrollment">
            <h1>caretraxx Usage</h1>
            <div class="breadcrums">
                <a href="#caretraxx-usage-enrollment">caretraxx Usage</a>
                &gt;
                <a href="#caretraxx-usage-enrollment">Enrollment</a>
                &gt;
                <a href="#caretraxx-usage-enrollment-month">June 2015</a>
            </div>
            <ul class="tabs">
                <li><a href="#caretraxx-usage-enrollment" class="active" data-subcategory="caretraxx-usage-enrollment">Enrollment</a></li>
                <li><a href="#caretraxx-usage-mobile-checkin">Mobile Checkin</a></li>
                <li><a href="#caretraxx-usage-chat">Chat</a></li>
                <li><a href="#caretraxx-usage-mobile-appointments">Mobile Appointments</a></li>
            </ul>
            <div class="slide">
                <a href="#caretraxx-usage-enrollment" class="close-x">
                    <img src="img/close.png" alt="close">
                </a>
                <div id="chart2a-month" class="chartcontainer"></div>
                <!-- img src="img/pie-graph-placeholder.png" alt="caretraxx usage enrollment monthly graph"-->
            </div>
            <div></div>
        </section>

        <section id="caretraxx-usage-mobile-checkin" data-category="caretraxx-usage">
            <h1>caretraxx Usage</h1>
            <div class="breadcrums">
                <a href="#caretraxx-usage-enrollment">caretraxx Usage</a>
                &gt;
                <a href="#caretraxx-usage-mobile-checkin">Mobile Checkin</a>
            </div>
            <ul class="tabs">
                <li><a href="#caretraxx-usage-enrollment">Enrollment</a></li>
                <li><a href="#caretraxx-usage-mobile-checkin" class="active">Mobile Checkin</a></li>
                <li><a href="#caretraxx-usage-chat">Chat</a></li>
                <li><a href="#caretraxx-usage-mobile-appointments">Mobile Appointments</a></li>
            </ul>
            <div id="chart2b" class="chartcontainer"></div>
            <!--img src="img/line-graph-placeholder.png" alt="caretraxx usage mobile login graph"-->
            <div></div>
        </section>

        <section id="caretraxx-usage-chat" data-category="caretraxx-usage">
            <h1>caretraxx Usage</h1>
            <div class="breadcrums">
                <a href="#caretraxx-usage-enrollment">caretraxx Usage</a>
                &gt;
                <a href="#caretraxx-usage-chat">Chat</a>
            </div>
            <ul class="tabs">
                <li><a href="#caretraxx-usage-enrollment">Enrollment</a></li>
                <li><a href="#caretraxx-usage-mobile-checkin">Mobile Checkin</a></li>
                <li><a href="#caretraxx-usage-chat" class="active">Chat</a></li>
                <li><a href="#caretraxx-usage-mobile-appointments">Mobile Appointments</a></li>
            </ul>
            <div id="chart2c" class="chartcontainer"></div>
            <!-- img src="img/line-graph-placeholder.png" alt="caretraxx usage chat graph"-->
            <a href="#caretraxx-usage-chat-monthly">
            </a>
            <div></div>
        </section>
        <section id="caretraxx-usage-chat-monthly" data-category="caretraxx-usage" data-subcategory="caretraxx-usage-chat">
            <h1>caretraxx Usage</h1>
            <div class="breadcrums">
                <a href="#caretraxx-usage-enrollment">caretraxx Usage</a>
                &gt;
                <a href="#caretraxx-usage-chat">Chat</a>
                &gt;
                <a href="#caretraxx-usage-chat-monthly">June 2015</a>
            </div>
            <ul class="tabs">
                <li><a href="#caretraxx-usage-enrollment">Enrollment</a></li>
                <li><a href="#caretraxx-usage-mobile-checkin">Mobile Checkin</a></li>
                <li><a href="#caretraxx-usage-chat" class="active" data-subcategory="caretraxx-usage-chat">Chat</a></li>
                <li><a href="#caretraxx-usage-mobile-appointments">Mobile Appointments</a></li>
            </ul>
            <div class="slide">
                <a href="#caretraxx-usage-chat" class="close-x">
                    <img src="img/close.png" alt="close">
                </a>
                <div id="chart2c-month" class="chartcontainer"></div>
                <!--img src="img/pie-graph-placeholder.png" alt="caretraxx usage chat monthly graph"-->
            </div>
            <div></div>
        </section>

        <section id="caretraxx-usage-mobile-appointments" data-category="caretraxx-usage">
            <h1>caretraxx Usage</h1>
            <div class="breadcrums">
                <a href="#caretraxx-usage-enrollment">caretraxx Usage</a>
                &gt;
                <a href="#caretraxx-usage-mobile-appointments">Mobile Appointments</a>
            </div>
            <ul class="tabs">
                <li><a href="#caretraxx-usage-enrollment">Enrollment</a></li>
                <li><a href="#caretraxx-usage-mobile-checkin">Mobile Checkin</a></li>
                <li><a href="#caretraxx-usage-chat">Chat</a></li>
                <li><a href="#caretraxx-usage-mobile-appointments" class="active">Mobile Appointments</a></li>
            </ul>
            <div id="chart2d" class="chartcontainer"></div>
            <!--img src="img/line-graph-placeholder.png" alt="caretraxx usage mobile appointments graph"-->
            <div></div>
        </section>

        <!-- END caretraxx USAGE -->

        <!-- PATIENT FLOW -->

        <section id="patient-flow-wait-time" data-category="patient-flow">
            <h1>Patient Flow</h1>
            <div class="breadcrums">
                <a href="#patient-flow">Patient Flow</a>
                &gt;
                <a href="#patient-flow-wait-time">Wait Time</a>
            </div>
            <ul class="tabs">
                <li><a href="#patient-flow-wait-time" class="active">Wait Time</a></li>
                <li><a href="#patient-flow-travel-time">Travel Time</a></li>
                <li><a href="#patient-flow-wait-time-exceptions">Wait Time Exceptions</a></li>
                <li><a href="#patient-flow-travel-exceptions">Travel Exceptions</a></li>
            </ul>
            <label class="dataselection">
                Department
                <select name="department">
                    <option value="Overall">Overall</option>
                    <option value="Admitting">Admitting</option>
                    <option value="Radiology">Radiology</option>
                </select>
            </label>
            <div id="chart3a" class="chartcontainer"></div>
            <!-- img src="img/line-graph-placeholder.png" alt="patient flow wait time graph" -->
            <div></div>
        </section>

        <section id="patient-flow-travel-time" data-category="patient-flow">
            <h1>Patient Flow</h1>
            <div class="breadcrums">
                <a href="#patient-flow-wait-time">Patient Flow</a>
                &gt;
                <a href="#patient-flow-travel-time">Travel Time</a>
            </div>
            <ul class="tabs">
                <li><a href="#patient-flow-wait-time">Wait Time</a></li>
                <li><a href="#patient-flow-travel-time" class="active">Travel Time</a></li>
                <li><a href="#patient-flow-wait-time-exceptions">Wait Time Exceptions</a></li>
                <li><a href="#patient-flow-travel-exceptions">Travel Exceptions</a></li>
            </ul>
            <label class="dataselection">
                From Department
                <select name="department">
                    <option value="Oncology">Oncology</option>
                    <option value="Admitting">Admitting</option>
                    <option value="Radiology">Radiology</option>
                </select>
            </label>
            <div id="chart3b" class="chartcontainer"></div>
            <!--img src="img/line-graph-placeholder.png" alt="patient flow travel time graph"-->
            <div></div>
        </section>

        <section id="patient-flow-wait-time-exceptions" data-category="patient-flow">
            <h1>Patient Flow</h1>
            <div class="breadcrums">
                <a href="#patient-flow-wait-time">Patient Flow</a>
                &gt;
                <a href="#patient-flow-wait-time-exceptions">Wait Time Exceptions</a>
            </div>
            <ul class="tabs">
                <li><a href="#patient-flow-wait-time">Wait Time</a></li>
                <li><a href="#patient-flow-travel-time">Travel Time</a></li>
                <li><a href="#patient-flow-wait-time-exceptions" class="active">Wait Time Exceptions</a></li>
                <li><a href="#patient-flow-travel-exceptions">Travel Exceptions</a></li>
            </ul>
            <label class="dataselection">
                From Department
                <select name="department">
                    <option value="Cardiology">Cardiology</option>
                    <option value="OR">OR</option>
                    <option value="Radiology">Radiology</option>
                </select>
            </label>
            <div id="chart3c" class="chartcontainer"></div>
            <a href="#patient-flow-wait-time-exceptions-monthly">
                <!--img src="img/line-graph-placeholder.png" alt="patient flow wait time exceptions graph"-->
            </a>
            <div></div>
        </section>
        <section id="patient-flow-wait-time-exceptions-monthly" data-category="patient-flow" data-subcategory="patient-flow-wait-time-exceptions">
            <h1>Patient Flow</h1>
            <div class="breadcrums">
                <a href="#patient-flow-wait-time">Patient Flow</a>
                &gt;
                <a href="#patient-flow-wait-time-exceptions">Wait Time Exceptions</a>
                &gt;
                <a href="#patient-flow-wait-time-exceptions-monthly">June 2015</a>
            </div>
            <ul class="tabs">
                <li><a href="#patient-flow-wait-time">Wait Time</a></li>
                <li><a href="#patient-flow-travel-time">Travel Time</a></li>
                <li><a href="#patient-flow-wait-time-exceptions" class="active" data-subcategory="patient-flow-wait-time-exceptions">Wait Time Exceptions</a></li>
                <li><a href="#patient-flow-travel-exceptions">Travel Exceptions</a></li>
            </ul>
            <div class="slide">
                <a href="#patient-flow-wait-time-exceptions" class="close-x">
                    <img src="img/close.png" alt="close">
                </a>
                <h2>Wait time exceptions - Patient comments</h2>
                <p>October 2015</p>
<textarea class="patient-comments" name="patient-comments" cols="30" rows="10">
2015 10 09, 09:31am - lorem ipsum dolor sit amet
2015 10 09, 09:42am - lorem ipsum dolor sit amet
2015 10 09, 10:12am - lorem ipsum dolor sit amet
</textarea>
            </div>
            <div></div>
        </section>

        <section id="patient-flow-travel-exceptions" data-category="patient-flow">
            <h1>Patient Flow</h1>
            <div class="breadcrums">
                <a href="#patient-flow-wait-time">Patient Flow</a>
                &gt;
                <a href="#patient-flow-travel-exceptions">Travel Exceptions</a>
            </div>
            <ul class="tabs">
                <li><a href="#patient-flow-wait-time">Wait Time</a></li>
                <li><a href="#patient-flow-travel-time">Travel Time</a></li>
                <li><a href="#patient-flow-wait-time-exceptions">Wait Time Exceptions</a></li>
                <li><a href="#patient-flow-travel-exceptions" class="active">Travel Exceptions</a></li>
            </ul>
            <label class="dataselection">
                Time range
                <select name="group">
                    <option value="0">All time</option>
                    <option value="2015">2015</option>
                    <option value="2014">2014</option>
                    <option value="24">2015 Dec</option>
                    <option value="23">2015 Nov</option>
                    <option value="22">2015 Oct</option>
                    <option value="21">2015 Sep</option>
                    <option value="20">2015 Aug</option>
                    <option value="19">2015 Jul</option>
                    <option value="18">2015 Jun</option>
                    <option value="17">2015 May</option>
                    <option value="16">2015 Apr</option>
                    <option value="15">2015 Mar</option>
                    <option value="14">2015 Feb</option>
                    <option value="13">2015 Jan</option>
                    <option value="12">2014 Dec</option>
                    <option value="11">2014 Nov</option>
                    <option value="10">2014 Oct</option>
                    <option value="9">2014 Sep</option>
                    <option value="8">2014 Aug</option>
                    <option value="7">2014 Jul</option>
                    <option value="6">2014 Jun</option>
                    <option value="5">2014 May</option>
                    <option value="4">2014 Apr</option>
                    <option value="3">2014 Mar</option>
                    <option value="2">2014 Feb</option>
                    <option value="1">2014 Jan</option>
                </select>
            </label>
            <div id="chart3d" class="chartcontainer"></div>
            <!--img src="img/pie-graph-placeholder.png" alt="patient flow travel exceptions graph"-->
            <div></div>
        </section>

        <!-- END PATIENT FLOW -->

        <!-- CARE QUALITY -->

        <section id="care-quality-response-rate" data-category="care-quality">
            <h1>Care Quality</h1>
            <div class="breadcrums">
                <a href="#care-quality">Care Quality</a>
                &gt;
                <a href="#care-quality-response-rate">Response Rate</a>
            </div>
            <ul class="tabs">
                <li><a href="#care-quality-response-rate" class="active">Response Rate</a></li>
                <li><a href="#care-quality-nurse-care">Nurse Care</a></li>
                <li><a href="#care-quality-doctor-care">Doctor Care</a></li>
                <li><a href="#care-quality-hospital-environment">Hospital Environment</a></li>
                <li><a href="#care-quality-hospital-experience">Hospital Experience</a></li>
                <li><a href="#care-quality-overall-rating">Overall rating</a></li>
            </ul>
            <div id="chart4a" class="chartcontainer"></div>
            <!--img src="img/bar-graph-placeholder.png" alt="care quality response rate"-->
            <div></div>
        </section>

        <section id="care-quality-nurse-care" data-category="care-quality">
            <h1>Care Quality</h1>
            <div class="breadcrums">
                <a href="#care-quality-response-rate">Care Quality</a>
                &gt;
                <a href="#care-quality-nurse-care">Nurse Care</a>
            </div>
            <ul class="tabs">
                <li><a href="#care-quality-response-rate">Response Rate</a></li>
                <li><a href="#care-quality-nurse-care" class="active">Nurse Care</a></li>
                <li><a href="#care-quality-doctor-care">Doctor Care</a></li>
                <li><a href="#care-quality-hospital-environment">Hospital Environment</a></li>
                <li><a href="#care-quality-hospital-experience">Hospital Experience</a></li>
                <li><a href="#care-quality-overall-rating">Overall rating</a></li>
            </ul>
            <label class="dataselection">
                <select name="group">
                    <option value="overall">Overall</option>
                    <option value="er">ER admitted</option>
                    <option value="education">Ed level</option>
                    <option value="race">Race</option>
                    <option value="language">Language</option>
                </select>
            </label>
            <div id="chart4b1" class="chartcontainer quart q1"></div>
            <div id="chart4b2" class="chartcontainer quart q2"></div>
            <div id="chart4b3" class="chartcontainer quart q3"></div>
            <div id="chart4b4" class="chartcontainer quart q4"></div>
            <!--img src="img/pies-graph-placeholder.png" alt="care quality nurse care"-->
            <div></div>
        </section>

        <section id="care-quality-doctor-care" data-category="care-quality">
            <h1>Care Quality</h1>
            <div class="breadcrums">
                <a href="#care-quality-response-rate">Care Quality</a>
                &gt;
                <a href="#care-quality-doctor-care">Doctor Care</a>
            </div>
            <ul class="tabs">
                <li><a href="#care-quality-response-rate">Response Rate</a></li>
                <li><a href="#care-quality-nurse-care">Nurse Care</a></li>
                <li><a href="#care-quality-doctor-care" class="active">Doctor Care</a></li>
                <li><a href="#care-quality-hospital-environment">Hospital Environment</a></li>
                <li><a href="#care-quality-hospital-experience">Hospital Experience</a></li>
                <li><a href="#care-quality-overall-rating">Overall rating</a></li>
            </ul>
            <label class="dataselection">
                <select name="group">
                    <option value="overall">Overall</option>
                    <option value="er">ER admitted</option>
                    <option value="education">Ed level</option>
                    <option value="race">Race</option>
                    <option value="language">Language</option>
                </select>
            </label>
            <div id="chart4c1" class="chartcontainer quart q1"></div>
            <div id="chart4c2" class="chartcontainer quart q2"></div>
            <div id="chart4c3" class="chartcontainer quart q3"></div>
            <div id="chart4c4" class="chartcontainer quart q4"></div>
            <!--img src="img/pies-graph-placeholder.png" alt="care quality doctor care"-->
            <div></div>
        </section>

        <section id="care-quality-hospital-environment" data-category="care-quality">
            <h1>Care Quality</h1>
            <div class="breadcrums">
                <a href="#care-quality-response-rate">Care Quality</a>
                &gt;
                <a href="#care-quality-hospital-environment">Hospital Environment</a>
            </div>
            <ul class="tabs">
                <li><a href="#care-quality-response-rate">Response Rate</a></li>
                <li><a href="#care-quality-nurse-care">Nurse Care</a></li>
                <li><a href="#care-quality-doctor-care">Doctor Care</a></li>
                <li><a href="#care-quality-hospital-environment" class="active">Hospital Environment</a></li>
                <li><a href="#care-quality-hospital-experience">Hospital Experience</a></li>
                <li><a href="#care-quality-overall-rating">Overall rating</a></li>
            </ul>
            <label class="dataselection">
                <select name="group">
                    <option value="overall">Overall</option>
                    <option value="er">ER admitted</option>
                    <option value="education">Ed level</option>
                    <option value="race">Race</option>
                    <option value="language">Language</option>
                </select>
            </label>
            <div id="chart4d1" class="chartcontainer half half1"></div>
            <div id="chart4d2" class="chartcontainer half qalf2"></div>

            <!-- img src="img/pies-graph-placeholder.png" alt="care quality hospital environment" -->
            <div></div>
        </section>

        <section id="care-quality-hospital-experience" data-category="care-quality">
            <h1>Care Quality</h1>
            <div class="breadcrums">
                <a href="#care-quality-response-rate">Care Quality</a>
                &gt;
                <a href="#care-quality-hospital-experience">Hospital Experience</a>
            </div>
            <ul class="tabs">
                <li><a href="#care-quality-response-rate">Response Rate</a></li>
                <li><a href="#care-quality-nurse-care">Nurse Care</a></li>
                <li><a href="#care-quality-doctor-care">Doctor Care</a></li>
                <li><a href="#care-quality-hospital-environment">Hospital Environment</a></li>
                <li><a href="#care-quality-hospital-experience" class="active">Hospital Experience</a></li>
                <li><a href="#care-quality-overall-rating">Overall rating</a></li>
            </ul>
            <label class="dataselection">
                <select name="group">
                    <option value="overall">Overall</option>
                    <option value="er">ER admitted</option>
                    <option value="education">Ed level</option>
                    <option value="race">Race</option>
                    <option value="language">Language</option>
                </select>
            </label>
            <div id="chart4e1" class="chartcontainer quart q1"></div>
            <div id="chart4e2" class="chartcontainer quart q2"></div>
            <div id="chart4e3" class="chartcontainer quart q3"></div>
            <div id="chart4e4" class="chartcontainer quart q4"></div>

            <!--img src="img/pies-graph-placeholder.png" alt="care quality hospital experience"-->
            <div></div>
        </section>

        <section id="care-quality-overall-rating" data-category="care-quality">
            <h1>Care Quality</h1>
            <div class="breadcrums">
                <a href="#care-quality-response-rate">Care Quality</a>
                &gt;
                <a href="#care-quality-overall-rating">Overall rating</a>
            </div>
            <ul class="tabs">
                <li><a href="#care-quality-response-rate">Response Rate</a></li>
                <li><a href="#care-quality-nurse-care">Nurse Care</a></li>
                <li><a href="#care-quality-doctor-care">Doctor Care</a></li>
                <li><a href="#care-quality-hospital-environment">Hospital Environment</a></li>
                <li><a href="#care-quality-hospital-experience">Hospital Experience</a></li>
                <li><a href="#care-quality-overall-rating" class="active">Overall rating</a></li>
            </ul>
            <label class="dataselection">
                <select name="group">
                    <option value="overall">Overall</option>
                    <option value="er">ER admitted</option>
                    <option value="education">Ed level</option>
                    <option value="race">Race</option>
                    <option value="language">Language</option>
                </select>
            </label>
            <div class="charts charts-2">
                <div id="chart4f1of2" class="chartcontainer half half1"></div>
                <div id="chart4f2of2" class="chartcontainer half half2"></div>
            </div>
            <div class="charts charts-4">
                <div id="chart4f1of4" class="chartcontainer quart q1"></div>
                <div id="chart4f2of4" class="chartcontainer quart q2"></div>
                <div id="chart4f3of4" class="chartcontainer quart q1"></div>
                <div id="chart4f4of4" class="chartcontainer quart q2"></div>
            </div>
            <div class="charts charts-6">
                <div id="chart4f1of6" class="chartcontainer hex hx1"></div>
                <div id="chart4f2of6" class="chartcontainer hex hx2"></div>
                <div id="chart4f3of6" class="chartcontainer hex hx1"></div>
                <div id="chart4f4of6" class="chartcontainer hex hx2"></div>
                <div id="chart4f5of6" class="chartcontainer hex hx1"></div>
                <div id="chart4f6of6" class="chartcontainer hex hx2"></div>
            </div>
            <img class="legend" src="img/legend.png" alt="chart legend">
            <div></div>
        </section>

        <!-- END CARE QUALITY -->

@endsection