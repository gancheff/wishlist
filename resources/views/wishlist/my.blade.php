@extends('layouts.app')

@section('title', 'My wishlist')

@section('content')
<div class="row">
    <div class="col-sm-8">
        <h2>My wishlist</h2>

        <div id="wishlist">
            @foreach ($items as $item)
                <div class="item">
                    <p class="title"><a href="{{ $item->repository_url }}">{{ $item->name }}</a></p>
                    <p class="description"><strong>{{ $item->description }}</strong></p>
                    <p class="remove"><a href="{{ route('remove', ['id' => $item->id]) }}" >Remove</a></p>
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-sm-4">
        <h2>Top 10 updated in PHP</h2>

        <div id="top10php">
            Loading...
        </div>
    </div>
</div>
@endsection