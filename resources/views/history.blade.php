@extends('layout')

@section('content')
    <main>
        <h1 class="text-white text-center text-2xl mt-10">Commits history
            for <a href="https://github.com/{{ $repo->full_name }}" class="font-bold" target="_blank">{{ $repo->name }}</a> repository</h1>
        <x-chart :data="$repo->histories()->select(['date', 'commits'])->get()->reverse()"/>

        <div class="flex justify-center">
            <a href="{{ route('home') }}">
            <div class="block p-6 rounded-lg shadow-lg max-w-sm flex grid-rows-2 gap-4 bg-slate-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                <p class="text-black text-base">
                    Back
                </p>
            </div>
        </a>
        </div>
    </main>
@endsection
