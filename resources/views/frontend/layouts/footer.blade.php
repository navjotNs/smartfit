<footer class="sf-footer">
    <div class="container">
        <div class="sf-footer__grid">
            <div class="sf-footer__brand-col">
                <a href="/" class="sf-footer__brand">SMART FIT<br><span>CABINETS</span></a>
                <p class="sf-footer__tagline">Premium custom cabinetry and architectural joinery for Melbourne homes and spaces.</p>
                <ul class="social">
                    @if(!empty($content))
                    <li><a href="{{ $content->instagram }}" target="_blank" rel="noopener" aria-label="Instagram"><i class="fa fa-instagram"></i></a></li>
                    <li><a href="{{ $content->facebook }}" target="_blank" rel="noopener" aria-label="Facebook"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="{{ $content->linkedin }}" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="fa fa-linkedin"></i></a></li>
                    @endif
                </ul>
            </div>
            <div>
                <h4>Quick Links</h4>
                <ul class="sf-footer-links">
                    <li><a href="/">Home</a></li>
                    <li><a href="{{ route('projects') }}">Projects</a></li>
                    <li><a href="{{ route('services') }}">Services</a></li>
                    <li><a href="{{ route('our-process') }}">Our Process</a></li>
                    <li><a href="{{ route('about-us') }}">About</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>
            <div>
                <h4>Services</h4>
                <ul class="sf-footer-links">
                    <li><a href="{{ route('kitchens') }}">Kitchens</a></li>
                    <li><a href="{{ route('joinery') }}">Custom Joinery</a></li>
                    <li><a href="{{ route('joinery') }}">Wardrobes</a></li>
                    <li><a href="{{ route('joinery') }}">Vanities</a></li>
                    <li><a href="{{ route('builders-architects') }}">Builders &amp; Architects</a></li>
                </ul>
            </div>
            <div class="sf-footer__contact">
                <h4>Contact</h4>
                <p>Unit 5/483B Dohertys Road<br>Truganina VIC 3029</p>
                <p><a href="tel:0434991936">0434 991 936</a></p>
                <p><a href="mailto:info@smartfitcabinets.com">info@smartfitcabinets.com</a></p>
                <a href="{{ route('contact') }}" class="sf-footer__cta">Request a Quote</a>
            </div>
        </div>
        <div class="sf-copyright">
            <p>Copyright &copy; {{ date('Y') }} Smart Fit Cabinets. All Rights Reserved.</p>
        </div>
    </div>
</footer>
