<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Modifier l\'événement') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('events.update', $event) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div>
                            <x-input-label for="title" :value="__('Titre')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $event->title)" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="4" required>{{ old('description', $event->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Date -->
                        <div class="mt-4">
                            <x-input-label for="date" :value="__('Date et Heure')" />
                            <x-text-input id="date" class="block mt-1 w-full" type="datetime-local" name="date" :value="old('date', $event->date->format('Y-m-d\TH:i'))" required />
                            <x-input-error :messages="$errors->get('date')" class="mt-2" />
                        </div>

                        <!-- Location -->
                        <div class="mt-4">
                            <x-input-label for="location" :value="__('Lieu')" />
                            <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" :value="old('location', $event->location)" required />
                            <x-input-error :messages="$errors->get('location')" class="mt-2" />
                        </div>

                        <!-- Capacity -->
                        <div class="mt-4">
                            <x-input-label for="capacity" :value="__('Capacité')" />
                            <x-text-input id="capacity" class="block mt-1 w-full" type="number" name="capacity" :value="old('capacity', $event->capacity)" required min="1" />
                            <x-input-error :messages="$errors->get('capacity')" class="mt-2" />
                        </div>

                        <!-- Image -->
                        <div class="mt-4">
                            <x-input-label for="image" :value="__('Image (optionnelle)')" />
                            @if($event->image_path)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $event->image_path) }}" alt="Current Image" class="h-20 w-20 object-cover rounded">
                                </div>
                            @endif
                            <input id="image" type="file" name="image" class="block mt-1 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Modifier l\'événement') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
