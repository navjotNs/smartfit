@extends('frontend.layouts.app')
@section('content')

<section class="sf-page-hero sf-page-hero--luxury">
    <div class="sf-page-hero__media">
        <img src="{!! asset('uploads/images/750707kitchen-service.jpg') !!}" alt="Smart Fit custom kitchens Melbourne">
        <div class="sf-page-hero__shade"></div>
    </div>
    <div class="sf-page-hero__content">
        <p class="sf-eyebrow reveal">Kitchens</p>
        <h1 class="reveal">Beautifully designed.<br>Expertly crafted.</h1>
        <p class="reveal">Custom kitchen joinery for discerning Melbourne homes — designed with precision, built to endure.</p>
    </div>
</section>

<section class="sf-section sf-section--dark">
    <div class="container">
        <div class="sf-page-intro__inner reveal">
            <h2>Bespoke kitchens, not mass-market</h2>
            <p>From integrated appliances and concealed storage to stone benchtops and architectural lighting — every Smart Fit kitchen is tailored to the home, the brief and the people who live in it.</p>
        </div>
        <div class="sf-capability-grid">
            <div class="sf-capability reveal"><h4>Custom Design</h4><p>Layouts shaped around how you cook, entertain and live.</p></div>
            <div class="sf-capability reveal"><h4>Premium Materials</h4><p>Board, stone, hardware and finishes selected for longevity.</p></div>
            <div class="sf-capability reveal"><h4>Expert Craftsmanship</h4><p>Precision manufacture with meticulous attention to detail.</p></div>
            <div class="sf-capability reveal"><h4>Complete Solution</h4><p>Documentation through manufacture and installation.</p></div>
        </div>
    </div>
</section>

@if(isset($projects) && count($projects))
<section class="sf-section sf-section--graphite">
    <div class="container">
        <div class="sf-section__head reveal">
            <p class="sf-eyebrow">Kitchen Projects</p>
            <h2>Recent kitchens</h2>
        </div>
        <div class="sf-projects-featured sf-projects-featured--three">
            @foreach($projects->take(3) as $project)
                <a href="{{ route('projectDetails', $project->url) }}" class="sf-project-editorial reveal">
                    <div class="sf-project-editorial__img">
                        <img src="{!! asset($project->image) !!}" alt="{{ $project->title }}" loading="lazy">
                    </div>
                    <div class="sf-project-editorial__meta">
                        <h3>{{ $project->title }}</h3>
                        <span>View Project</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="sf-section sf-contact--band reveal">
    <div class="container text-center">
        <h2>Discuss your kitchen project</h2>
        <a href="{{ route('contact') }}" class="sf-btn sf-btn--champagne">Book a Consultation</a>
    </div>
</section>

@endsection
