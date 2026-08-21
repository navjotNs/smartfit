@extends('frontend.layouts.app')
@section('content')

<section class="sf-page-hero sf-page-hero--luxury">
    <div class="sf-page-hero__media">
        <img src="{!! asset('assets/frontend/images/about_2.webp') !!}" alt="Smart Fit Cabinets process">
        <div class="sf-page-hero__shade"></div>
    </div>
    <div class="sf-page-hero__content">
        <p class="sf-eyebrow reveal">How We Work</p>
        <h1 class="reveal">Our Process</h1>
        <p class="reveal">A clear, structured process from consultation to handover.</p>
    </div>
</section>

<section class="sf-section sf-section--dark sf-process">
    <div class="container">
        <div class="sf-steps sf-steps--process">
            @include('frontend.partials.process_steps')
        </div>
    </div>
</section>

<section class="sf-section sf-contact--band reveal">
    <div class="container text-center">
        <h2>Start Your Project Today</h2>
        <p style="max-width: 520px; margin: 0 auto 1.5rem;">Discuss your cabinetry with our team — no obligation, no pressure.</p>
        <div class="sf-hero__actions" style="justify-content: center;">
            <a href="{{ route('contact') }}" class="sf-btn sf-btn--champagne">Request a Quote</a>
            <a href="tel:0434991936" class="sf-btn sf-btn--outline">Call 0434 991 936</a>
        </div>
    </div>
</section>

@endsection
