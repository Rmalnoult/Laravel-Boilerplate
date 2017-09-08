<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
	public function index()
	{
		if (!Auth::user()->hasRole('admin')) {
			abort(404);
		}
		$users = User::paginate(50);
		return view('users.index')->with('users', $users);
	}

	public function update($id)
	{
		$user = User::findOrFail($id);
		$roles = Role::orderBy('name', 'desc')->pluck('name', 'id');

		return view('users.update')
			->with('user', $user)
			->with('roles', $roles);
	}

	public function modify(Request $request, $id)
	{
	    $this->validate($request, [
	        'email' => 'required|unique:users,email,'.$id,
	    ]);

	    $user = User::findOrFail($id);
	    $role = Role::findOrFail($request->role);

	    $user->name = $request->name ? $request->name : $user->name;
	    $user->email = $request->email ? $request->email : $user->email;

	    if ($request->password) {
	    	$user->password = Hash::make($request->password);
	    }

	    if(!$user->hasRole($role->name)) {
	    	$user->roles()->detach();
	    	$user->roles()->attach($request->role);
	    } 

	    $user->save();

	    $request->session()->flash('message', 'L\'utilisateur a bien été modifié');
	    return redirect('/users');
	}

	public function delete(Request $request, $id)
	{
	    $user = User::findOrFail($id);
	    $user->delete();
	    $request->session()->flash('message', 'L\'utilisateur a bien été supprimée');
	    return redirect('/users'); 
	}

	public function dashboard()
	{
		if (Auth::user()->hasRole('admin')) {
			return redirect('/users');
		} else {
			return view('dashboard');
		}
	}
}
