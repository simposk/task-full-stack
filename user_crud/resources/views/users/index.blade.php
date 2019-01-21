@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('partials.sidebar')
            <div class="col-sm-10">
                @if(Auth::user()->role == "admin")
                    <div class="container-2">
                        <a href="{{ route('users.create') }}" class="left">
                            <button class="btn btn-primary">
                                Create New
                            </button>
                        </a>
                        <button class="btn btn-primary" v-on:click="callApi">
                            Api Call
                        </button>
                    </div>
                @endif
                <table class="table container-1">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            @if(Auth::user()->role == 'admin')
                                <th scope="col"></th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                @if(Auth::user()->role == 'admin')
                                    <td>
                                        <form method="POST" action="{{ route('users.destroy', [$user->id]) }}">
                                            {{ method_field('DELETE') }}
                                            @csrf

                                            <button class="btn btn-danger btn-sm" type="submit">delete</button>
                                        </form>

                                        <a href="{{ route('users.edit', [$user->id]) }}">
                                            <button class="btn btn-secondary btn-sm">edit</button>
                                        </a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection