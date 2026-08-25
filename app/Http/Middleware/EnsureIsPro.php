<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureIsPro
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if (!$user || !in_array($user->role, ['pair-aidant', 'psychologue']) || $user->statut !== 'actif') {
            abort(403, "Accès réservé aux pairs-aidants et psychologues validés.");
        }
        return $next($request);
    }
}
