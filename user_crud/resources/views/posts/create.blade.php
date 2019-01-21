@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('partials.sidebar')
            <div class="col-sm-10">
                <div class="container-3">
                    <h2>Create post:</h2>
                    <form action="{{ route('posts.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title">
                        </div>

                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea name="body" class="form-control"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    <br>
                    <a href="{{ route('posts.index') }}">Back</a>
                </div>
            </div>
        </div>
    </div>

@endsection
