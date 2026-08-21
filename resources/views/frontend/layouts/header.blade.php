@php
    $isHome = request()->routeIs('get-started') || request()->routeIs('home') || request()->is('/');
@endphp
<header class="header sf-header" id="sfHeader">
    <div class="container">
        <div id="main-nav" class="stellarnav">
            <a href="/" class="sf-logo">
                <img src="{!! asset('assets/frontend/images/logo.png') !!}" alt="Smart Fit Cabinets">
            </a>
            <ul>
                <li><a href="{{ route('projects') }}">Projects</a></li>
                <li><a href="{{ route('kitchens') }}">Kitchens</a></li>
                <li><a href="{{ route('joinery') }}">Joinery</a></li>
                <li><a href="{{ route('builders-architects') }}">Builders</a></li>
                <li><a href="{{ route('about-us') }}">About</a></li>
                <li><a href="{{ route('contact') }}">Contact</a></li>
                <li><a href="{{ route('contact') }}" class="sf-nav-cta">Request a Quote</a></li>
            </ul>
        </div>
        <div class="row deskMenu align-items-center">
            <div class="col-md-3 logodiv">
                <a href="/" class="sf-logo sf-logo--desktop">
                    <span class="sf-logo__text">Smart Fit<br><em>Cabinets</em></span>
                </a>
            </div>
            <div class="col-md-9 sf-nav-right">
                <ul class="sf-nav-links">
                    <li><a href="{{ route('projects') }}">Projects</a></li>
                    <li><a href="{{ route('kitchens') }}">Kitchens</a></li>
                    <li><a href="{{ route('joinery') }}">Joinery</a></li>
                    <li><a href="{{ route('builders-architects') }}">Builders</a></li>
                    <li><a href="{{ route('about-us') }}">About</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
                <a href="{{ route('contact') }}" class="sf-header-cta">Request a Quote</a>
            </div>
        </div>
    </div>
</header>
