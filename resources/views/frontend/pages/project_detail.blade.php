@extends('frontend.layouts.app')
@section('content')
<!-- <section class="article-back" style="background: url({!! asset($article->banner) !!}); background-repeat: no-repeat; background-attachment: fixed;">
    <div class="container">
        <h1>{{ $article->title }}</h1>
    </div>
</section> -->
<section class="sliders-page">
    <h2>{{ $article->title }}</h2>
    <div id="slider1" class="owl-carousel owl-theme">
        @foreach($sliders as $slider)
            <div class="item"> 
                <img src="{!! asset($slider->image) !!}" class="img-fluid mx-auto d-block" alt="">
            </div>
        @endforeach
    </div>
</section>
<section class="banner" style="padding: 20px 0 30px 0;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- <img style="margin-bottom: 30px;" src="{!! asset($article->image) !!}" class="img-fluid mx-auto d-block" alt=""> -->
                {!! $article->description !!}
            </div>

        </div>
    </div>
</section>




@endsection
