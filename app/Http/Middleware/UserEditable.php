<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserEditable
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
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

        $uid = $request->segment(2);
        if($uid){
            $editable = User::findOrFail($uid);
        }

        else {
            $editable = new User();
            $editable->id = 0;
        }
        //grant full access if the user is owner or admin
        if($user->hasRole(['owner']))
        {
            return $next($request);
        }

        else if($user->hasRole(['admin'])) {
            if($editable->hasRole(['owner'])){
                return new RedirectResponse(url('/unauthorized'));
            }
            return $next($request);
        }

        else if($user->hasRole(['contributor'])) {
            //dd($uid);
            if($editable->id==$user->id){
                return $next($request);
            }
            else {
                return new RedirectResponse(url('/unauthorized'));
            }
        }
    }
}
