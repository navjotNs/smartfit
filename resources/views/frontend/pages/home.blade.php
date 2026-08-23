@extends('frontend.layouts.app')
@section('content')

{{-- HERO --}}
<section class="sf-hero sf-hero--luxury" id="top">
    <div class="sf-hero__media">
        <div class="sf-hero__fallback">
            <img src="{!! asset('assets/frontend/images/hero-kitchen.png') !!}" alt="Smart Fit Cabinets luxury kitchen">
        </div>
        <div class="sf-hero__shade sf-hero__shade--luxury"></div>
    </div>
    <div class="sf-hero__content sf-hero__content--luxury">
        <p class="sf-eyebrow reveal" style="color: #fff;">Bespoke Cabinetry &amp; Joinery</p>
        <h1 class="sf-brand sf-brand--luxury reveal">Designed to inspire.<br><em>Built to last.</em></h1>
        <p class="sf-hero__lead reveal">Premium custom cabinetry and architectural joinery for Melbourne's exceptional homes and spaces.</p>
        <div class="sf-hero__actions reveal">
            <a href="{{ route('projects') }}" class="sf-btn sf-btn--champagne">View Our Projects</a>
            <a href="{{ route('contact') }}" class="sf-btn sf-btn--outline">Book a Consultation</a>
        </div>
    </div>
    <!-- <p class="sf-scroll-cue reveal">Scroll to discover</p> -->
</section>

{{-- TRUST STRIP --}}
<section class="sf-trust">
    <div class="container">
        <div class="sf-trust__grid">
            <div class="sf-trust__item reveal">
                <span class="sf-trust__icon" aria-hidden="true">
                    <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.4"><rect x="8" y="14" width="32" height="22" rx="1"/><path d="M8 22h32M20 14v22"/></svg>
                </span>
                <h3>Bespoke Design</h3>
                <p>Custom solutions tailored to the project.</p>
            </div>
            <div class="sf-trust__item reveal">
                <span class="sf-trust__icon" aria-hidden="true">
                    <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.4"><path d="M24 8l14 8v16L24 40 10 32V16z"/><path d="M24 16v24M10 16l14 8 14-8"/></svg>
                </span>
                <h3>Premium Materials</h3>
                <p>Quality board, stone, hardware and finishes.</p>
            </div>
            <div class="sf-trust__item reveal">
                <span class="sf-trust__icon" aria-hidden="true">
                    <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.4"><circle cx="24" cy="24" r="14"/><path d="M24 16v8l6 4"/></svg>
                </span>
                <h3>Precision Crafted</h3>
                <p>Advanced machinery plus skilled craftsmanship.</p>
            </div>
            <div class="sf-trust__item reveal">
                <span class="sf-trust__icon" aria-hidden="true">
                    <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.4"><path d="M12 34V14h24v20"/><path d="M8 34h32M18 22h12M18 28h8"/></svg>
                </span>
                <h3>End-to-End Service</h3>
                <p>Documentation, manufacture and installation.</p>
            </div>
            <div class="sf-trust__item reveal">
                <span class="sf-trust__icon" aria-hidden="true">
                    <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.4"><circle cx="18" cy="18" r="5"/><circle cx="30" cy="18" r="5"/><path d="M10 34c1.5-6 5-9 8-9s6.5 3 8 9M22 34c1.5-6 5-9 8-9s6.5 3 8 9"/></svg>
                </span>
                <h3>Trusted Partner</h3>
                <p>Builder, architect and designer collaboration.</p>
            </div>
        </div>
    </div>
</section>

{{-- FEATURED PROJECTS --}}
<!-- <section class="sf-section sf-gallery sf-section--dark" id="projects">
    <div class="container">
        <div class="sf-section__head sf-section__head--split reveal">
            <div>
                <p class="sf-eyebrow">Featured Projects</p>
                <h2>Exceptional spaces.<br>Thoughtfully crafted.</h2>
            </div>
            <a href="{{ route('projects') }}" class="sf-link">View All Projects</a>
        </div>
        @if(isset($projects) && count($projects))
            <div class="sf-projects-featured sf-projects-featured--three">
                @foreach($projects->take(3) as $project)
                    <a href="{{ route('projectDetails', $project->url) }}" class="sf-project-editorial reveal">
                        <div class="sf-project-editorial__img">
                            <img src="{!! asset($project->image) !!}" alt="{{ $project->title }}" loading="lazy">
                        </div>
                        <div class="sf-project-editorial__meta">
                            <h3>{{ $project->title }}</h3>
                            <span>View Project <i class="fa fa-long-arrow-right"></i></span>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</section> -->

{{-- PROCESS --}}
<section class="sf-section sf-process sf-section--graphite" id="process">
    <div class="container">
        <!--  <div class="sf-section__head reveal">
            <p class="sf-eyebrow">How We Work</p>
            <h2>Our Process</h2>
            <p class="sf-section__sub">A clear, structured process from consultation to handover.</p>
        </div>
        <div id="processSlider" class="owl-carousel owl-theme sf-steps-carousel">
            @include('frontend.partials.process_steps')
        </div> -->
        <div class="sf-process__cta reveal">
            <h3>Start Your Project Today</h3>
            <p>Discuss your cabinetry with our team — no obligation, no pressure.</p>
            <div class="sf-hero__actions" style="justify-content: center;">
                <a href="{{ route('contact') }}" class="sf-btn sf-btn--champagne">Request a Quote</a>
                <a href="tel:0434991936" class="sf-btn sf-btn--outline">Call 0434 991 936</a>
            </div>
        </div>
    </div>
</section>

{{-- MELBOURNE MADE --}}
<section class="sf-section sf-workshop">
    <div class="container sf-workshop__grid">
        <div class="sf-workshop__visual reveal">
            <img src="{!! asset('assets/frontend/images/about_1.webp') !!}" alt="Smart Fit Cabinets Melbourne workshop" loading="lazy">
        </div>
        <div class="sf-workshop__copy reveal">
            <p class="sf-eyebrow">Melbourne Made</p>
            <h2>Local expertise.<br>Uncompromising quality.</h2>
            <p>Smart Fit Cabinets designs and manufactures bespoke joinery locally — combining architectural precision with the warmth of natural timber, stone and refined detailing.</p>
            <p>From documentation through to installation, our team delivers joinery packages builders, architects and homeowners can rely on.</p>
            <a href="{{ route('about-us') }}" class="sf-btn sf-btn--outline">About Smart Fit</a>
        </div>
    </div>
</section>

{{-- BUILDERS CTA --}}
<section class="sf-section sf-partners sf-section--dark">
    <div class="container sf-partners__inner reveal">
        <div>
            <p class="sf-eyebrow">For Professionals</p>
            <h2>A cabinetry partner you can rely on.</h2>
            <p>Accurate documentation, reliable communication, precision manufacturing and professional installation — for builders, architects and interior designers.</p>
        </div>
        <a href="{{ route('builders-architects') }}" class="sf-btn sf-btn--champagne">Work With Us</a>
    </div>
</section>

{{-- FINAL CTA --}}
<section class="sf-section sf-contact sf-contact--luxury" id="quote">
    <div class="container">
        <div class="sf-contact__grid">
            <div class="sf-contact__intro reveal">
                <p class="sf-eyebrow">Enquire</p>
                <h2>Let's create something exceptional.</h2>
                <p>Discuss your kitchen, joinery or full-home cabinetry project with our team.</p>
                <div class="sf-contact__meta">
                    <p><strong>Workshop</strong><br>Unit 5/483B Dohertys Road, Truganina, VIC 3029</p>
                    <p><strong>Email</strong><br><a href="mailto:info@smartfitcabinets.com">info@smartfitcabinets.com</a></p>
                </div>
            </div>
            <div class="sf-contact__form reveal">
                @if(session()->has('enquiry_sub'))
                    <p class="sf-form-success">Your enquiry has been submitted successfully.</p>
                @endif
                <form action="{{ route('contact-enquiry') }}" method="post">
                    {{ csrf_field() }}
                    <div class="sf-form-row">
                        <input type="text" name="name" value="{{ old('name') }}" required placeholder="Name *">
                    </div>
                    <div class="sf-form-row">
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="Email *">
                    </div>
                    <div class="sf-form-row">
                        <input type="tel" name="phone" value="{{ old('phone') }}" required placeholder="Phone *">
                    </div>
                    <div class="sf-form-row">
                        <select name="service" required>
                            <option value="">Project Type *</option>
                            <option value="Kitchen">Kitchen</option>
                            <option value="Custom Joinery">Custom Joinery</option>
                            <option value="Laundry">Laundry</option>
                            <option value="Bath Cabinet">Vanity / Bath</option>
                            <option value="Entertainment Unit">Entertainment Unit</option>
                            <option value="Commercial">Commercial / Builder</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="sf-form-row">
                        <input type="text" name="suburb" value="{{ old('suburb') }}" required placeholder="Suburb / Project Location *">
                    </div>
                    <button type="submit" class="sf-btn sf-btn--champagne sf-btn--full">Request a Quote</button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
