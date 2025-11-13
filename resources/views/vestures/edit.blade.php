<x-app-layout>
    <div class="container max-w-[500px] mx-auto p-4">
        <x-slot name="header">
            <h2 class="font-semibold text-xl dark:text-white">
                {{ __('Rediģēt Vēsturi') }}
            </h2>
        </x-slot>

        <div class="p-[1px] border border-orange-500 dark:border-none dark:bg-gradient-to-br from-black via-orange-500 to-black rounded-lg shadow-sm">
            <div class="p-6 bg-white dark:bg-black shadow rounded-lg">
                <form
                    method="POST"
                    action="{{ route('vestures.update', $vesture->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-2">
                            <x-input-label for="name" :value="__('Nosaukums')" />
                            <x-text-input type="text" id="name" name="name" value="{{ old('name', $vesture->name) }}" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />

                            <x-input-label for="text" :value="__('Teksts')" />
                            <x-text-input type="text" id="text" name="text" value="{{ old('text', $vesture->text) }}" />
                            <x-input-error :messages="$errors->get('text')" class="mt-2" />

                            <x-input-label for="time" :value="__('Laiks')" />
                            <x-text-input type="datetime-local" id="time" name="time" value="{{ old('time', $vesture->formatted_time ?? '') }}" />
                            <x-input-error :messages="$errors->get('time')" class="mt-2" />

                        <div class="mt-6">
                            <x-input-label :value="__('MP3 Fails')" />
                            <x-text-input type="file" name="file" accept=".mp3" />

                            @if($vesture->mp3_path)
                                <div>
                                    <p class="text-sm text-gray-500">{{ __('Pašreizējais fails:') }}</p>
                                    <audio controls class="mt-1 w-full">
                                        <source src="{{ asset('storage/'.$vesture->mp3_path) }}" type="audio/mpeg">
                                        Jūsu pārlūkprogramma neatbalsta audio atskaņošanu.
                                    </audio>
                                </div>
                            @endif
                        </div>

                        <div class="flex justify-between">
                            <x-primary-button href="{{ route('vestures.index') }}">
                                    {{ __('Atpakaļ') }}
                            </x-primary-button>

                            <x-primary-button>
                                    {{ __('Saglabāt') }}
                            </x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
