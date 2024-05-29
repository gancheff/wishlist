@extends('layouts.app')

@section('title', 'My profile')
@section('content')
    <form method="POST" action="{{ route('update') }}" class="form-userform">
        <h2 class="form-userform-heading">My profile</h2>
        @csrf
        <label for="name" class="sr-only">Name</label>
        <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" placeholder="Name" required>
        <label for="api_key" class="sr-only">API Key</label>
        <input id="api_key" type="text" name="api_key" value="{{ old('api_key', $user->api_key) }}" class="form-control" placeholder="API Key" required>

        <button type="submit" class="btn btn-lg btn-primary btn-block">Update</button>
    </form>
    @if($errors->any())
        <div>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
