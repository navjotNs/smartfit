@extends('frontend.layouts.app')
@section('content')

{{-- HERO --}}
<section class="sf-hero sf-hero--luxury" id="top">
    <div class="sf-hero__media">
        @if(isset($sliders) && count($sliders))
            <div id="slider1" class="owl-carousel owl-theme sf-hero__carousel">
                @foreach($sliders as $slider)
                    <div class="item">
                        <img src="{!! asset($slider->image) !!}" alt="Smart Fit Cabinets premium joinery">
                    </div>
                @endforeach
            </div>
        @else
            <div class="sf-hero__fallback">
                <img src="{!! asset('uploads/images/670544kitchen_02.webp') !!}" alt="Smart Fit Cabinets kitchen">
            </div>
        @endif
        <div class="sf-hero__shade sf-hero__shade--luxury"></div>
    </div>
    <div class="sf-hero__content sf-hero__content--luxury">
        <p class="sf-eyebrow reveal">Bespoke Cabinetry &amp; Joinery</p>
        <h1 class="sf-brand sf-brand--luxury reveal">Designed to inspire.<br>Built to last.</h1>
        <p class="sf-hero__lead reveal">Premium custom cabinetry and architectural joinery for Melbourne's exceptional homes and spaces.</p>
        <div class="sf-hero__actions reveal">
            <a href="{{ route('projects') }}" class="sf-btn sf-btn--champagne">View Our Projects</a>
            <a href="{{ route('contact') }}" class="sf-btn sf-btn--outline">Book a Consultation</a>
        </div>
    </div>
</section>

{{-- TRUST STRIP --}}
<section class="sf-trust">
    <div class="container">
        <div class="sf-trust__grid">
            <div class="sf-trust__item reveal">
                <h3>Bespoke Design</h3>
                <p>Custom solutions tailored to your project, space and vision.</p>
            </div>
            <div class="sf-trust__item reveal">
                <h3>Premium Materials</h3>
                <p>Quality board, stone, hardware and finishes selected with care.</p>
            </div>
            <div class="sf-trust__item reveal">
                <h3>Precision Crafted</h3>
                <p>Advanced machinery combined with skilled craftsmanship.</p>
            </div>
            <div class="sf-trust__item reveal">
                <h3>End-to-End Service</h3>
                <p>Documentation, manufacture and installation under one roof.</p>
            </div>
            <div class="sf-trust__item reveal">
                <h3>Trusted Partner</h3>
                <p>Collaboration with builders, architects and designers.</p>
            </div>
        </div>
    </div>
</section>

{{-- FEATURED PROJECTS --}}
<section class="sf-section sf-gallery sf-section--dark" id="projects">
    <div class="container">
        <div class="sf-section__head reveal">
            <p class="sf-eyebrow">Selected Work</p>
            <h2>Featured Projects</h2>
        </div>
        @if(isset($projects) && count($projects))
            <div class="sf-projects-featured">
                @foreach($projects->take(4) as $project)
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
        <div class="text-center reveal" style="margin-top: 3rem;">
            <a href="{{ route('projects') }}" class="sf-btn sf-btn--outline">View All Projects</a>
        </div>
    </div>
</section>

{{-- PROCESS --}}
<section class="sf-section sf-process sf-section--graphite" id="process">
    <div class="container">
        <div class="sf-section__head reveal">
            <p class="sf-eyebrow">How We Work</p>
            <h2>Our Process</h2>
        </div>
        <div class="sf-steps sf-steps--luxury">
            <article class="sf-step reveal">
                <span class="sf-step__num">01</span>
                <h3>Consultation</h3>
                <p>We understand scope, plans, style, budget and timing — on site or from your documentation.</p>
            </article>
            <article class="sf-step reveal">
                <span class="sf-step__num">02</span>
                <h3>Design &amp; Documentation</h3>
                <p>Concepts, material selections, shop drawings and approvals before manufacture begins.</p>
            </article>
            <article class="sf-step reveal">
                <span class="sf-step__num">03</span>
                <h3>Manufacture</h3>
                <p>Precision production in our Melbourne facility with quality checks at every stage.</p>
            </article>
            <article class="sf-step reveal">
                <span class="sf-step__num">04</span>
                <h3>Installation</h3>
                <p>Coordinated installation, finishing and final inspection — delivered with care.</p>
            </article>
        </div>
        <div class="text-center reveal" style="margin-top: 2.5rem;">
            <a href="{{ route('our-process') }}" class="sf-link">Learn more about our process</a>
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
            <a href="{{ route('about-us') }}" class="sf-btn sf-btn--champagne">About Smart Fit</a>
        </div>
    </div>
</section>

{{-- BUILDERS CTA --}}
<section class="sf-section sf-partners sf-section--dark">
    <div class="container sf-partners__inner reveal">
        <div>
            <p class="sf-eyebrow">For Professionals</p>
            <h2>Builders, architects &amp; interior designers</h2>
            <p>Accurate documentation, reliable communication, precision manufacturing and professional installation — positioned as your dependable joinery partner.</p>
        </div>
        <a href="{{ route('builders-architects') }}" class="sf-btn sf-btn--outline">Work With Us</a>
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
