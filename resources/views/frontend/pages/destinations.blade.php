@extends('frontend.layouts.app')
@section('content')
<section class="banner" style="margin: 0px;">
    <img src="{!! asset('assets/frontend/images/285103banner11.jpg') !!}" class="img-responsive">
</section>

<section class="our-packages">
<div class="container"> 
<h2 style="margin-top: 50px; margin-bottom: -30px;">Best Itinerary For India</h2>
<div class="row">
@foreach($destinations as $tour)
<div class="col-md-4">
    <a href="{{ route('placeDetails', $tour->url) }}">    
        <div class="pack-box">
            <img src="{!! asset($tour->image) !!}" class="img-fluid mx-auto d-block" alt="">
            <h3>{{ $tour->title }}</h3>
        </div>
    </a>
</div>    
@endforeach
</div>
</div>
</section>


@endsection
