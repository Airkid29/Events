<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $event->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                             @if ($event->image_path)
                                <img src="{{ asset('storage/' . $event->image_path) }}" alt="{{ $event->title }}" class="w-full rounded-lg shadow-md mb-4">
                            @endif
                        </div>
                        <div>
                            <p class="text-lg mb-4">{{ $event->description }}</p>
                            <div class="grid grid-cols-2 gap-4 text-sm text-gray-600 dark:text-gray-400 mb-6">
                                <div><strong>Date:</strong> {{ $event->date->format('d/m/Y H:i') }}</div>
                                <div><strong>Lieu:</strong> {{ $event->location }}</div>
                                <div><strong>Capacité:</strong> {{ $event->capacity }} places</div>
                                <div><strong>Organisateur:</strong> {{ $event->user->name }}</div>
                            </div>

                            @can('update', $event)
                                <div class="flex space-x-4 mb-4">
                                    <a href="{{ route('events.edit', $event) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Modifier</a>
                                    <form action="{{ route('events.destroy', $event) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Supprimer</button>
                                    </form>
                                </div>
                            @endcan

                            <!-- Reservation Logic -->
                            <div class="mt-4">
                                @auth
                                    @if(auth()->user()->reservations()->where('event_id', $event->id)->exists())
                                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                                            Vous avez réservé cet événement.
                                        </div>
                                    @elseif($event->reservations_count >= $event->capacity)
                                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                                            Événement complet.
                                        </div>
                                    @else
                                        <form action="{{ route('events.reserve', $event) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded w-full">
                                                Réserver une place
                                            </button>
                                        </form>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="block text-center bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded w-full">
                                        Connectez-vous pour réserver
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
