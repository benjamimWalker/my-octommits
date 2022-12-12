@extends('layout')

@section('content')
    <h1 class="text-white text-lg">
        Commits for {{ $repo->name }} repository
    </h1>

    <livewire:chart :repo="$repo"/>
@endsection
