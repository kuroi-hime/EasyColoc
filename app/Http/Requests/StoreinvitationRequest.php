<?php

namespace App\Http\Requests;

use App\Enums\StatusInvitation;
use Illuminate\Foundation\Http\FormRequest;

class StoreinvitationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email'             => 'required|email',
            // 'token'             => 'required|string|unique:invitations,token',
            // 'expires_at'        => 'required|date|after:now',
            'colocation_id'     => 'required|integer|exists:colocations,id_colocation',
        ];
    }
}
