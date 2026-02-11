<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tableau de bord') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- My Events Section -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Mes Événements Créés</h3>
                    @if($myEvents->isEmpty())
                        <p class="text-gray-600 dark:text-gray-400">Vous n'avez créé aucun événement.</p>
                        <a href="{{ route('events.create') }}" class="text-indigo-600 hover:text-indigo-900 mt-2 inline-block">Créer un événement</a>
                    @else
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($myEvents as $event)
                                <li class="py-3 flex justify-between items-center">
                                    <div>
                                        <p class="text-gray-900 dark:text-gray-100 font-semibold">{{ $event->title }}</p>
                                        <p class="text-sm text-gray-500">{{ $event->date->format('d/m/Y H:i') }}</p>
                                    </div>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('events.show', $event) }}" class="text-blue-500 hover:underline text-sm">Voir</a>
                                        <a href="{{ route('events.edit', $event) }}" class="text-yellow-500 hover:underline text-sm">Modifier</a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <!-- My Reservations Section -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Mes Réservations</h3>
                    @if($myReservations->isEmpty())
                         <p class="text-gray-600 dark:text-gray-400">Vous n'avez aucune réservation.</p>
                         <a href="{{ route('events.index') }}" class="text-indigo-600 hover:text-indigo-900 mt-2 inline-block">Parcourir les événements</a>
                    @else
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($myReservations as $reservation)
                                <li class="py-3 flex justify-between items-center">
                                    <div>
                                        <p class="text-gray-900 dark:text-gray-100 font-semibold">{{ $reservation->event->title }}</p>
                                        <p class="text-sm text-gray-500">{{ $reservation->event->date->format('d/m/Y H:i') }} | {{ $reservation->event->location }}</p>
                                    </div>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('events.show', $reservation->event) }}" class="text-blue-500 hover:underline text-sm">Voir l'événement</a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
