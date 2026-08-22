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
                <p style="margin-top: 5px;">Walk-in and fitted wardrobes designed around storage, lighting and daily use.</p>
            </article>
            <article class="sf-joinery-cat reveal">
                <h3>Bathroom vanities</h3>
                <p style="margin-top: 5px;">Custom vanities with considered storage, stone and durable finishes.</p>
            </article>
            <article class="sf-joinery-cat reveal">
                <h3>Laundries</h3>
                <p style="margin-top: 5px;">Functional laundry joinery that conceals appliances and keeps spaces ordered.</p>
            </article>
            <article class="sf-joinery-cat reveal">
                <h3>Entertainment units</h3>
                <p style="margin-top: 5px;">TV cabinetry and media walls integrated with the architecture of the room.</p>
            </article>
            <article class="sf-joinery-cat reveal">
                <h3>Home offices</h3>
                <p style="margin-top: 5px;">Study joinery with concealed storage, cable management and clean lines.</p>
            </article>
            <article class="sf-joinery-cat reveal">
                <h3>Bars &amp; display</h3>
                <p style="margin-top: 5px;">Bar joinery and display cabinetry for entertaining and feature spaces.</p>
            </article>
            <article class="sf-joinery-cat reveal">
                <h3>Linen &amp; storage</h3>
                <p style="margin-top: 5px;">Linen towers and full-height storage designed to disappear into the wall.</p>
            </article>
            <article class="sf-joinery-cat reveal">
                <h3>Architectural joinery</h3>
                <p style="margin-top: 5px;">Full-height panelling, integrated walls and detailed packages from drawings.</p>
            </article> 
        </div>
    </div>
</section>

@if(isset($projects) && count($projects))
<section class="sf-section sf-section--graphite">
    <div class="container">
        <div class="sf-section__head reveal">
            <p class="sf-eyebrow" style="margin-top: 0px;">Selected Work</p>
            <h2>Joinery projects</h2>
        </div>
        <div class="sf-projects-featured sf-projects-featured--three">
            @foreach($projects->take(6) as $project)
                <a href="{{ route('projectDetails', $project->url) }}" class="sf-project-editorial reveal">
                    <div class="sf-project-editorial__img">
                        <img src="{!! asset($project->image) !!}" alt="{{ $project->title }}" loading="lazy">
                    </div>
                    <div class="sf-project-editorial__meta">
                        <h3>{{ $project->title }}</h3>
                        <span>View Project <i class="fa fa-long-arrow-right"></i></span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="sf-section sf-contact--band reveal">
    <div class="container text-center">
        <h2>Discuss your joinery project</h2>
        <a href="{{ route('contact') }}" class="sf-btn sf-btn--champagne">Request a Quote</a>
    </div>
</section>

@endsection
