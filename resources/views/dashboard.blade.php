<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-left items-center p-6">

                    @if (auth()->check() && auth()->user()->admin)
                        {{ __("Ar šo pogu tiek sinhronizēti visi MP3 faili, ja pieturām ir mainījies teksts!") }}
                        <form method="POST" action="{{ route('mp3.sync') }}" x-data="{ syncing:false }" @submit="syncing=true" class="ml-4">
                            @csrf
                            <button 
                                type="submit"
                                :disabled="syncing"
                                x-bind:class="{ 'opacity-50 cursor-not-allowed': syncing }"
                                class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300"
                            >
                                <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white rounded-md group-hover:bg-transparent flex items-center justify-center">

                                    <span x-bind:class="{ 'opacity-0': syncing }" class="transition-opacity duration-200">
                                        {{ __('sinhronizēt') }}
                                    </span>

                                    <svg 
                                        x-show="syncing"
                                        x-transition.opacity
                                        class="animate-spin h-5 w-5 absolute"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                    >
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                                    </svg>
                                </span>
                            </button>
                        </form>

                        @if (session('success'))
                            <div 
                                x-data="{ show: true }" 
                                x-show="show" 
                                x-transition.opacity.duration.500ms 
                                x-init="setTimeout(() => show = false, 3000)" 
                                class="text-green-500 font-medium rounded px-2 py-2"
                            >
                                {{ session('success') }}
                            </div>
                        @endif
                    @else
                        <p class="text-lg font-medium">
                            Sveiki, {{ auth()->user()->name }}!
                        </p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
