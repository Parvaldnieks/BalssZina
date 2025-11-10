<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            {{ __('Lietotāja Informācija') }}
        </h2>
    </x-slot>

    <div class="max-w-md mx-auto mt-10">

        <div class="bg-white shadow p-4 rounded">
            <p><strong>ID:</strong> {{ $user->id }}</p>
            <p><strong>Vārds:</strong> {{ $user->name }}</p>
            <p><strong>E-pasts:</strong> {{ $user->email }}</p>
            <p><strong>Administrators:</strong> {{ $user->admin ? 'Jā' : 'Nē' }}</p>
            <p><strong>Kad izveidots:</strong> {{ $user->created_at }}</p>
            <p><strong>Kad atjaunots:</strong> {{ $user->updated_at }}</p>


            <div class="flex justify-between mt-4 flex space-x-2">
                <a class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300"
                    href="{{ route('users.index') }}">
                    <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white rounded-md group-hover:bg-transparent">
                        {{ __('Atpakaļ') }}
                    </span>
                </a>

                <a class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300"
                    href="{{ route('users.edit', $user) }}">
                    <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white rounded-md group-hover:bg-transparent">
                        {{ __('Rediģēt') }}
                    </span>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
