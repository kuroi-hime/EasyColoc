<x-app-layout>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col overflow-x-hidden overflow-y-auto bg-background-light dark:bg-background-dark p-4 md:p-8">

        <div class="max-w-7xl mx-auto w-full flex flex-col gap-8">

            <!-- Header Section -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <h2 class="text-xl font-bold text-text-main dark:text-white">Statistiques</h2>
                    <p class="text-slate-500 dark:text-slate-400 mt-1">Voici ce qui se passe avec vos dépenses partagées.</p>
                </div>
                <div class="flex items-center gap-2 text-sm text-slate-500 bg-white dark:bg-surface-dark px-3 py-1.5 rounded-lg shadow-sm border border-slate-100 dark:border-slate-800">
                    <span class="material-symbols-outlined text-lg">calendar_today</span>
                    <span>Octobre 2023</span>
                </div>
            </div>

            <!-- Balance Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                <!-- Total Balance -->
                <div class="flex flex-col gap-1 rounded-2xl p-6 bg-white dark:bg-surface-dark border border-slate-100 dark:border-slate-800 shadow-sm relative overflow-hidden group">
                    <div class="absolute right-0 top-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity text-primary">
                        <span class="material-symbols-outlined text-8xl">account_balance_wallet</span>
                    </div>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium uppercase tracking-wider">Utilisateur(s)</p>
                    <div class="flex items-baseline gap-2 mt-2">
                        <p class="text-text-main dark:text-white text-3xl font-bold tracking-tight">+ €120.50</p>
                    </div>
                    <div class="flex items-center gap-1 mt-1 text-primary text-sm font-medium">
                        <span class="material-symbols-outlined text-sm">trending_up</span>
                        <span>Statut sain</span>
                    </div>
                </div>

                <!-- You are owed -->
                <div class="flex flex-col gap-1 rounded-2xl p-6 bg-white dark:bg-surface-dark border border-slate-100 dark:border-slate-800 shadow-sm relative overflow-hidden group">
                    <div class="absolute right-0 top-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity text-emerald-500">
                        <span class="material-symbols-outlined text-8xl">arrow_circle_down</span>
                    </div>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium uppercase tracking-wider">Colocation(s)</p>
                    <div class="flex items-baseline gap-2 mt-2">
                        <p class="text-text-main dark:text-white text-3xl font-bold tracking-tight">€155.00</p>
                    </div>
                    <div class="flex items-center gap-1 mt-1 text-emerald-600 dark:text-emerald-400 text-sm font-medium">
                        <span>De 2 colocataires</span>
                    </div>
                </div>

                <!-- You owe -->
                <div class="flex flex-col gap-1 rounded-2xl p-6 bg-white dark:bg-surface-dark border border-slate-100 dark:border-slate-800 shadow-sm relative overflow-hidden group">
                    <div class="absolute right-0 top-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity text-rose-500">
                        <span class="material-symbols-outlined text-8xl">arrow_circle_up</span>
                    </div>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium uppercase tracking-wider">Dépense(s)</p>
                    <div class="flex items-baseline gap-2 mt-2">
                        <p class="text-text-main dark:text-white text-3xl font-bold tracking-tight">€34.50</p>
                    </div>
                    <div class="flex items-center gap-1 mt-1 text-rose-600 dark:text-rose-400 text-sm font-medium">
                        <span>À régler sous 5 jours</span>
                    </div>
                </div>

                <!-- You owe -->
                <div class="flex flex-col gap-1 rounded-2xl p-6 bg-white dark:bg-surface-dark border border-slate-100 dark:border-slate-800 shadow-sm relative overflow-hidden group">
                    <div class="absolute right-0 top-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity text-rose-500">
                        <span class="material-symbols-outlined text-8xl">arrow_circle_up</span>
                    </div>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium uppercase tracking-wider">Bannis</p>
                    <div class="flex items-baseline gap-2 mt-2">
                        <p class="text-text-main dark:text-white text-3xl font-bold tracking-tight">€34.50</p>
                    </div>
                    <div class="flex items-center gap-1 mt-1 text-rose-600 dark:text-rose-400 text-sm font-medium">
                        <span>À régler sous 5 jours</span>
                    </div>
                </div>

            </div>

            <!-- Recent Expenses Table -->
            <div class="lg:col-span-2 flex flex-col gap-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-text-main dark:text-white">Gestion utilisateurs</h2>
                    <input type="search" name="" id="">
                    <a class="text-primary hover:text-primary/80 text-sm font-semibold" href="#">chercher</a>
                </div>
                <div class="bg-white dark:bg-surface-dark rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-slate-100 dark:border-slate-700/50">
                                    <th class="py-4 px-6 text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">ID</th>
                                    <th class="py-4 px-6 text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Nom</th>
                                    <th class="py-4 px-6 text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Admin</th>
                                    <th class="py-4 px-6 text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Email</th>
                                    <th class="py-4 px-6 text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Réputation</th>
                                    <th class="py-4 px-6 text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400 text-right">Statut</th>
                                    <th class="py-4 px-6 text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                                @foreach($users as $user)
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-3">
                                            <div class="size-10 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 flex items-center justify-center shrink-0">
                                                <span class="material-symbols-outlined">shopping_cart</span>
                                            </div>
                                            <div>
                                                <p class="font-semibold text-text-main dark:text-slate-200">Courses hebdomadaires</p>
                                                <p class="text-xs text-slate-500">Supermarché</p>
                                            </div>
                                        </div>
                                        {{ $user->id }}
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-2">
                                            <!-- <div class="size-6 rounded-full bg-slate-200 bg-cover" data-alt="Alice avatar" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuA8Jy7ZG7yZn0Q592cZhFCTPfPZ2IHHytC87ZMwSHWsIVmFoKTZn__PV6IBf66UFQnZTtHwbyFBk1zunvH9XLA0ZnnZqH6-Up0DnGjQZ1BoqsnTebrVpbt4JIsLjOzYqH8_xESQH8nl4lhmv97s_waW40XRzv-xvJ1QaJi-qMLuz_LC-7R06_MvtgUCwf4D4Hxhohh_jCH6ZKrr7YjnSIBt52URGSyJbx2knN_p7jexFnvpKotVjP76soAuQmyklCkn3AInfC1yB8c')"></div> -->
                                            <span class="text-sm text-slate-700 dark:text-slate-300">{{ $user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        @php 
                                            $admin = $user->is_admin ? 'Oui':'Nom';
                                        @endphp
                                        <span class="text-sm text-slate-500">{{ $admin }}</span>
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <span class="font-bold text-text-main dark:text-white">€85.20</span>
                                    </td>
                                </tr>
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-3">
                                            <div class="size-10 rounded-full bg-orange-100 dark:bg-orange-900/30 text-orange-600 dark:text-orange-400 flex items-center justify-center shrink-0">
                                                <span class="material-symbols-outlined">wifi</span>
                                            </div>
                                            <div>
                                                <p class="font-semibold text-text-main dark:text-slate-200">Facture Internet</p>
                                                <p class="text-xs text-slate-500">Services publics</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-2">
                                            <div class="size-6 rounded-full bg-slate-200 bg-cover" data-alt="You avatar" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAD95ibdDJFI_VbNmexehKl3-0VTHKeuCvYttgalAwS4cFTi8-Q8MYCf8_snMCcFRsqgQDxZZS2VITsIBVAeY6H8yQhYqrrWb-1AMC-PlymGHpgBMWb04XzdNO5BVylGyoijY_OX6IDkAM2MI-eqJS6Fca8Sogq0tl0p0PnAxUeyFWCq2MBAHojGmxNDv3fZo2u-jdrsAawHQ-1UyKpx-_Ml5-cN9ESYXtfPewka3Bbm5rauZHh6oWimhS3RH3K3aGBl6qhAfa_7oI')"></div>
                                            <span class="text-sm text-slate-700 dark:text-slate-300">Vous</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="text-sm text-slate-500">Oct 22, 2023</span>
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <span class="font-bold text-text-main dark:text-white">€45.00</span>
                                    </td>
                                </tr>
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-3">
                                            <div class="size-10 rounded-full bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 flex items-center justify-center shrink-0">
                                                <span class="material-symbols-outlined">cleaning_services</span>
                                            </div>
                                            <div>
                                                <p class="font-semibold text-text-main dark:text-slate-200">Produits d'entretien</p>
                                                <p class="text-xs text-slate-500">Ménage</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-2">
                                            <div class="size-6 rounded-full bg-slate-200 bg-cover" data-alt="Marcus avatar" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCkxR_idXh3vuVdut_eQoy0BMO2xdIOpuLo9RLfjdWUJlfW6jslQaiINnKr7iQRZR_rYbQ3nUr95DJXNDMMzbCOaUzKHTcDmZXZ1WPwFzp2UbKaT4Y8B8bJCXhz8p7A715fYi5k39bgFuG8IjfuClM0qlzPSAb5RDvsSRl58hDaPPv_Y65km5k7YTDh8gCGgAbXPHfEQrW3-IZqamCcW0ACwO27_TRa-snTXKQm5QWk6CRLFYakH27oKNM1jdueoWH0dAImJBZ2eqU')"></div>
                                            <span class="text-sm text-slate-700 dark:text-slate-300">Marcus</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="text-sm text-slate-500">Oct 20, 2023</span>
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <span class="font-bold text-text-main dark:text-white">€12.50</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    
    </main>

</x-app-layout>