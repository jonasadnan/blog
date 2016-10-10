@extends('main')

@section('title','| Homepage')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron">
                <h1>Welcome to my first blog in Laravel!</h1>
                <p class="lead">Thanking for visiting my page. There will be more news coming in this blog. Please read
                    my popular post! </p>
                <p><a class="btn btn-primary btn-lg" href="#" role="button">Popular Post</a></p>
            </div>
        </div>
    </div> <!-- end of header .row -->

    <div class="row">
        <div class="col-md-8">

            @foreach($posts as $post)

                <div class="post">
                    <h3>{{ $post->title }}</h3>
                    <p>{{ substr($post->body, 0, 100) }} {{ strlen($post->body)> 100 ? "...": " " }}</p>
                    <a href="{{ route('blog.single', $post->slug) }}" class="btn btn-primary">Read More</a>
                </div>

                <hr>

            @endforeach

        </div>

        <div class="col-md-3 col-md-offset-1">
            <h2> Sidebar</h2>
        </div>
    </div>

@endsection


<!-- url('blog/'.$post->slug) -->