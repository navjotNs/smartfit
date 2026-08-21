@extends('frontend.layouts.app')
@section('content')

@php
    $heroImage = (isset($sliders) && count($sliders)) ? $sliders[0]->image : $article->image;
@endphp

<section class="sf-page-hero sf-page-hero--luxury sf-page-hero--project">
    <div class="sf-page-hero__media">
        @if(isset($sliders) && count($sliders) > 1)
            <div id="slider1" class="owl-carousel owl-theme sf-page-hero__carousel">
                @foreach($sliders as $slider)
                    <div class="item">
                        <img src="{!! asset($slider->image) !!}" alt="{{ $article->title }}">
                    </div>
                @endforeach
            </div>
        @else
            <img src="{!! asset($heroImage) !!}" alt="{{ $article->title }}">
        @endif
        <div class="sf-page-hero__shade"></div>
    </div>
    <div class="sf-page-hero__content">
        <p class="sf-eyebrow reveal">Project</p>
        <h1 class="reveal">{{ $article->title }}</h1>
        @if($article->meta_description)
            <p class="reveal">{{ $article->meta_description }}</p>
        @endif
    </div>
</section>

<section class="sf-section sf-project-detail">
    <div class="container">
        <div class="sf-project-detail__layout">
            <div class="sf-project-detail__story reveal">
                <p class="sf-eyebrow">The Brief</p>
                <div class="sf-project-copy">
                    {!! $article->description !!}
                </div>
            </div>
            <aside class="sf-project-detail__aside reveal">
                <div class="sf-project-meta">
                    <h3>Project</h3>
                    <p>{{ $article->title }}</p>
                    <h3>Location</h3>
                    <p>Melbourne</p>
                    <h3>Scope</h3>
                    <p>Custom cabinetry &amp; joinery</p>
                </div>
                <a href="{{ route('contact') }}" class="sf-btn sf-btn--champagne sf-btn--full">Enquire about a similar project</a>
            </aside>
        </div>

        @if((isset($sliders) && count($sliders)) || $article->image)
            <div class="sf-project-gallery">
                <div class="sf-section__head reveal">
                    <p class="sf-eyebrow">Gallery</p>
                    <h2>Project photography</h2>
                </div>
                <div class="sf-project-gallery__grid">
                    @if($article->image)
                        <a href="{!! asset($article->image) !!}" class="sf-project-gallery__item sf-project-gallery__item--wide reveal">
                            <img src="{!! asset($article->image) !!}" alt="{{ $article->title }}" loading="lazy">
                        </a>
                    @endif
                    @if(isset($sliders) && count($sliders))
                        @foreach($sliders as $slider)
                            <a href="{!! asset($slider->image) !!}" class="sf-project-gallery__item reveal">
                                <img src="{!! asset($slider->image) !!}" alt="{{ $article->title }} detail" loading="lazy">
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>
        @endif

        <div class="sf-project-pager">
            @if(!empty($prev))
                <a href="{{ route('projectDetails', $prev->url) }}" class="sf-project-pager__link">
                    <span>Previous</span>
                    <strong>{{ $prev->title }}</strong>
                </a>
            @else
                <span></span>
            @endif
            <a href="{{ route('projects') }}" class="sf-btn sf-btn--outline">All Projects</a>
            @if(!empty($next))
                <a href="{{ route('projectDetails', $next->url) }}" class="sf-project-pager__link sf-project-pager__link--next">
                    <span>Next</span>
                    <strong>{{ $next->title }}</strong>
                </a>
            @else
                <span></span>
            @endif
        </div>
    </div>
</section>

@if(isset($related) && count($related))
<section class="sf-section sf-section--graphite">
    <div class="container">
        <div class="sf-section__head reveal">
            <p class="sf-eyebrow">More Work</p>
            <h2>Related projects</h2>
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

<section class="sf-section sf-contact--band reveal">
    <div class="container text-center">
        <h2>Enquire about a similar project</h2>
        <a href="{{ route('contact') }}" class="sf-btn sf-btn--champagne">Book a Consultation</a>
    </div>
</section>

@endsection
