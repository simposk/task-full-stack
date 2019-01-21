@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('partials.sidebar')
            <div class="col-sm-10">
                <div class="container-2">
                    <a href="{{ route('roles.create') }}">
                        <button class="btn btn-primary">
                            Create New
                        </button>
                    </a>
                </div>

                <table class="table container-1">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                <form method="POST" action="{{ route('roles.destroy', [$role->id]) }}">
                                    {{ method_field('DELETE') }}
                                    @csrf

                                    <button class="btn btn-danger btn-sm" type="submit">delete</button>
                                </form>

                                <a href="{{ route('roles.edit', [$role->id]) }}">
                                    <button class="btn btn-secondary btn-sm">edit</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $roles->links() }}
            </div>
        </div>
    </div>

@endsection
