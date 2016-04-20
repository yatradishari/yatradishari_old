<?php namespace App\Http\Controllers\Auth;

/*use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;*/

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\User;
use App\Profile;
Use App\Models\Menu ;
//use Event; 
//use App\Events\Activity ; 
use Validator ; 
Use Debugbar;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getLogout']);
	}
	
	
	public function postLogin(Request $request)
	{
		//dd("A");
		$this->validate($request, [
			'email' => 'required|email', 'password' => 'required',
		]);

		$credentials = $request->only('email', 'password');

		if ($this->auth->attempt(['email' => $request->get('email'), 'password' => $request->get('password'), 'status' => 1], $request->has('remember')))
		{
			if($this->auth->user()->type == '2')
			{
				return redirect()->intended( '/partner/dashboard' );
			}
			else
			{

					if($this->auth->user()->status == 1)
					{
						
						//$actionMsg = 'user#'.$this->auth->user()->name . ' login  at ' . date("Y-m-d H:i:s");
						//Event::fire( 'activity.log' , new Activity($request , [ 'project_id' => '' , 'user_id' => $this->auth->user()->id , 'action' => 'user-login' , 'msg'=> $actionMsg] ));
						return redirect()->intended($this->redirectPath());
					}
					
				
				//return redirect()->intended($this->redirectPath());
			}			
			
		}
	return redirect($this->loginPath())
					->withInput($request->only('email', 'remember'))
					->withErrors([
						'email' => $this->getFailedLoginMessage(),
					]);
	}	
	

}
