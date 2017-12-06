<?php namespace App\Http\Controllers;

use App\Classes\Countries;
use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;

use App\User;
use App\Organization;
use App\Role;
use Illuminate\Http\Request;
use App\Classes\Usability;
use Hash;

class UserController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

    public function __construct()
    {
        $this->middleware('user.editable',['only' => ['edit','store']]);
    }

	public function index($organization_id=0)
	{
        //dd($organization_id);
        $items_per_page = Usability::$item_per_page;
        if($organization_id>0){
            $users = User::where('organization_id','=',$organization_id)->paginate($items_per_page);
        }
    else {
            $users = User::paginate($items_per_page);
        }
        return view('users.index', compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $organizations = Organization::where('id','>',1)->get();
        $roles = Role::all();
        return view('users.create', compact(array('organizations','roles')));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(UserRequest $request)
    {

        $user = new User();

        $this->validate($request, [

        	'name' => 'required',
        	'email' => 'required|email',
        	'password' => 'required|confirmed',
        	'organization_id' => 'required|confirmed',
        ]);

        $user->name = $request->input("name");
        $user->email = $request->input("email");
        $user->password = bcrypt($request->input("password"));
        $user->organization_id = $request->input("organization_id");

        $user->save();
        $user->attachRole($request->input("role"));


        //dd($request->input("organization"));
        //dd($user->id);
        //dd($request->input('organization'));
       // Organization::attachToOrganization($request->input("organization"),$user->id);

        return redirect()->route('users.index')->with('message', 'User created successfully.');


	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $user = User::findOrFail($id);


        $organizations = Organization::all();
        $roles = Role::all();
        $country = Countries::Country($user->organization->country);
        return view('users.edit', compact(array('user','organizations','country')));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
        $user = User::findOrFail($id);

        if (!Hash::check($request->input("old_password"), $user->password))
		{
		    return redirect()->route('users.edit')->with('message', 'Old password is not correct!');
		}
		
        
        $this->validate($request, [

        	'old_password' 	=> 'required',
        	'password' 	=> 'confirmed',
        	'email' 	=> 'email',
        ]);


        $user->name = $request->input("name") ? $request->input("name") : $user->name;
        $user->email = $request->input("email") ? $request->input("email") : $user->email;
        $user->status = $request->input("status") ? $request->input("status") : $user->status;
        //dd($user->status);
        $user->password = bcrypt($request->input("password"));
        $user->save();
       // dd($user);
        return redirect()->route('users.index')->with('message', 'User updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('message', 'Item deleted successfully.');
	}

}
