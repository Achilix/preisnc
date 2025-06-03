<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckEtapeStep
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $routeName = $request->route()->getName(); // e.g. 'Etape3'
        if (preg_match('/^Etape(\d)$/', $routeName, $matches)) {
            $stepRequested = (int)$matches[1];
            $userStep = Auth::user()->step ?? 1;
            if ($stepRequested > $userStep) {
                abort(403, "Vous n'êtes pas autorisé à accéder à cette étape.");
            }
        }
        return $next($request);
    }
}
