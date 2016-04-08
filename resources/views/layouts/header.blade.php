<header>
    <div class="background"></div>
    <a class="logo" href="#main"><img src="img/logo-caretraxx.png" alt="caretraxx"></a>
    <h2>Patient Insights</h2>
    <div class="loggedin-no"></div>

    @if (Auth::check())
    <div class="loggedin-yes">
        Welcome back, {{Auth::user()->fullname}}
        <a href="{{url('/auth/logout')}}">(logout)</a>
        <nav>
            <ul>
                <li>
                    <a href="#caretraxx-usage-enrollment" data-category="caretraxx-usage">
                        caretraxx Usage
                    </a>
                </li>
                <li>
                    <a href="#patient-flow-wait-time" data-category="patient-flow">
                        Patient Flow
                    </a>
                </li>
                <li>
                    <a href="#care-quality-response-rate" data-category="care-quality">
                        Care Quality
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    @endif

</header>