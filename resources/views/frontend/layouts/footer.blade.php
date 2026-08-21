<footer class="sf-footer">
    <div class="container">
        <div class="row sf-footer__grid">
            <div class="col-lg-3 col-md-6">
                <a href="/" class="sf-footer__brand">SMART FIT<br><span>CABINETS</span></a>
                <p>Premium custom cabinetry and architectural joinery for Melbourne's exceptional homes and spaces.</p>
                <div class="footer-logo">
                    <a href="/"><img src="{!! asset('assets/frontend/images/logo.png') !!}" class="img-fluid logo" alt="Smart Fit Cabinets"></a>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <h4>Quick Links</h4>
                <ul class="sf-footer-links">
                    <li><a href="{{ route('projects') }}">Projects</a></li>
                    <li><a href="{{ route('kitchens') }}">Kitchens</a></li>
                    <li><a href="{{ route('joinery') }}">Custom Joinery</a></li>
                    <li><a href="{{ route('builders-architects') }}">Builders &amp; Architects</a></li>
                    <li><a href="{{ route('about-us') }}">About</a></li>
                    <li><a href="{{ route('our-process') }}">Our Process</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-6">
                <h4>Services</h4>
                <ul class="sf-footer-links">
                    <li><a href="{{ route('kitchens') }}">Kitchens</a></li>
                    <li><a href="{{ route('joinery') }}">Wardrobes</a></li>
                    <li><a href="{{ route('joinery') }}">Vanities</a></li>
                    <li><a href="{{ route('joinery') }}">Laundries</a></li>
                    <li><a href="{{ route('joinery') }}">Entertainment Units</a></li>
                    <li><a href="{{ route('joinery') }}">Architectural Joinery</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-6">
                <h4>Information</h4>
                <ul class="sf-footer-links">
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                    <li><a href="{{ route('contact') }}">Request a Quote</a></li>
                </ul>
                @if(!empty($content))
                <h4 class="sf-footer__social-title">Follow Us</h4>
                <ul class="social">
                    <li><a href="{{ $content->instagram }}" target="_blank" rel="noopener" aria-label="Instagram"><i class="fa fa-instagram"></i></a></li>
                    <li><a href="{{ $content->facebook }}" target="_blank" rel="noopener" aria-label="Facebook"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="{{ $content->linkedin }}" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="fa fa-linkedin"></i></a></li>
                </ul>
                @endif
            </div>
            <div class="col-lg-3 col-md-6">
                <h4>Contact</h4>
                <div class="ovr-txt sf-footer__contact">
                    <p><strong>Address</strong><br>Unit 5/483B Dohertys Road, Truganina, VIC 3029, Australia</p>
                    <p><strong>Phone</strong><br><a href="tel:0434991936">0434 991 936</a></p>
                    <p><strong>Email</strong><br><a href="mailto:info@smartfitcabinets.com">info@smartfitcabinets.com</a></p>
                    <p class="sf-footer__area">Greater Melbourne Region</p>
                </div>
            </div>
        </div>
        <div class="sf-copyright">
            <p>Copyright &copy; {{ date('Y') }} Smart Fit Cabinets. All Rights Reserved.</p>
        </div>
    </div>
</footer>
