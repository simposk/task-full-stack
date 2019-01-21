@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('partials.sidebar')
            <div class="col-sm-10">
                <div class="container-1">

                    <div class="post-title">
                        <h3>{{ $post->title }}</h3>
                        <small>
                            <em>
                                {{ $post->created_at->diffForHumans() }}
                            </em>
                        </small>
                    </div>

                    <div class="post-body">
                        <p>{{ $post->body }}</p>
                        <a href="{{ route('posts.index') }}">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
