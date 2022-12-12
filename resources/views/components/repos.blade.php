@props(['repos'])

<div class="bg-slate-800 px-32 py-10">
    <div class="grid grid-cols-3 gap-4 pb-10">
        @if($repos->isEmpty())
            <div class="col-span-3 text-center text-white text-2xl">No repositories found</div>
        @else
            @foreach($repos as $repo)
                <div class="bg-dark-secondary flex items-center p-2 rounded-xl shadow-xl border">
                    <div class="flex-grow p-1">
                    <span class="font-semibold text-gray-400">
                        <a href="/{{ $repo->id }}/history">{{ $repo->name }}</a>
                    </span>
                    </div>
                    <a href="{{ "https://github.com/$repo->full_name" }}" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-external-link" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="gray" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M11 7h-5a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-5"></path>
                            <line x1="10" y1="14" x2="20" y2="4"></line>
                            <polyline points="15 4 20 4 20 9"></polyline>
                        </svg>
                    </a>
                </div>
            @endforeach
        @endif
    </div>
    {{ $repos->links() }}
</div>


