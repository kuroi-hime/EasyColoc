<x-app-layout>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col overflow-x-hidden overflow-y-auto bg-background-light dark:bg-background-dark p-4 md:p-8">

        <div class="max-w-7xl mx-auto w-full flex flex-col gap-8">

            <!-- Balance Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Total Balance -->
                <div class="flex flex-col gap-1 rounded-2xl p-6 bg-white dark:bg-surface-dark border border-slate-100 dark:border-slate-800 shadow-sm relative overflow-hidden group">
                    <div class="absolute right-0 top-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity text-primary">
                        <span class="material-symbols-outlined text-8xl">account_balance_wallet</span>
                    </div>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium uppercase tracking-wider">Solde Total</p>
                    <div class="flex items-baseline gap-2 mt-2">
                        <p class="text-text-main dark:text-white text-3xl font-bold tracking-tight">+ {{ number_format($bilan['solde'], 2) }} MAD</p>
                    </div>
                </div>
                <!-- You are owed -->
                <div class="flex flex-col gap-1 rounded-2xl p-6 bg-white dark:bg-surface-dark border border-slate-100 dark:border-slate-800 shadow-sm relative overflow-hidden group">
                    <div class="absolute right-0 top-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity text-emerald-500">
                        <span class="material-symbols-outlined text-8xl">arrow_circle_down</span>
                    </div>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium uppercase tracking-wider">On vous doit</p>
                    <div class="flex items-baseline gap-2 mt-2">
                        <p class="text-text-main dark:text-white text-3xl font-bold tracking-tight">{{ number_format($bilan['avancé_aux_autres'], 2) }} MAD</p>
                    </div>
                </div>
                
                <!-- You owe -->
                <div class="flex flex-col gap-1 rounded-2xl p-6 bg-white dark:bg-surface-dark border border-slate-100 dark:border-slate-800 shadow-sm relative overflow-hidden group">
                    <div class="absolute right-0 top-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity text-rose-500">
                        <span class="material-symbols-outlined text-8xl">arrow_circle_up</span>
                    </div>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium uppercase tracking-wider">Vous devez</p>
                    <div class="flex items-baseline gap-2 mt-2">
                        <p class="text-text-main dark:text-white text-3xl font-bold tracking-tight">{{ number_format($bilan['dettes_aux_autres'], 2) }} MAD</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Recent Expenses Table (Left 2/3) -->
                <div class="lg:col-span-2 flex flex-col gap-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-bold text-text-main dark:text-white">Dépenses récentes</h2>
                        <button class="text-primary hover:text-primary/80 text-sm font-semibold p-2 border border-text-main bg-text-main rounded-xl" id="add_depense">+ dépense</button>
                    </div>

                    <div class="flex gap-2 items-center">
                        <p>Filtrer par mois:</p>
                        <select name="month" id="month" class="rounded-xl">
                            <option value="">{{ __('Tous les mois') }}</option>
                            @foreach(['Jan', 'Feb',] as $month)
                                <option value="">{{$month}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="bg-white dark:bg-surface-dark rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm overflow-hidden">
                        <div class="overflow-x-auto">
                            
                            @empty($activeColocation->depenses->first())
                            <p class="text-l p-6">Pas de dépenses pour le moment.</p>
                            @else
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b border-slate-100 dark:border-slate-700/50">
                                    <th class="py-4 px-6 text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Dépense</th>
                                    <th class="py-4 px-6 text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Payeur</th>
                                    <th class="py-4 px-6 text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Date</th>
                                    <th class="py-4 px-6 text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400 text-right">Montant(MAD)</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                                    @foreach($activeColocation->depenses as $depense)
                                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                        <td class="py-4 px-6">
                                            <div class="flex items-center gap-3">
                                                <div>
                                                    <p class="font-semibold text-text-main dark:text-slate-200">{{ $depense->categorie->nom_categorie }}</p>
                                                    <p class="text-xs text-slate-500">{{ $depense->titre_depense }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="flex items-center gap-2">
                                                @php 
                                                    $vous = $depense->creator->id == Auth::id() ? '(Vous)':'';
                                                @endphp
                                                <span class="text-sm text-slate-700 dark:text-slate-300">{{ $depense->creator->name }} {{$vous}}</span>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <span class="text-sm text-slate-500">{{ $depense->created_at->format('M j, Y') }}</span>
                                        </td>
                                        <td class="py-4 px-6 text-right">
                                            <span class="font-bold text-text-main dark:text-white">{{ $depense->montant_depense }}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endempty
                        </div>
                    </div>
                </div>

                <!-- Who Owes Who and members (Right 1/3) -->
                <div>
                    <!-- Inviter membre ou quitter colocation -->
                    <div class="flex flex-wrap gap-4 mt-auto mb-2">
                        <button id="invite_form_open" type="button" 
                                class="flex-1 px-4 py-2.5 rounded-xl bg-primary hover:bg-primary/90 text-white text-sm font-semibold transition-all shadow-sm flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-sm">person_add</span>
                            Inviter
                        </button>

                        <form action="{{ route('colocations.leave') }}" method="POST" class="flex-1">
                            @csrf
                            <button type="submit" 
                                    onclick="return confirm('Êtes-vous sûr de vouloir quitter la colocation ?')"
                                    class="w-full px-4 py-2.5 rounded-xl border border-rose-200 dark:border-rose-900/30 text-rose-600 dark:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-900/10 text-sm font-semibold transition-all flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-sm">logout</span>
                                Quitter
                            </button>
                        </form>
                    </div>

                    <!-- Who Owes Who (Right 1/3) -->
                    <div class="flex flex-col gap-4">

                        <div class="flex items-center justify-between">
                            <h2 class="text-xl font-bold text-text-main dark:text-white">Remboursements</h2>
                        </div>
                        <div class="bg-white dark:bg-surface-dark rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm p-6 flex flex-col gap-6 h-full">
                            <!-- Item 1 -->
                            <div class="flex items-start gap-4">
                                <div class="size-12 rounded-full bg-cover ring-2 ring-emerald-100 dark:ring-emerald-900 shrink-0" data-alt="Alice portrait" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAacNTMSeVFUROPkBNDkNjlPjQjGOgSgnGiit7l1apBZATbhHinVMqpAOwTm20hxCnm675Y5qFFHqJFDKYV8eY4LG0nBb939lz02oPs1AB6iwc5CmKHP6s09w3Am25mpfK7jL-_hdUk2r4VGoBga06eHOPoxYIdLtZtjnbSRHESM2lhJtuT1GQEvTDDOqd2aCVAYBqk2EIaScm2YjjBi9OIhfP58DDrYTlOR8M5h5L3HCAQo3Gp0nfROJyLWxCB2ooIvs-EDJ3Pl5Q')"></div>
                                <div class="flex flex-col flex-1">
                                    <div class="flex justify-between items-center mb-1">
                                        <h3 class="font-semibold text-text-main dark:text-white">Alice</h3>
                                        <span class="text-emerald-600 dark:text-emerald-400 font-bold">+ €45.00</span>
                                    </div>
                                    <p class="text-sm text-slate-500 leading-snug">Alice vous doit pour <span class="text-slate-700 dark:text-slate-300 font-medium">Facture Internet</span>.</p>
                                    <div class="mt-2 w-full bg-slate-100 dark:bg-slate-800 rounded-full h-1.5 overflow-hidden">
                                        <div class="bg-emerald-500 h-1.5 rounded-full" style="width: 75%"></div>
                                    </div>
                                    <button class="text-xs text-primary font-semibold mt-2 self-start hover:underline">Marquer payée</button>
                                </div>
                            </div>

                            <div class="h-px w-full bg-slate-100 dark:bg-slate-800"></div>

                        </div>
                    </div>

                    <!-- Members -->
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center justify-between">
                            <h2 class="text-xl font-bold text-text-main dark:text-white">Colocataires</h2>
                        </div>

                        <div class="bg-white dark:bg-surface-dark rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm p-6 flex flex-col gap-6 h-full">
                            <!-- Item 1 -->
                            <div class="flex items-start gap-4">
                                <div class="flex flex-col flex-1">
                                    <div class="flex justify-between items-center mb-1">
                                        <h3 class="font-semibold text-text-main dark:text-white">Alice</h3>
                                        <span class="text-emerald-600 dark:text-emerald-400 font-bold">0 point(s)</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-2">
                                            <span class="material-symbols-outlined text-xs">crown</span>
                                            <p class="text-xs text-primary font-semibold self-start hover:underline">{{ __('Propriètaire') }}</p>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="material-symbols-outlined text-xs">crown</span>
                                            <span class="material-symbols-outlined text-xs">person_remove</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="h-px w-full bg-slate-100 dark:bg-slate-800"></div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    
    </main>

    <!-- Overlay Form Expense -->
    <div id="form_modal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

        <!-- Form -->
        <form action="{{ route('depense.add') }}" method="post"
            class="bg-white dark:bg-slate-900 w-full max-w-md m-auto mt-8 p-6 rounded-2xl shadow-xl flex flex-col gap-4">
            @csrf
            <h2 class="text-xl font-bold">Nouvelle dépense</h2>

            <input type="hidden" name="id_colocation" value="{{ $activeColocation->id_colocation }}">

            <div class="flex flex-col gap-2">
                <label for="titre">Titre :</label>
                <input type="text"
                    name="titre_depense"
                    id="titre"
                    class="border rounded-lg px-4 py-2">
            </div>
            
            <div class="flex flex-col gap-2">
                <label for="montant">Montant(MAD) :</label>
                <input type="number"
                    min=1
                    name="montant_depense"
                    id="montant"
                    class="border rounded-lg px-4 py-2">
            </div>
            
            <div class="flex flex-col gap-2">
                <label for="categorie">Catégorie :</label>
                <select name="categorie_id"
                    id="categorie"
                    class="border rounded-lg px-4 py-2">
                    @foreach($activeColocation->categories as $categorie)
                        <option value="{{ $categorie->id_categorie }}">{{ $categorie->nom_categorie }}</option>
                    @endforeach
                    <option value="">Autre</option>
                </select>
                @php
                    $hidden = $activeColocation->categories?'hidden ':'';
                @endphp
                <input type="text" name="nom_categorie" id="nom_categorie" class="{{ $hidden }}border rounded-lg px-4 py-2" 
                       placeholder="Entez la nouvelle catégorie">
            </div>

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

    <!-- Overlay Form Invite -->
    <div id="invite_form_modal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

        <!-- Form -->
        <form action="{{ route('invite.add') }}" method="post"
            class="bg-white dark:bg-slate-900 w-full max-w-md m-auto mt-8 p-6 rounded-2xl shadow-xl flex flex-col gap-4">
            @csrf
            <h2 class="text-xl font-bold">Inviter une personne</h2>

            <input type="hidden" name="colocation_id" value="{{ $activeColocation->id_colocation }}">

            <div class="flex flex-col gap-2">
                <label for="email">email :</label>
                <input type="email"
                    name="email"
                    id="email"
                    class="border rounded-lg px-4 py-2">
            </div>

            <div class="flex justify-end gap-3 mt-2">
                <button id="close_invite_form"
                        type="button"
                        class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300">
                    Annuler
                </button>

                <button type="submit"
                        class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                    Envoyer
                </button>
            </div>

        </form>
    </div>

    <script>
        let add_depense_btn = document.getElementById('add_depense');
        let close_form_btn = document.getElementById('close_form');
        let form_modal = document.getElementById('form_modal');

        let invite_form_btn = document.getElementById('invite_form_open');
        let invite_form_modal = document.getElementById('invite_form_modal');
        let close_invite_form_btn = document.getElementById('close_invite_form');

        add_depense_btn.addEventListener('click', ()=>{
            form_modal.classList.remove('hidden');
        });

        close_form_btn.addEventListener('click', ()=>{
            form_modal.classList.add('hidden');
        });

        // choix catégorie
        let select_categorie = document.getElementById('categorie');
        let input_categorie = document.getElementById('nom_categorie');

        select_categorie.addEventListener('input', ()=>{
            if(select_categorie.value === '')
                input_categorie.classList.remove('hidden');
            else
                input_categorie.classList.add('hidden');
        });

        // formulaire invitation
        invite_form_btn.addEventListener('click', ()=>{
            invite_form_modal.classList.remove('hidden');
        });

        close_invite_form_btn.addEventListener('click', ()=>{
            invite_form_modal.classList.add('hidden');
        });
    </script>

</x-app-layout>