<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
class InstructorLoginController extends Controller
{
	public function __construct()
    {
        $this->middleware('guest:instructor')->except('logout');
    }
    /**
     * Show the application�s login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    protected function guard(){
        return Auth::guard('instructor');
    }
    public function login(Request $request){
		$this->validate($request,[
				'email'		 => 'email',
				'password'   =>  'required'
			]);
		$userdata = array(
			'email'     => $request->email,
			'password'  => $request->password
		);

		// attempt to do the login
		if (Auth::guard('instructor')->attempt($userdata)) {
			//echo "hi";
			return redirect()->intended(route('instructor.home'));	
		} 
		return back()->withInput($request->only('email'));
	}
    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/instructor';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
	
}
