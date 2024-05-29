@extends('layouts.app')

@section('title', 'Register')
@section('content')
    <form method="POST" action="{{ route('register') }}" class="form-userform">
        <h2 class="form-userform-heading">Register</h2>
        @csrf
        <label for="name" class="sr-only">Name</label>
        <input id="name" type="text" name="name" class="form-control" placeholder="Name" required>
        <label for="email" class="sr-only">Email</label>
        <input id="email" type="email" name="email" class="form-control" placeholder="Email" required>
        <label for="password" class="sr-only">Password</label>
        <input id="password" type="password" name="password" class="form-control" placeholder="Password" required>
        <label for="password_confirmation" class="sr-only">Confirm Password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
        <label for="api_key" class="sr-only">API Key</label>
        <input id="api_key" type="text" name="api_key" class="form-control" placeholder="API Key" required>

        <button type="submit" class="btn btn-lg btn-primary btn-block">Register</button>
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