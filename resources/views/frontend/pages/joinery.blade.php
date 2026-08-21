@extends('frontend.layouts.app')
@section('content')

<section class="sf-page-hero sf-page-hero--luxury">
    <div class="sf-page-hero__media">
        <img src="{!! asset('uploads/images/235483laundry_12.webp') !!}" alt="Custom joinery Melbourne">
        <div class="sf-page-hero__shade"></div>
    </div>
    <div class="sf-page-hero__content">
        <p class="sf-eyebrow reveal">Custom Joinery</p>
        <h1 class="reveal">Architectural joinery<br>for every space.</h1>
        <p class="reveal">Wardrobes, vanities, laundries, entertainment units and bespoke storage — crafted with precision.</p>
    </div>
</section>

<section class="sf-section sf-section--dark">
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
        <h2>Discuss your joinery project</h2>
        <a href="{{ route('contact') }}" class="sf-btn sf-btn--champagne">Request a Quote</a>
    </div>
</section>

@endsection
