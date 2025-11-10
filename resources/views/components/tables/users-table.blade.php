@props(['users'])

<div 
    x-data="{ 
        search: '', 
        users: {{ $users->toJson() }},
        get filtered() {
            if (this.search === '') return this.users;
            return this.users.filter(u =>
                u.name.toLowerCase().includes(this.search.toLowerCase()) ||
                u.email.toLowerCase().includes(this.search.toLowerCase())
            );
        }
    }"
    class="p-6"
>

    <input 
        type="text" 
        x-model="search"
        placeholder="Meklēt lietotājus..."
        class="border border-gray-300 rounded px-3 py-2 w-full mb-4 focus:border-blue-500 focus:ring-blue-500"
    >

    <table class="w-full border-collapse text-center">
        <thead>
            <tr>
                <th class="py-3 border-b border-gray-200">ID</th>
                <th class="border-b border-gray-200">Vārds</th>
                <th class="border-b border-gray-200">E-pasts</th>
                <th class="border-b border-gray-200">Administrators</th>
                <th class="border-b border-gray-200">Darbības</th>
            </tr>
        </thead>

        <tbody>
            <template x-if="filtered.length === 0">
                <tr>
                    <td colspan="5" class="text-gray-500 italic text-center py-4">
                        Nekas netika atrasts.
                    </td>
                </tr>
            </template>

            <template x-for="user in filtered" :key="user.id">
                <tr>
                    <td class="px-6 py-4 border-b border-gray-200" x-text="user.id"></td>
                    
                    <td class="px-6 py-4 border-b border-gray-200">
                        <a 
                            :href="`/users/${user.id}`"
                            class="text-blue-500 hover:text-blue-700 hover:underline"
                            x-text="user.name"
                        ></a>
                    </td>

                    <td class="px-6 py-4 border-b border-gray-200" x-text="user.email"></td>

                    <td class="px-6 py-4 border-b border-gray-200" x-text="user.admin ? 'Jā' : 'Nē'"></td>

                    <td class="px-6 py-4 border-b border-gray-200 space-x-3">
                        <a 
                            :href="`/users/${user.id}/edit`"
                            class="text-yellow-500 hover:text-yellow-700 hover:underline"
                        >
                            Rediģēt
                        </a>

                        <form 
                            :action="`/users/${user.id}`" 
                            method="POST" 
                            class="inline-block"
                        >
                            @csrf
                            @method('DELETE')
                            <button 
                                type="submit" 
                                onclick="return confirm('Dzēst šo lietotāju?')"
                                class="text-red-500 hover:text-red-700 hover:underline"
                            >
                                Dzēst
                            </button>
                        </form>
                    </td>
                </tr>
            </template>
        </tbody>
    </table>
</div>
