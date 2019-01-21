@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('partials.sidebar')
            <div class="col-sm-10">
                <div class="container-3">
                    <h2>Edit role:</h2>

                    <form action="{{ route('roles.update', [$role->id]) }}" method="POST">
                        @csrf
                        {{method_field('PATCH')}}
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $role->name }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    <br>
                    <a href="{{ route('roles.index') }}">Back</a>
                </div>
            </div>
        </div>
    </div>

@endsection
