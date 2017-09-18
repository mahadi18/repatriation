<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Notification
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
        $user_org = $user = Auth::user()->organization()->get()[0]->id;
       // dd($user_org);
        $notification = $request->segment(2);
        $eligible_orgs = DB::select('select organization_id from message_organization where message_id = ?',[$notification]);
       // dd($user_org);

        foreach($eligible_orgs as $eligible_org){
            if($eligible_org->organization_id==$user_org){
               // dd('ssssssssss');
                return $next($request);
            }

        }
        return new RedirectResponse(url('/notifications/all'));
    }
}
