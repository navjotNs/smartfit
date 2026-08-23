@extends('frontend.layouts.app')
@section('content')

<section class="sf-page-hero sf-page-hero--luxury">
    <div class="sf-page-hero__media">
        <img src="{!! asset('uploads/images/712276kitchen_11.webp') !!}" alt="Builders and architects joinery partner">
        <div class="sf-page-hero__shade"></div>
    </div>
    <div class="sf-page-hero__content">
        <p class="sf-eyebrow reveal">Professional Partners</p>
        <h1 class="reveal">Builders &amp;<br>Architects</h1>
        <p class="reveal">A dependable joinery subcontractor for documentation, manufacture and installation.</p>
    </div>
</section>

<section class="sf-section sf-section--dark">
    <div class="container">
        <div class="sf-capability-grid sf-capability-grid--wide">
            <div class="sf-capability reveal">
                <h4 style="font-size: 18px;">Accurate Documentation</h4>
                <p style="margin-top: 0px;">We work from architectural drawings, specifications and detailed briefs.</p>
            </div>
            <div class="sf-capability reveal">
                <h4 style="font-size: 18px;"></h4>Shop Drawings &amp; Detailing</h4>
                <p style="margin-top: 0px;">Clear approvals before manufacture to keep programmes on track.</p>
            </div>
            <div class="sf-capability reveal">
                <h4 style="font-size: 18px;"></h4>Reliable Communication</h4>
                <p style="margin-top: 0px;">Transparent programme updates, coordination and issue resolution.</p>
            </div>
            <div class="sf-capability reveal">
                <h4 style="font-size: 18px;"></h4>Precision Manufacturing</h4>
                <p style="margin-top: 0px;">Advanced machinery, quality control and consistent finishes.</p>
            </div>
            <div class="sf-capability reveal">
                <h4 style="font-size: 18px;"></h4>Professional Installation</h4>
                <p style="margin-top: 0px;">Organised site delivery and skilled on-site installation teams.</p>
            </div>
            <div class="sf-capability reveal">
                <h4 style="font-size: 18px;"></h4>Repeat Partnership</h4>
                <p style="margin-top: 0px;">Built for long-term collaboration on residential and commercial projects.</p>
            </div>
        </div>
    </div>
</section>

<section class="sf-section sf-contact--band reveal">
    <div class="container text-center">
        <h2>Send project plans</h2>
        <p style="max-width: 520px; margin: 0 auto 1.5rem;">Share drawings, specifications or scope — we'll respond with capability, timing and next steps.</p>
        <a href="{{ route('contact') }}" class="sf-btn sf-btn--champagne">Work With Us</a>
    </div>
</section>

@endsection
