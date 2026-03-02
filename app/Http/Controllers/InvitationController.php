<?php

namespace App\Http\Controllers;

use App\Enums\StatusInvitation;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreinvitationRequest;
use App\Http\Requests\UpdateinvitationRequest;
use App\Models\Invitation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class InvitationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($token)
    {
        $invitation = Invitation::with('colocation')->where('token', $token)->first();

        return view('invitation', compact('invitation'));
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
    public function store(StoreinvitationRequest $request)
    {
        $emailDestinataire = $request->email;
        $invitation = Invitation::create([
                        'email'             => $request->email,
                        'token'             => Str::uuid(),
                        'expires_at'        => now()->addDays(1),
                        'colocation_id'     => $request->colocation_id
                    ]);

        Mail::raw('Vous êtes invité à rejoindre une colocation via ce lien: http://127.0.0.1:8000/invitations/' . $invitation->token, function ($message) use($emailDestinataire){
            $message->to($emailDestinataire)->subject('Devenir membre');
        });

        return back()->with('succes', 'Invitation envoyée. code:'.$invitation->token);
    }

    /**
     * Display the specified resource.
     */
    public function show(invitation $invitation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(invitation $invitation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateinvitationRequest $request, invitation $invitation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(invitation $invitation)
    {
        //
    }

    public function reject($token){
        $invitation = Invitation::where('token', $token)->first();
        $invitation->update([
            'status_invitation' => StatusInvitation::DECLINED,
        ]);

        return redirect()->route('accueil');
    }

    public function accept($token){
        $invitation = Invitation::with('colocation')->where('token', $token)->first();
        $invitation->update([
            'status_invitation' => StatusInvitation::ACCEPTED,
        ]);

        // Interruption de l'opération si l'utilisateur est déjà dans une colocation qui est active.
        if(Auth::user()->activeColocation->first())
            return redirect()->intended(route('accueil', absolute: false));

        $invitation->colocation->users()->attach(
            Auth::id(), ['joined_at' => now()]
        );

        return redirect()->route('accueil');
    }
}
