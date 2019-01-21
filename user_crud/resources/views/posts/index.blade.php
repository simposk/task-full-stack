@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('partials.sidebar')
            <div class="col-sm-10">
                <div class="container-2">
                    <a href="{{ route('posts.create') }}">
                        <button class="btn btn-primary">
                            Create New
                        </button>
                    </a>
                </div>

                <table class="table container-1">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Title</th>
                        <th scope="col">Body</th>
                        <th scope="col">Date</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>
                                <a href="{{ route('posts.show', [$post->id]) }}">
                                    {{ substr($post->title, 0, 30) }}
                                </a>
                            </td>
                            <td>{{ substr($post->body, 0, 30) }}...</td>
                            <td>{{ $post->created_at->diffForHumans() }}</td>
                            <td>
                                <form method="POST" action="{{ route('posts.destroy', [$post->id]) }}">
                                    {{ method_field('DELETE') }}
                                    @csrf

                                    <button class="btn btn-danger btn-sm" type="submit">delete</button>
                                </form>

                                <a href="{{ route('posts.edit', [$post->id]) }}">
                                    <button class="btn btn-secondary btn-sm">edit</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>



            </div>
        </div>
    </div>

@endsection
