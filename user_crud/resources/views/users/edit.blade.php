@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('partials.sidebar')
            <div class="col-sm-10">
                <div class="container-3">
                    <h2>Edit user:</h2>
                    <form action="{{ route('users.update', [$user->id]) }}" method="POST">
                        @csrf
                        {{method_field('PATCH')}}
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $user->name  }}">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                        </div>

                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control" name="role">
                                <option value="admin">Admin</option>
                                <option value="developer">Developer</option>
                                <option value="user">User</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    <br>
                    <a href="{{ route('users.index') }}">Back</a>
                </div>
            </div>
        </div>
    </div>

@endsection
