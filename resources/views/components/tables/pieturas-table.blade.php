@props(['pieturas', 'user', 'admin'])

<div 
    x-data="{ 
        search: '', 
        showMine: false,
        user: {{ $user }},
        pieturas: {{ $pieturas->toJson() }},
        get filtered() {
            let list = this.pieturas;

            if (this.showMine) {
                list = list.filter(p => p.user_id === this.user);
            }

            if (this.search !== '') {
                list = list.filter(p =>
                    p.name.toLowerCase().includes(this.search.toLowerCase()) ||
                    p.text.toLowerCase().includes(this.search.toLowerCase())
                );
            }

            return list;
        }
    }"
    class="p-6"
>

    <div class="max-w-md mx-auto flex flex-col sm:flex-row sm:space-x-4">
        <input 
            type="text" 
            x-model="search"
            placeholder="Meklēt pieturas..."
            class="border border-gray-300 rounded px-2 py-2 focus:border-blue-500 focus:ring-blue-500"
        >

        @if (auth()->user()->hasPermission('izveidot_pieturas'))
            <div>
                <button 
                    type="button"
                    @click="showMine = !showMine"
                    class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300"
                >
                    <span 
                        class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-gray-100 rounded-md group-hover:bg-transparent"
                        x-text="showMine ? 'Visas' : 'Manas'"
                    ></span>
                </button>
            </div>
        @endif
    </div>

    <table class="w-full border-collapse text-center">
        <thead>
            <tr>
                <th class="py-3 border-b border-gray-200">{{ __('Nosaukums') }}</th>
                <th class="border-b border-gray-200">{{ __('Atskaņot') }}</th>
                <th class="border-b border-gray-200">{{ __('Teksts') }}</th>
                @if (auth()->user()->hasPermission('izveidot_pieturas'))
                    <template x-if="showMine">
                        <th class="border-b border-gray-200">{{ __('Darbības') }}</th>
                    </template>
                @endif
            </tr>
        </thead>

        <tbody>
            <template x-if="filtered.length === 0">
                <tr>
                    <td colspan="3" class="text-gray-500 italic text-center py-4">
                        Nekas netika atrasts.
                    </td>
                </tr>
            </template>

            <template x-for="pietura in filtered" :key="pietura.id">
                <tr>

                    <td class="px-6 py-4 border-b border-gray-200">
                        <a 
                            :href="`/pieturas/${pietura.id}`"
                            class="text-blue-500 hover:text-blue-700 hover:underline"
                            x-text="pietura.name"
                        ></a>
                    </td>

                    <td class="px-6 py-4 border-b border-gray-200">
                        <audio
                            :src="pietura.latest_mp3_path ? `/storage/${pietura.latest_mp3_path}` : ''"
                            x-show="pietura.latest_mp3_path"
                            controls
                            preload="none"
                            class="w-64">
                        </audio>
                    </td>

                    <td class="px-6 py-4 border-b border-gray-200" x-text="pietura.text"></td>

                    @if (auth()->user()->hasPermission('izveidot_pieturas'))
                        <template x-if="showMine || {{ $admin ? 'true' : 'false' }}">
                            <td class="px-6 py-4 border-b border-gray-200 space-x-3">
                                <a 
                                    :href="`/pieturas/${pietura.id}/edit`"
                                    class="text-yellow-500 hover:text-yellow-700 hover:underline"
                                >
                                    Rediģēt
                                </a>

                                <form 
                                    :action="`/pieturas/${pietura.id}`" 
                                    method="POST" 
                                    class="inline-block"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button 
                                        type="submit" 
                                        class="text-red-500 hover:text-red-700 hover:underline"
                                    >
                                        Dzēst
                                    </button>
                                </form>
                            </td>
                        </template>
                    @endif
                </tr>
            </template>
        </tbody>
    </table>
</div>
