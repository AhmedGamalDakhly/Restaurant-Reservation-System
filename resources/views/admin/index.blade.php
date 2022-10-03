<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                   <h1 class="text-4xl"> welcome to {{env('APP_NAME')}} Restaurant Admin Panel </h1>
                </div>
            </div>
            <div class="mx-auto mt-12 bg-white overflow-hidden max-w-md shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 bg-green-100">
                    <a href="{{route('home')}}" class="text-2xl bg-gradient-to-r"> Surf Your webite like a guest </a>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
