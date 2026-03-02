<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDepenseRequest;
use App\Http\Requests\UpdateDepenseRequest;
use App\Models\Categorie;
use App\Models\Depense;
use Illuminate\Support\Facades\Auth;

class DepenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreDepenseRequest $request)
    {
        $id_categorie = $request->categorie_id;

        if($request->nom_categorie){
            $nouvelleCategorie = Categorie::create([
                'nom_categorie' => $request->nom_categorie,
                'colocation_id' => $request->id_colocation
            ]);

            $id_categorie = $nouvelleCategorie->id_categorie;
        }

        $depense = Depense::create([
            'titre_depense' => $request->titre_depense,
            'montant_depense' => $request->montant_depense,
            'creator_id' => Auth::id(),
            'categorie_id' => $id_categorie
        ]);

        return back()->with('success', 'Dépense créée avec succés!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Depense $depense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Depense $depense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepenseRequest $request, Depense $depense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Depense $depense)
    {
        //
    }
}
