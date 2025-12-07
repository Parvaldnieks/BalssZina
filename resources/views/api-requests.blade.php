<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-6">API Access Requests</h1>

        <table class="min-w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="border px-4 py-2">Device Name</th>
                    <th class="border px-4 py-2">Type</th>
                    <th class="border px-4 py-2">Email</th>
                    <th class="border px-4 py-2">Status</th>
                    <th class="border px-4 py-2">API Key</th>
                    <th class="border px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($requests as $req)
                <tr class="hover:bg-gray-100">
                    <td class="border px-4 py-2">{{ $req->device_name }}</td>
                    <td class="border px-4 py-2">
                        @if($req->requester_email)
                            <span class="bg-blue-200 text-blue-800 px-2 py-1 rounded">Human</span>
                        @else
                            <span class="bg-purple-200 text-purple-800 px-2 py-1 rounded">Machine</span>
                        @endif
                    </td>
                    <td class="border px-4 py-2">{{ $req->requester_email ?? '-' }}</td>
                    <td class="border px-4 py-2">
                        @if($req->status === 'pending')
                            <span class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded">Pending</span>
                        @elseif($req->status === 'approved')
                            <span class="bg-green-200 text-green-800 px-2 py-1 rounded">Approved</span>
                        @else
                            <span class="bg-red-200 text-red-800 px-2 py-1 rounded">Denied</span>
                        @endif

                        @if($req->blocked)
                            <span class="bg-gray-700 text-white px-2 py-1 rounded ml-1">Blocked</span>
                        @endif
                    </td>
                    <td class="border px-4 py-2">
                        @if($req->apiKey)
                            <code id="key-{{ $req->id }}">{{ $req->apiKey->key }}</code>
                            <button onclick="navigator.clipboard.writeText(document.getElementById('key-{{ $req->id }}').innerText)"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded ml-1">
                                Copy
                            </button>
                        @else
                            -
                        @endif
                    </td>
                    <td class="border px-4 py-2 space-x-2">
                        {{-- Pending actions --}}
                        @if($req->status === 'pending' && !$req->blocked)
                            <form method="POST" action="{{ url('/api/approve-access/'.$req->id) }}" class="inline">
                                @csrf
                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded">
                                    Approve
                                </button>
                            </form>
                            <form method="POST" action="{{ url('/api/deny-access/'.$req->id) }}" class="inline">
                                @csrf
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                                    Deny
                                </button>
                            </form>
                        @endif

                        {{-- Approved actions --}}
                        @if($req->status === 'approved' && !$req->blocked)
                            @if($req->apiKey)
                                <form method="POST" action="{{ route('api.key.delete', $req->id) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded">
                                        Delete Key
                                    </button>
                                </form>
                            @else
                                <form method="POST" action="{{ url('/api/approve-access/'.$req->id) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded">
                                        Generate Key
                                    </button>
                                </form>
                            @endif
                        @endif

                        {{-- Block/Unblock --}}
                        @if(!$req->blocked)
                            <form method="POST" action="{{ route('api.device.block', $req->id) }}" class="inline">
                                @csrf
                                <button type="submit" class="bg-red-700 hover:bg-red-800 text-white px-3 py-1 rounded">
                                    Block Device
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('api.device.unblock', $req->id) }}" class="inline">
                                @csrf
                                <button type="submit" class="bg-green-700 hover:bg-green-800 text-white px-3 py-1 rounded">
                                    Unblock Device
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="border px-4 py-2 text-center text-gray-500">No API requests yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
