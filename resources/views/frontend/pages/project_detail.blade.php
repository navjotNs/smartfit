@extends('frontend.layouts.app')
@section('content')

@php
    $heroImage = !empty($galleryImages) ? $galleryImages[0] : $article->image;
    $storyImages = array_slice($galleryImages, 1);
@endphp

<article class="sf-proj">
    <section class="sf-proj-hero">
        <div class="sf-proj-hero__media">
            <img src="{!! asset($heroImage) !!}" alt="{{ $article->title }}">
        </div>
        <div class="sf-proj-hero__veil"></div>
        <div class="sf-proj-hero__inner">
            <a href="{{ route('projects') }}" class="sf-proj-back">All Projects</a>
            @if($location)
                <p class="sf-eyebrow">{{ $location }}</p>
            @else
                <p class="sf-eyebrow">Selected Project</p>
            @endif
            <h1>{{ $shortTitle }}</h1>
        </div>
        <span class="sf-proj-hero__scroll"></span>
    </section>

    @if(!empty($credits) || $location)
    <section class="sf-proj-credits">
        <div class="container">
            <div class="sf-proj-credits__row">
                @if($location)
                    <div>
                        <span>Location</span>
                        <strong>{{ $location }}</strong>
                    </div>
                @endif
                @foreach($credits as $label => $value)
                    <div>
                        <span>{{ $label }}</span>
                        <strong>{{ $value }}</strong>
                    </div>
                @endforeach
                <div>
                    <span>Joinery</span>
                    <strong>Smart Fit Cabinets</strong>
                </div>
            </div>
        </div>
    </section>
    @endif

    <section class="sf-proj-story">
        <div class="sf-proj-story__copy reveal">
            <p class="sf-eyebrow">The Project</p>
            <div class="sf-project-copy">
                {!! $storyHtml !!}
            </div>
            <a href="{{ route('contact') }}" class="sf-btn sf-btn--champagne">Enquire about a similar project</a>
        </div>
    </section>

    @if(count($storyImages))
    <section class="sf-proj-photos">
        @foreach($storyImages as $i => $photo)
            <figure class="sf-proj-photo {{ $i === 0 ? 'sf-proj-photo--full' : ($i % 3 === 0 ? 'sf-proj-photo--full' : 'sf-proj-photo--half') }}">
                <img src="{!! asset($photo) !!}" alt="{{ $article->title }} photography" loading="lazy">
            </figure>
        @endforeach
    </section>
    @endif

    <nav class="sf-proj-next">
        @if(!empty($prev))
            <a href="{{ route('projectDetails', $prev->url) }}" class="sf-proj-next__card">
                <img src="{!! asset($prev->image) !!}" alt="{{ $prev->title }}">
                <div>
                    <span>Previous project</span>
                    <strong>{{ $prev->title }}</strong>
                </div>
            </a>
        @endif
            @if(!empty($next))
            <a href="{{ route('projectDetails', $next->url) }}" class="sf-proj-next__card sf-proj-next__card--next">
                <img src="{!! asset($next->image) !!}" alt="{{ $next->title }}">
                <div>
                    <span>Next project</span>
                    <strong>{{ $next->title }}</strong>
                </div>
            </a>
            @endif
        </nav>
</article>

@if(isset($related) && count($related))
<section class="sf-section sf-section--graphite">
    <div class="container">
        <div class="sf-section__head reveal">
            <p class="sf-eyebrow">Continue exploring</p>
            <h2>More projects</h2>
        </div>
        <div class="sf-projects-featured sf-projects-featured--three">
            @foreach($related as $project)
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

@endsection
