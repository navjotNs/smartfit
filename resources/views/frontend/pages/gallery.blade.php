@extends('frontend.layouts.app')
@section('content')
<section class="banner" style="margin: 0px;">
    <img src="{!! asset('assets/frontend/images/gallery.jpg') !!}" class="img-responsive">
</section>
<section class="gallery_s">
<div class="container">
	<h2>Our Gallery</h2>
    <div class="row">
    	@foreach($gallery as $gall)
            <div class="col-md-4">
                <img src="{!! asset($gall->image) !!}" class="img-responsive">
            </div>
        @endforeach
    </div>
</div>
</section>



@endsection
