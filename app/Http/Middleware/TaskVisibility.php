<?php

namespace App\Http\Middleware;

use App\Litigation;
use App\Organization;
use Closure;
use Illuminate\Auth\Guard;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing;

class TaskVisibility
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
        if($user->hasRole(['owner', 'admin']))
        {

            return $next($request);
        }

        else {

            //grant accessibility if the user organization is authorized for the case and
            //the user country is eligible for the intended task
            $current_user_organization_id = Organization::getLoggedOrganization();
            $lid = $request->segment(2);
            $task_id = $request->input('tid')? $request->input('tid'):9;
            #dd($task_id);

            $authorized_organizations = Organization::authorized_orgs($lid);

            foreach($authorized_organizations as $authorized_organization){
               if($authorized_organization->organization_id==$current_user_organization_id){
                   $assigneds = DB::table('litigation_task_task_status')
                       ->where('litigation_id', $lid)
                       ->where('task_id', $task_id)
                       ->select('assigned_country')
                       ->get();

                  // dd($assigneds);
                   foreach($assigneds as $assigned) {
                       //dd($authorized_organization);
                       $organization = Organization::findOrFail($authorized_organization->organization_id);
                       if($assigned->assigned_country==$organization->country){
                           return $next($request);
                       }
                   }
               }
           }

            $coupled_country = Litigation::getCoupledCountry($user,$lid);
            //dd($coupled_country);
            //check if hte countrys assigned organizations have any user
            $users_under_coupled_country = User::getUsersInCoupledCountry($lid,$coupled_country);
            // dd($users_under_coupled_country);
            if(!$users_under_coupled_country){
                foreach($authorized_organizations as $authorized_organization){
                    if($authorized_organization->organization_id==$current_user_organization_id){
                        return $next($request);
                    }
                }
            }

            return back();

        }

    }



    public static function getCurrentTaskId($request){
        //dd($request->route()->getAction()['as']);
        switch($request->route()->getAction()['as']){
            case 'store.to.shelter':
                $tid = 3;
                break;
            case 'post.accessibility':
                $tid = 1;
                break;
            case 'get.care.plans':
                $tid = 3;
                break;
            case 'attach.care.plans':
                $tid = 3;
                break;
            case 'post.care.plans':
                $tid = 3;
                break;
            case 'cases.show':
                $tid = 9;
                break;
            case 'save.case.task':
                $tid = 3;
                break;
            case 'case.dashboard':
                $tid = 2;
                break;
            case 'move.to.shelter':
                $tid = 3;
                break;
            case 'move.to.shelter':
                $tid = 3;
                break;
            case 'move.to.shelter':
                $tid = 3;
                break;
            case 'move.to.shelter':
                $tid = 3;
                break;
            case 'move.to.shelter':
                $tid = 3;
                break;
            case 'move.to.shelter':
                $tid = 3;
                break;
            case 'move.to.shelter':
                $tid = 3;
                break;
            case 'move.to.shelter':
                $tid = 3;
                break;
            case 'move.to.shelter':
                $tid = 3;
                break;
            case 'move.to.shelter':
                $tid = 3;
                break;
            case 'move.to.shelter':
                $tid = 3;
                break;
            case 'move.to.shelter':
                $tid = 3;
                break;
            case 'move.to.shelter':
                $tid = 3;
                break;
            case 'move.to.shelter':
                $tid = 3;
                break;
            case 'cases.show':
                $tid = 2;
                break;
            default:
                $tid = 9;
        }


        return $tid;


    }

}
