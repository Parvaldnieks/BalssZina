<x-app-layout>
    <div class="max-w-md mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-4">User Info</h1>

        <div class="bg-white shadow p-4 rounded">
            <p><strong>ID:</strong> {{ $user->id }}</p>
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Admin:</strong> {{ $user->admin ? 'Yes' : 'No' }}</p>
            <p><strong>Created:</strong> {{ $user->created_at }}</p>
            <p><strong>Updated:</strong> {{ $user->updated_at }}</p>


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
