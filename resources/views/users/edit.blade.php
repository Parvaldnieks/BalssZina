<x-app-layout>
    <div class="container max-w-[500px] mx-auto p-4">
        <x-slot name="header">
            <h2 class="font-semibold text-xl dark:text-white">
                {{ __('Rediģēt Lietotāju') }}
            </h2>
        </x-slot>

    
        <div class="p-[1px] border border-orange-500 dark:border-none dark:bg-gradient-to-br from-black via-orange-500 to-black rounded-lg shadow-sm">
            <form 
                action="{{ route('users.update', $user) }}" 
                method="POST" 
                class="bg-white dark:bg-black shadow rounded-lg p-6 space-y-4"
            >
                @csrf
                @method('PUT')

                <div>
                    <x-input-label for="name" :value="__('Vārds')" />
                    <x-text-input 
                        id="name"
                        name="name"
                        type="text"
                        class="mt-1 block w-full"
                        :value="old('name', $user->name)"
                    />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="email" :value="__('E-pasts')" />
                    <x-text-input 
                        id="email"
                        name="email"
                        class="mt-1 block w-full"
                        :value="old('email', $user->email)"
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="password" :value="__('Parole (var nemainīt)')" />
                    <x-text-input 
                        id="password"
                        name="password"
                        type="password"
                        class="mt-1 block w-full"
                        autocomplete="new-password"
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div>
                    <label class="inline-flex items-center">
                        <input 
                            type="checkbox" 
                            name="admin" 
                            class="rounded border-gray-300 text-orange-600 focus:ring-orange-500"
                            {{ $user->admin ? 'checked' : '' }}
                        >
                        <span class="ml-2 dark:text-white">Administrators</span>
                    </label>
                </div>

                <div class="mt-6">
                    <h2 class="text-lg font-semibold mb-2 dark:text-white">{{ __('Privilēģijas') }}</h2>
                    <div class="bg-white dark:bg-black shadow p-4 rounded grid grid-cols-1 sm:grid-cols-2 gap-2">
                        @foreach ($permissions as $permission)
                            <label class="inline-flex items-center space-x-2 dark:text-white">
                                <input 
                                    type="checkbox" 
                                    name="permissions[]" 
                                    value="{{ $permission->id }}"
                                    {{ in_array($permission->id, $userPermissions) ? 'checked' : '' }}
                                    class="rounded border-gray-300 text-orange-600 focus:ring-orange-500"
                                >
                                <span>{{ $permission->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-between mt-6">
                    <x-primary-button href="{{ route('users.index') }}">
                        {{ __('Atpakaļ') }}
                    </x-primary-button>

                    <x-primary-button>
                        {{ __('Saglabāt') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
