@extends('frontend.layouts.app')
@section('content')
<section class="article-back">
    <div class="container">
        <h1>{{ $category->name }}</h1>
    </div>
</section>

<section class="home-index">
	<div class="container">
        <div class="row">
                        @foreach($most_articles as $article)
                            <div class="col-md-4 art-box">
                                <a href="{{ route('articleDetails', $article->url) }}">
                                <div class="article-image">
                                    <img alt="" class="img-responsive" src="{!! asset($article->image) !!}">
                                </div>
                                <h4>{{ $article->title}}</h4>
                                </a>
                            </div>
                        @endforeach
                </div>
            </div>
</section>



@endsection
