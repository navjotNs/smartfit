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
                <li><a href="/">HOME</a></li>
                <li><a href="{{ route('about-us') }}">ABOUT US</a></li>
                <li><a href="{{ route('services') }}">SERVICES</a></li>
                <li><a href="{{ route('our-process') }}">OUR PROCESS</a></li>
                <li><a href="{{ route('projects') }}">PROJECTS</a></li>
                <li><a href="{{ route('contact') }}">CONTACT</a></li>
                <li class="sf-mobile-meta">
                    <div class="sf-mobile-contact">
                        <a href="tel:0434991936"><i class="fa fa-phone"></i> 0434 991 936</a>
                        <a href="mailto:info@smartfitcabinets.com"><i class="fa fa-envelope-o"></i> info@smartfitcabinets.com</a>
                        <a href="https://www.google.com/maps/dir/?api=1&destination=Unit+5/483B+Dohertys+Road,+Truganina+VIC+3029" target="_blank" rel="noopener"><i class="fa fa-map-marker"></i> Unit 5/483B Dohertys Rd, Truganina VIC 3029</a>
                    </div>
                    <a href="{{ route('contact') }}" class="sf-nav-cta">GET A FREE QUOTE</a>
                </li>
            </ul>
        </div>
        <div class="row deskMenu align-items-center">
            <div class="col-md-3 logodiv">
                <a href="/" class="sf-logo sf-logo--desktop">
                    <span class="sf-logo__text">SMART FIT<br>CABINETS</span>
                </a>
            </div>
            <div class="col-md-9 sf-nav-right">
                <ul class="sf-nav-links">
                    <li><a href="{{ route('projects') }}">PROJECTS</a></li>
                    <li><a href="{{ route('kitchens') }}">KITCHENS</a></li>
                    <li><a href="{{ route('joinery') }}">JOINERY</a></li>
                    <li><a href="{{ route('builders-architects') }}">BUILDERS<span class="sf-nav-extra"> &amp; ARCHITECTS</span></a></li>
                    <li><a href="{{ route('about-us') }}">ABOUT</a></li>
                    <li><a href="{{ route('contact') }}">CONTACT</a></li>
                </ul>
                
                <a href="{{ route('contact') }}" class="sf-header-cta">REQUEST A QUOTE</a>
            </div>
        </div>
    </div>
</header>