<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyColoc | Rejoindre colocation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<body class="bg-slate-50 dark:bg-slate-900 h-full flex items-center justify-center p-4">

    <div class="max-w-md w-full bg-white dark:bg-slate-800 rounded-2xl shadow-xl p-8 flex flex-col items-center text-center gap-6 border border-slate-100 dark:border-slate-700">
        
        <div class="size-20 rounded-full bg-primary/10 flex items-center justify-center text-primary">
            <span class="material-symbols-outlined text-5xl">drafts</span>
        </div>

        @if($invitation->expires_at->isPast())
            <p class="text-slate-500 dark:text-slate-400 mt-2">L'invitation a expirée.</p>
        @else
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Invitation</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-2">Vous avez été invité à rejoindre la colocation :</p>
            <p class="text-l font-extrabold text-primary mt-1 uppercase tracking-tight">
                {{ $invitation->colocation->nom_colocation }}
            </p>
        </div>

        <div class="w-full flex flex-col sm:flex-row gap-3 mt-4">
            <form action="{{ route('invitations.reject', $invitation->token) }}" method="POST" class="flex-1">
                
                @csrf
                <button type="submit" 
                        class="w-full py-3 px-4 rounded-xl border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 font-semibold hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-all">
                    Refuser
                </button>
            </form>

            <form action="{{ route('invitations.accept', $invitation->token) }}" method="POST" class="flex-1">
                
                @csrf
                <button type="submit" 
                        class="w-full py-3 px-4 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold shadow-lg shadow-blue-200 dark:shadow-none transition-all transform hover:-translate-y-1">
                    Accepter
                </button>
            </form>
        </div>

        <p class="text-xs text-slate-400 italic">
            Cette invitation expire le {{ $invitation->expires_at->format('d/m/Y à H:i') }}
        </p>
        @endif
    </div>

</body>
</html>