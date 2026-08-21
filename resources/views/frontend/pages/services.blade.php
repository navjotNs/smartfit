@extends('frontend.layouts.app')
@section('content')

<section class="sf-page-hero sf-page-hero--luxury">
    <div class="sf-page-hero__media">
        @if(isset($sliders) && count($sliders))
            <div id="slider1" class="owl-carousel owl-theme sf-page-hero__carousel">
                @foreach($sliders as $slider)
                    <div class="item">
                        <img src="{!! asset($slider->image) !!}" alt="Smart Fit Cabinets services">
                    </div>
                @endforeach
            </div>
        @else
            <img src="{!! asset('uploads/images/750707kitchen-service.jpg') !!}" alt="Smart Fit Cabinets services">
        @endif
        <div class="sf-page-hero__shade"></div>
    </div>
    <div class="sf-page-hero__content">
        <p class="sf-eyebrow reveal">What we offer</p>
        <h1 class="reveal">Our Services</h1>
        <p class="reveal">Custom cabinetry for every room — designed, built and installed with precision across Melbourne.</p>
    </div>
</section>

<section class="sf-section sf-page-intro sf-section--graphite">
    <div class="container">
        <div class="sf-page-intro__inner reveal">
            <h2>Cabinet making done properly</h2>
            <p>At Smart Fit Cabinets, we craft beautiful, high-quality custom cabinets for every room of your home. Whether you're renovating, building new, or upgrading storage, our team delivers joinery that fits your lifestyle, space and budget.</p>
        </div>
    </div>
</section>

<section class="sf-section sf-services-page sf-section--dark">
    <div class="container">
        <div class="sf-service-page-grid">
            @foreach($tours as $tour)
                <article class="sf-service-feature reveal">
                    <div class="sf-service-feature__img">
                        <img src="{!! asset($tour->image) !!}" alt="{{ $tour->title }}" loading="lazy">
                    </div>
                    <div class="sf-service-feature__body">
                        <h3>{{ $tour->title }}</h3>
                        <p>{{ $tour->meta_description ?: \Illuminate\Support\Str::limit(strip_tags($tour->description), 220) }}</p>
                        <a href="{{ route('placeDetails', $tour->url) }}" class="sf-btn sf-btn--outline">View Service</a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="sf-section sf-contact--band reveal">
    <div class="container text-center">
        <h2>Let's design your next space</h2>
        <p style="max-width: 520px; margin: 0 auto 1.5rem;">Request a consultation — we'll measure, advise and quote with no obligation.</p>
        <a href="{{ route('contact') }}" class="sf-btn sf-btn--champagne">Request a Consultation</a>
    </div>
</section>

@endsection
