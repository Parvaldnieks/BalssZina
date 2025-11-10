<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            {{ __('Rediģēt Lietotaju') }}
        </h2>
    </x-slot>

    <div class="max-w-lg mx-auto mt-10">

        <form action="{{ route('users.update', $user) }}" method="POST" class="bg-white shadow rounded-lg p-6 space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-medium">Vārds</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                       class="border-gray-300 rounded w-full">
                @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-medium">E-pasts</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                       class="border-gray-300 rounded w-full">
                @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-medium">Parole (var nemainīt)</label>
                <input type="password" name="password" class="border-gray-300 rounded w-full">
                @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="inline-flex items-center">
                    <input type="checkbox" name="admin" class="rounded" {{ $user->admin ? 'checked' : '' }}>
                    <span class="ml-2">Administrators</span>
                </label>
            </div>

            <div class="mt-6">
                <h2 class="text-lg font-semibold mb-2">Privilēģijas</h2>
                <div class="bg-white shadow p-4 rounded grid grid-cols-1 sm:grid-cols-2 gap-2">
                    @foreach ($permissions as $permission)
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                   {{ in_array($permission->id, $userPermissions) ? 'checked' : '' }}
                                   class="rounded border-gray-300">
                            <span>{{ $permission->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="flex justify-between mt-6">
                <a class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300"
                    href="{{ route('users.index') }}">
                    <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white rounded-md group-hover:bg-transparent">
                        {{ __('Atpakaļ') }}
                    </span>
                </a>

                <button type="submit" class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300">
                    <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white rounded-md group-hover:bg-transparent">
                        {{ __('Saglabāt') }}
                    </span>
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
