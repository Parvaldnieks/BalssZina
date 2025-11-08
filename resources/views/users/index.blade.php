<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-6">All Users</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <a class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300"
            href="{{ route('users.create') }}">
            <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-gray-100 rounded-md group-hover:bg-transparent">
                {{ __('Izveidot') }}
            </span>
        </a>

        <table class="w-full border border-gray-300 text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border-b">ID</th>
                    <th class="p-2 border-b">Name</th>
                    <th class="p-2 border-b">Email</th>
                    <th class="p-2 border-b">Admin</th>
                    <th class="p-2 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-2">{{ $user->id }}</td>
                        <td class="p-2">
                            <a href="{{ route('users.show', $user) }}" class="text-blue-600 hover:underline">
                                {{ $user->name }}
                            </a>
                        </td>
                        <td class="p-2">{{ $user->email }}</td>
                        <td class="p-2">{{ $user->admin ? 'Yes' : 'No' }}</td>
                        <td class="p-2 space-x-2">
                            <a href="{{ route('users.edit', $user) }}" class="text-yellow-600 hover:underline">Edit</a>
                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Delete this user?')" class="text-red-600 hover:underline">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
