<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Facades\Auth;

class adminController extends Controller
{
    //
	public function showLogin()
	{	
		return view('admin_login');
	}

	public function doLogin(Request $request){
		$this->validate($request,[
				'email'		 => 'email',
				'password'   =>  'required'
			]);
		$userdata = array(
			'email'     => $request->email,
			'password'  => $request->password
		);

		// attempt to do the login
		if (Auth::attempt($userdata)) {

			return redirect('/users_list');
		} else {        

			// validation not successful, send back to form 
			return redirect('/admin');

		}
	}
	public function logout(Request $request) {
	  Auth::logout();
	  return redirect('/admin');
	}

}
