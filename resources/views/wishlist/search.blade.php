@extends('layouts.app')

@section('title', 'Search libraries.io')

@section('content')
<h2>Search libraries.io</h2>

<form id="search" method="POST">
    @csrf
    <div class="row">
        <div class="col-sm-8">
            <label for="keywords" class="sr-only">Keywords</label>
            <input id="keywords" name="keywords" type="text" class="form-control" placeholder="Keywords">
        </div>
        <div class="col-sm-4">
            <button type="submit" class="btn btn-primary btn-block">Search</button>
        </div>
    </div>
</form>

<div id="results">

</div>
@endsection
