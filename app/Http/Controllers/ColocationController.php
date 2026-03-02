<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreColocationRequest;
use App\Enums\UserRole;
use Illuminate\Support\Facades\Auth;

class ColocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $colocations = Colocation::with('users')->get();

        return view('colocations', compact('colocations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreColocationRequest $request)
    {
        // Vérifier l'existance d'une colocation active
        if(Auth::user()->activeColocation()->first())
            return back()->with('error', 'Vous avez déjà une colocation active.');

        // Créer la colocation
        $colocation = Colocation::create([
            'nom_colocation' => $request->nom_colocation,
            'description_colocation' => $request->description_colocation,
            'status_colocation' => 'active',
        ]);

        // Ajouter le créateur comme Owner dans le pivot
        $colocation->users()->attach(Auth::id(), [
            'role' => UserRole::Owner->value, // <- passe la valeur de l'enum
            'joined_at' => now(),
        ]);

        return redirect()->route('accueil')
                        ->with('success', 'Colocation créée et propriétaire ajouté !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Colocation $colocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Colocation $colocation)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Colocation $colocation)
    {
        // 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Colocation $colocation)
    {
        $colocation->update([
            'status_colocation' => 'deleted'
        ]);

        return back()->with('succes', 'Colocation supprimée avec succés.');
    }

    public function cancel(Colocation $colocation)
    {
        $colocation->update([
            'status_colocation' => 'canceled'
        ]);

        return back()->with('succes', 'Colocation annulée avec succés.');
    }
}
