@extends('layout')

@section('content')
    <main>

        <x-user :user="$user"/>
        <h1 class="text-white text-center text-2xl mt-10">Repositories</h1>
        <x-repos :repos="$user->repositories()->paginate()"/>

    </main>
@endsection
