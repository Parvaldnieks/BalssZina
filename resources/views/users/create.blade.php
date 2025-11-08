<x-app-layout>
    <div class="max-w-md mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-4">Izveidot lietotāju</h1>

        <form action="{{ route('users.store') }}" method="POST" class="bg-white shadow rounded-lg p-6 space-y-4">
            @csrf

            <div>
                <label class="block font-medium">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="border-gray-300 rounded w-full">
                @error('name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="border-gray-300 rounded w-full">
                @error('email')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium">Password</label>
                <input type="password" name="password" class="border-gray-300 rounded w-full">
                @error('password')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-between">
                <a class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300"
                    href="{{ route('users.index') }}">
                    <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white rounded-md group-hover:bg-transparent">
                        {{ __('Atpakaļ') }}
                    </span>
                </a>
                
                <button type="submit" class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300">
                    <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white rounded-md group-hover:bg-transparent">
                        {{ __('Izveidot') }}
                    </span>
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
