@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('partials.sidebar')
            <div class="col-sm-10">
                <div class="container-3">
                    <h2>Create role:</h2>
                    <form action="{{ route('roles.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name">
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
