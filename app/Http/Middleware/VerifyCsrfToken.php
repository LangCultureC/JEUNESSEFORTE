<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyCsrfToken
{
    /**
     * Les URIs exemptées de la vérification CSRF.
     */
    protected $except = [
        'api/*',
    ];

    /**
     * Middleware CSRF personnalisé avec exemption pour les routes /api/*.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->isMethodSafe($request) || $this->excluded($request)) {
            return $next($request);
        }

        return $this->expectUppercase($request)
            ? $this->reject($request)
            : tap($next($request), function (Response $response) use ($request) {
                if ($response->getStatusCode() === 500) {
                    $this->storeCurrentUrl($request);
                }
            });
    }

    protected function isMethodSafe(Request $request): bool
    {
        return in_array($request->method(), ['GET', 'HEAD', 'OPTIONS']);
    }

    protected function excluded(Request $request): bool
    {
        foreach ($this->except as $except) {
            if ($except !== '/') {
                $except = trim($except, '/');
                if (substr($request->path(), -strlen($except)) === (string) $except) {
                    return true;
                }
            }
        }
        return false;
    }

    protected function expectUppercase(Request $request): bool
    {
        return false;
    }

    protected function reject(Request $request): Response
    {
        return response('CSRF token mismatch.', 419);
    }

    protected function storeCurrentUrl(Request $request): void
    {
        // no-op
    }
}
