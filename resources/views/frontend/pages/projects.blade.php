@extends('frontend.layouts.app')
@section('content')

<section class="sf-page-hero sf-page-hero--luxury">
    <div class="sf-page-hero__media">
        @if(isset($sliders) && count($sliders))
            <div id="slider1" class="owl-carousel owl-theme sf-page-hero__carousel">
                @foreach($sliders as $slider)
                    <div class="item">
                        <img src="{!! asset($slider->image) !!}" alt="Smart Fit Cabinets projects">
                    </div>
                @endforeach
            </div>
        @else
            <img src="{!! asset('uploads/images/670544kitchen_02.webp') !!}" alt="Smart Fit Cabinets projects">
        @endif
        <div class="sf-page-hero__shade"></div>
    </div>
    <div class="sf-page-hero__content">
        <p class="sf-eyebrow reveal">Portfolio</p>
        <h1 class="reveal">Our Projects</h1>
        <p class="reveal">Editorial joinery for Melbourne homes — kitchens, vanities, laundries and bespoke cabinetry.</p>
    </div>
</section>

<section class="sf-section sf-section--dark">
    <div class="container">
        @if(isset($tours) && count($tours))
            <div class="sf-projects-featured sf-projects-featured--three">
                @foreach($tours as $tour)
                    <a href="{{ route('projectDetails', $tour->url) }}" class="sf-project-editorial reveal">
                        <div class="sf-project-editorial__img">
                            <img src="{!! asset($tour->image) !!}" alt="{{ $tour->title }}" loading="lazy">
                        </div>
                        <div class="sf-project-editorial__meta">
                            <h3>{{ $tour->title }}</h3>
                            <span>View Project <i class="fa fa-long-arrow-right"></i></span>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <p class="text-center reveal">Projects coming soon.</p>
        @endif
    </div>
</section>

<section class="sf-section sf-contact--band reveal">
    <div class="container text-center">
        <h2>Enquire about a similar project</h2>
        <a href="{{ route('contact') }}" class="sf-btn sf-btn--champagne">Book a Consultation</a>
    </div>
</section>

@endsection
