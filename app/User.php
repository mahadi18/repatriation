<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Support\Facades\DB;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{

    use Authenticatable, CanResetPassword, EntrustUserTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];


    public function organization()
    {
        return $this->belongsTo('App\Organization');
    }

    public static function getUsersInCoupledCountry($lid, $coupled_country)
    {
        $users = DB::table('organizations')
            ->join('users', 'users.organization_id', '=', 'organizations.id')
            ->join('litigation_organization', 'litigation_organization.organization_id', '=', 'organizations.id')
            ->where('organizations.country', $coupled_country)
            ->where('litigation_organization.litigation_id', $lid)
            ->select('users.*', 'litigation_organization.litigation_id')->get();

        return $users;
    }

    public function litigations()
    {
        return $this->hasMany('App\Litigation');
    }


    public function country($user_id){
        $users = DB::table('users')
            ->join('organizations', 'users.organization_id', '=', 'organizations.id')
            ->join('countries', 'organizations.country', '=', 'countries.id')
            ->where('users.id', $user_id)
            ->get();
        return $users[0]->id;
    }


    /**
     *count total users
     */
    public static function countUsers()
    {
        $totalUsers = DB::table('users')
            ->join('organizations', 'organizations.id', '=', 'users.organization_id')
            ->join('countries', 'countries.id', '=', 'organizations.country')
            ->select(DB::raw('COUNT(users.id) as totalUsers'))
            ->get();

        return $totalUsers[0]->totalUsers;
    }


    /**Count users based on country
     * @return mixed
     */
    public static function countOrganizationsByCountry()
    {
        $organizationsByCountry = DB::table('organizations')
            ->select(DB::raw('countries.id as country_id, countries.name as country, COUNT(organizations.id) as totalOrganizations'))
            ->join('countries', 'countries.id', '=', 'organizations.country')
            ->groupBy('organizations.country')
            ->get();

        return $organizationsByCountry;
    }


}
