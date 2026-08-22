@extends('frontend.layouts.app')
@section('content')


<section class="sf-page-hero sf-page-hero--luxury">
    <div class="sf-page-hero__media">
        <div id="slider1" class="owl-carousel owl-theme sf-page-hero__carousel">
            <div class="item">
                <img src="{!! asset('assets/frontend/images/about_1.webp') !!}" alt="Smart Fit Cabinets about">
            </div>
            <div class="item">
                <img src="{!! asset('assets/frontend/images/about_2.webp') !!}" alt="Smart Fit Cabinets workshop">
            </div>
        </div>
        <div class="sf-page-hero__shade"></div>
    </div>
    <div class="sf-page-hero__content">
        <p class="sf-eyebrow reveal">About us</p>
        <h1 class="reveal">Craft specialists<br>for Melbourne homes</h1>
        <p class="reveal">Fully qualified cabinet makers creating beautifully crafted, functional spaces.</p>
    </div>
</section>

<section class="sf-section sf-about-page sf-section--dark">
    <div class="container">
        <div class="sf-about__grid">
            <div class="sf-about__copy reveal">
                <p class="sf-eyebrow">Who we are</p>
                <h2>Passionate about spaces you love living in</h2>
                <p>At <strong>Smart Fit Cabinets</strong>, we create beautifully crafted, functional spaces that enhance the way you live. Based in Melbourne, our fully qualified team brings experience and attention to detail to every project.</p>
                <p>We specialise in custom kitchens, wardrobes, laundries, bathrooms, studies and storage — tailored to your lifestyle, space and budget. Beyond cabinetry we also provide stone benchtops, glass splashbacks and complete installation.</p>
                <a href="{{ route('contact') }}" class="sf-btn sf-btn--champagne">Contact us</a>
            </div>
            <div class="sf-about__visual reveal">
                <img src="{!! asset('assets/frontend/images/about_1.webp') !!}" alt="Smart Fit craftsmanship" loading="lazy">
            </div>
        </div>
    </div>
</section>

<section class="sf-section sf-vision">
    <div class="container">
        <div class="sf-vision__inner reveal">
            <p class="sf-eyebrow">Our vision</p>
            <h2>To be a trusted leader in custom cabinetry across Melbourne</h2>
            <p>Known for exceptional craftsmanship, innovative design, and spaces that enhance everyday living.</p>
        </div>
    </div>
</section>

<section class="sf-section sf-about-values" style="background: #111;">
    <div class="container">
        <div class="sf-section__head reveal">
            <p class="sf-eyebrow">Our values</p>
            <h2>What we stand for</h2>
        </div>
        <div class="sf-values sf-values--six">
            <div class="sf-value reveal">
                <h4>Quality First</h4>
                <p style="margin-top: 10px;">We never compromise on materials, workmanship or finish.</p>
            </div>
            <div class="sf-value reveal">
                <h4>Customer-Centric</h4>
                <p style="margin-top: 10px;">Every project is tailored to lifestyle, vision and budget.</p>
            </div>
            <div class="sf-value reveal">
                <h4>Integrity</h4>
                <p style="margin-top: 10px;">We do what we promise and stand behind our work.</p>
            </div>
            <div class="sf-value reveal">
                <h4>Craftsmanship</h4>
                <p style="margin-top: 10px;">Precision, detail and pride define everything we create.</p>
            </div>
            <div class="sf-value reveal">
                <h4>Reliability</h4>
                <p style="margin-top: 10px;">We deliver on time and communicate clearly at every stage.</p>
            </div>
            <div class="sf-value reveal">
                <h4>Innovation</h4>
                <p style="margin-top: 10px;">Modern designs, smart storage and evolving trends.</p>
            </div>
        </div>
    </div>
</section>

<section class="sf-section sf-expertise sf-why-choose">
    <div class="container sf-expertise__inner">
        <div class="sf-expertise__text reveal">
            <p class="sf-eyebrow" style="color: rgba(255,255,255,0.7);">Why choose us</p>
            <h2>Expert craftsmanship. Personal service. On-time delivery.</h2>
            <p>Every cabinet is built with precision and lasting quality. We collaborate closely to reflect your style and budget, use premium materials, and respect your timeline from measure to install.</p>
            <a href="{{ route('services') }}" class="sf-btn sf-btn--solid">Explore services</a>
            <a href="{{ route('projects') }}" class="sf-link">View projects</a>
        </div>
        <div class="sf-expertise__img reveal">
            <img src="{!! asset('assets/frontend/images/about_2.webp') !!}" alt="Custom cabinetry detail" loading="lazy">
        </div>
    </div>
</section>

<section class="sf-inspire sf-inspire--compact">
    <div class="sf-inspire__bg">
        <img src="{!! asset('uploads/images/670544kitchen_02.webp') !!}" alt="" loading="lazy">
    </div>
    <div class="container sf-inspire__content reveal">
        <p class="sf-eyebrow">Get in touch</p>
        <h2>Let’s talk about your project</h2>
        <p>Ready for a kitchen, laundry or vanity that turns heads? We’re here to help.</p>
        <a href="{{ route('contact') }}" class="sf-btn sf-btn--light">Contact us</a>
    </div>
</section>

@endsection
