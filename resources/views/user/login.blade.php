@extends('layouts.app')

@section('title', 'Login')
@section('content')
    <form method="POST" action="{{ route('login') }}" class="form-userform">
        <h2 class="form-userform-heading">Login</h2>
        @csrf
        <label for="email" class="sr-only">Email</label>
        <input id="email" type="email" name="email" class="form-control" placeholder="Email" required>
        <label for="password" class="sr-only">Password</label>
        <input id="password" type="password" name="password" class="form-control" placeholder="Password" required>

        <button type="submit" class="btn btn-lg btn-primary btn-block">Login</button>
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