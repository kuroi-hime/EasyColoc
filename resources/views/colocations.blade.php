<x-app-layout>

    <div class="flex flex-col gap-4 px-8 pt-2">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-bold text-text-main dark:text-white">Vos colocations</h2>
            <button class="flex justify-center items-center gap-1 bg-primary text-text-main hover:text-primary/80 text-l p-2 rounded-xl font-semibold" id="add_coloc">
                <span class="material-symbols-outlined">add_circle</span>
                colocation
            </button>
        </div>
        
        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                @if($colocations->isNotEmpty())
                <table class="w-full text-sm text-left">
                    <thead class="bg-slate-50 dark:bg-slate-800/50">
                        <tr>
                            <th class="py-3 px-6 font-semibold uppercase tracking-wider text-slate-500">Nom</th>
                            <th class="py-3 px-6 font-semibold uppercase tracking-wider text-slate-500">Propriétaire</th>
                            <th class="py-3 px-6 font-semibold uppercase tracking-wider text-slate-500 text-center">Membres</th>
                            <th class="py-3 px-6 font-semibold uppercase tracking-wider text-slate-500 text-center">Status</th>
                            <th class="py-3 px-6 font-semibold uppercase tracking-wider text-slate-500">Date</th>
                            <th class="py-3 px-6 font-semibold uppercase tracking-wider text-slate-500 text-right">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        @foreach($colocations as $coloc)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/40 transition">
                            
                            <td class="py-4 px-6 font-medium text-slate-800 dark:text-slate-200">
                                {{ $coloc->nom_colocation }}
                            </td>

                            <td class="py-4 px-6 text-slate-600 dark:text-slate-400">
                                {{ $coloc->owner->first()->name }}
                            </td>

                            <td class="py-4 px-6 text-center text-slate-600 dark:text-slate-400">
                                {{ count($coloc->users) }}
                            </td>

                            <td class="py-4 px-6 text-center">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-600 dark:bg-green-900/30 dark:text-green-400">
                                    {{ $coloc->status_colocation }}
                                </span>
                            </td>

                            <td class="py-4 px-6 text-slate-500">
                                {{ $coloc->created_at->format('j M Y') }}
                            </td>

                            <td class="py-4 px-6">
                                <div class="flex justify-end gap-3 text-slate-500">
                                    <!-- <button class="hover:text-blue-600 transition">
                                        <span class="material-symbols-outlined text-base">edit</span>
                                    </button> -->
                                    <form action="{{ route('colocations.cancel', $coloc) }}" method="Post">
                                        @csrf 
                                        @method('PATCH')
                                        <button class="hover:text-yellow-600 transition">
                                            <span class="material-symbols-outlined text-base">cancel</span>
                                        </button>
                                    </form>

                                    <form action="{{ route('colocations.destroy', $coloc) }}" method="Post">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('Voulez-vous vraiment supprimer cette colocation?')"
                                                class="hover:text-red-600 transition">
                                            <span class="material-symbols-outlined text-base">delete</span>
                                        </button>
                                    </form>
                            
                                </div>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <p class="p-6">
                    {{ __('Pas de colocations pour le moments.')}}
                </p>
                @endif
            </div>
        </div>
    </div>

    <!-- Overlay -->
    <div id="form_modal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

        <!-- Form -->
        <form action="{{ route('colocation.add') }}" method="post"
            class="bg-white dark:bg-slate-900 w-full max-w-md m-auto mt-8 p-6 rounded-2xl shadow-xl flex flex-col gap-4">
            @csrf
            <h2 class="text-xl font-bold">Nouvelle colocation</h2>

            <input type="text"
                name="nom_colocation"
                id="nom_coloc"
                class="border rounded-lg px-4 py-2">

            <textarea name="description_colocation"
                    id="description_coloc"
                    rows="4"
                    class="border rounded-lg px-4 py-2 resize-none">
            </textarea>

            <div class="flex justify-end gap-3 mt-2">
                <button id="close_form"
                        type="button"
                        class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300">
                    Annuler
                </button>

                <button type="submit"
                        class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                    Ajouter
                </button>
            </div>

        </form>
    </div>

    <script>
        let add_coloc_btn = document.getElementById('add_coloc');
        let close_form_btn = document.getElementById('close_form');
        let form_modal = document.getElementById('form_modal');

        add_coloc_btn.addEventListener('click', ()=>{
            form_modal.classList.remove('hidden');
        });

        close_form_btn.addEventListener('click', ()=>{
            form_modal.classList.add('hidden');
        });
    </script>

</x-app-layout>