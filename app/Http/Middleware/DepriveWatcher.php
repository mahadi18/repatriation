<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing;

class DepriveWatcher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }


    public function handle($request, Closure $next)
    {

        $user = Auth::user();


        //grant full access if the user is owner or admin
        if($user->hasRole(['admin']))
        {
            return new RedirectResponse(url('/unauthorized'));
        }

        else {
            return $next($request);
        }
    }
}
