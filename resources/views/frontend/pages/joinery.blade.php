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
        <div class="sf-joinery-cats">
            <article class="sf-joinery-cat reveal">
                <h3>Wardrobes</h3>
                <p>Walk-in and fitted wardrobes designed around storage, lighting and daily use.</p>
            </article>
            <article class="sf-joinery-cat reveal">
                <h3>Bathroom vanities</h3>
                <p>Custom vanities with considered storage, stone and durable finishes.</p>
            </article>
            <article class="sf-joinery-cat reveal">
                <h3>Laundries</h3>
                <p>Functional laundry joinery that conceals appliances and keeps spaces ordered.</p>
            </article>
            <article class="sf-joinery-cat reveal">
                <h3>Entertainment units</h3>
                <p>TV cabinetry and media walls integrated with the architecture of the room.</p>
            </article>
            <article class="sf-joinery-cat reveal">
                <h3>Home offices</h3>
                <p>Study joinery with concealed storage, cable management and clean lines.</p>
            </article>
            <article class="sf-joinery-cat reveal">
                <h3>Bars &amp; display</h3>
                <p>Bar joinery and display cabinetry for entertaining and feature spaces.</p>
            </article>
            <article class="sf-joinery-cat reveal">
                <h3>Linen &amp; storage</h3>
                <p>Linen towers and full-height storage designed to disappear into the wall.</p>
            </article>
            <article class="sf-joinery-cat reveal">
                <h3>Architectural joinery</h3>
                <p>Full-height panelling, integrated walls and detailed packages from drawings.</p>
            </article>
        </div>

        @if(isset($tours) && count($tours))
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
        @endif
    </div>
</section>

<section class="sf-section sf-contact--band reveal">
    <div class="container text-center">
        <h2>Discuss your joinery project</h2>
        <a href="{{ route('contact') }}" class="sf-btn sf-btn--champagne">Request a Quote</a>
    </div>
</section>

@endsection
