<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Événements') }}
            </h2>
            @auth
                <a href="{{ route('events.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Créer un événement
                </a>
            @endauth
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <form action="{{ route('events.index') }}" method="GET" class="flex gap-4">
                    <input type="text" name="search" placeholder="Rechercher par titre..." class="border p-2 rounded w-full md:w-1/3" value="{{ request('search') }}">
                    <input type="date" name="date" class="border p-2 rounded w-full md:w-1/4" value="{{ request('date') }}">
                    <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Filtrer</button>
                    @if(request('search') || request('date'))
                        <a href="{{ route('events.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">Réinitialiser</a>
                    @endif
                </form>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($events as $event)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        @if ($event->image_path)
                            <img src="{{ asset('storage/' . $event->image_path) }}" alt="{{ $event->title }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-500">Pas d'image</span>
                            </div>
                        @endif
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h3 class="text-xl font-bold mb-2">{{ $event->title }}</h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm mb-2">{{ $event->date->format('d/m/Y H:i') }} | {{ $event->location }}</p>
                            <p class="mb-4 truncate">{{ $event->description }}</p>
                            <div class="flex justify-between items-center">
                                <a href="{{ route('events.show', $event) }}" class="text-blue-500 hover:underline">Voir détails</a>
                                <span class="text-sm font-semibold {{ $event->reservations_count >= $event->capacity ? 'text-red-500' : 'text-green-500' }}">
                                    {{ $event->reservations_count ?? 0 }} / {{ $event->capacity }} places
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $events->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
