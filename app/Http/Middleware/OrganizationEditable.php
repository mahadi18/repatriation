<?php

namespace App\Http\Middleware;

use App\Organization;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;
use App\User;
use Illuminate\Support\Facades\Auth;

class OrganizationEditable
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
        //dd("qqqq");
        $user = Auth::user();

        $oid = $request->segment(2);
        if ($oid) {
            $editable = Organization::findOrFail($oid);
        }

        //grant full access if the user is owner or admin
        if ($user->hasRole(['owner']) or $user->hasRole(['admin'])) {
            return $next($request);
        } else if ($user->hasRole(['contributor'])) {
            //dd($uid);
            if ($editable->id == $user->organization_id) {
                return $next($request);
            } else {
                if ($editable->parent_id == $user->organization_id) {
                    return $next($request);
                }
                return new RedirectResponse(url('/unauthorized'));
            }
        }
    }
}
