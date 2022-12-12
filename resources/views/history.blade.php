@extends('layout')

@section('content')
    <main>
        <h1 class="text-white text-center text-2xl mt-10">Commits history
            for <a href="https://github.com/{{ $repo->full_name }}" class="font-bold">{{ $repo->name }}</a> repository</h1>
        <livewire:chart :repo="$repo"/>
    </main>
@endsection
