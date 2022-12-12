@props(['user'])

<div class="flex items-center justify-center">
    <div class="bg-dark-primary w-2/3 mt-10 rounded-lg">
        <div class="flex items-center justify-center pt-10 flex-col">
            <img src="{{ $user->avatar }}" alt="User image" class="rounded-full w-32 font-semibold text-xl mt-5">
            <h1 class="text-gray-400">
                {{ $user->name }}
            </h1>
            <a class="text-gray-300 text-sm p-4" href={{ "https://github.com/$user->nickname" }}>{{ "@$user->nickname" }}</a>
        </div>
        <div class="pl-10 pb-10">
            <a href="{{ route('logout') }}" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Logout</a>
        </div>
    </div>
</div>
