<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;
use App\User;
use Illuminate\Support\Facades\Auth;

class DashboardVisibility
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */

    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        $uId = $request->segment(2);
        if ($uId) {
            $visible = User::findOrFail($uId);
        } else {
            $visible = new User();
            $visible->id = 0;
        }

        //grant full access if the user is owner or admin
        if ($user->hasRole(['owner'])) {
            return $next($request);
        } else if ($user->hasRole(['admin'])) {
            if ($visible->hasRole(['owner'])) {
                return new RedirectResponse(url('/unauthorized'));
            }
            return $next($request);
        }
        else if($user->hasRole(['contributor'])) {
            //dd($uid);
            if($visible->id==$user->id){
                return $next($request);
            }
            else {
                return new RedirectResponse(url('/unauthorized'));
            }
        }
    }
}
