<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForceHttps
{
    public function handle(Request $request, Closure $next): Response
    {
        $forceHttps = filter_var((string) config('app.force_https', false), FILTER_VALIDATE_BOOL);

        if ($forceHttps && ! $request->isSecure()) {
            $httpsUrl = 'https://'.$request->getHttpHost().$request->getRequestUri();

            return redirect()->to($httpsUrl, 301);
        }

        return $next($request);
    }
}
