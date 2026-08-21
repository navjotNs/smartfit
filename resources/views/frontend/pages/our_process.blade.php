@extends('frontend.layouts.app')
@section('content')

<section class="sf-page-hero sf-page-hero--luxury">
    <div class="sf-page-hero__media">
        <img src="{!! asset('assets/frontend/images/about_2.webp') !!}" alt="Smart Fit joinery process">
        <div class="sf-page-hero__shade"></div>
    </div>
    <div class="sf-page-hero__content">
        <p class="sf-eyebrow reveal">Our Process</p>
        <h1 class="reveal">From concept<br>to completion.</h1>
        <p class="reveal">A clear, refined journey through design, documentation, manufacture and installation.</p>
    </div>
</section>

<section class="sf-section sf-section--dark">
    <div class="container">
        <div class="sf-steps sf-steps--luxury sf-steps--stacked">
            <article class="sf-step reveal">
                <span class="sf-step__num">01</span>
                <h3>Consultation / Plans Received</h3>
                <p>We review scope, architectural plans, style direction, budget and programme.</p>
            </article>
            <article class="sf-step reveal">
                <span class="sf-step__num">02</span>
                <h3>Design, Selections &amp; Documentation</h3>
                <p>Concept development, material selections and shop drawings for approval.</p>
            </article>
            <article class="sf-step reveal">
                <span class="sf-step__num">03</span>
                <h3>Approval &amp; Scheduling</h3>
                <p>Confirmed scope, production scheduling and site coordination.</p>
            </article>
            <article class="sf-step reveal">
                <span class="sf-step__num">04</span>
                <h3>Manufacture</h3>
                <p>Precision production in our Melbourne facility with quality checks throughout.</p>
            </article>
            <article class="sf-step reveal">
                <span class="sf-step__num">05</span>
                <h3>Installation</h3>
                <p>Professional delivery and installation with finishing and coordination on site.</p>
            </article>
            <article class="sf-step reveal">
                <span class="sf-step__num">06</span>
                <h3>Final Quality Check &amp; Handover</h3>
                <p>Inspection, adjustments and handover of your completed joinery.</p>
            </article>
        </div>
    </div>
</section>

<section class="sf-section sf-contact--band reveal">
    <div class="container text-center">
        <h2>Start your project</h2>
        <a href="{{ route('contact') }}" class="sf-btn sf-btn--champagne">Book a Consultation</a>
    </div>
</section>

@endsection
