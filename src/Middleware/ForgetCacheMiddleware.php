<?php

namespace Mrlaozhou\Extend\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Mrlaozhou\Extend\Exception\ExtendException;

class ForgetCacheMiddleware
{

    /**
     * @param          $request
     * @param \Closure $next
     * @param null     $cacheKey
     * @param null     $expectAction
     *
     * @return mixed
     * @throws \Mrlaozhou\Extend\Exception\ExtendException
     */
    public function handle($request, Closure $next, $cacheKey=null, $expectAction = null)
    {
        if( ! $cacheKey ) {
            throw new ExtendException( 'Middleware [Mrlaozhou\Extend\Middleware\ForgetCacheMiddleware] must need a key.' );
        }
        //  排除
        if( $expectAction && Str::endsWith( Route::current()->getName(), $expectAction ) ) {
            return $next($request);
        }
        Cache::forget( $cacheKey );
        return $next($request);
    }
}
