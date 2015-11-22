<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;


use Illuminate\Http\Request;
use Input;
use Validator;

class AuthController extends Controller {

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * The registrar implementation.
     *
     * @var Registrar
     */
    protected $registrar;

    /**
     * Redirection paths after successful and unsuccessful login attempts
     */
    protected $redirectPath ='/';
    protected $loginPath = '/login';

    protected $failureMessage = ['loggedin' => false];
    protected $successMessage = ['loggedin' => true];

    /**
     * Handle a registration request for the application.
     *
     * @param \Illuminate\Foundation\Http\FormRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        $validator = $this->registrar->validator($request->all());

        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $this->auth->login($this->registrar->create($request->all()));

        return redirect($this->redirectPath);
    }

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return view('pages.front-login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $response = $this->postCheckCredentials($request);

        if($response['loggedin'] == false)
        {
            return  redirect($this->loginPath)
                    ->withInput($request->except('password'))
                    ->withErrors(['email' => 'Invalid credentials' ]);
        }
        else
        {
            return redirect()->intended($this->redirectPath);
        }
    }

    /**
     * @param Request $request
     * @return array
     */
    public function postCheckCredentials(Request $request)
    {
        $validatorRules = array(
            'email'    => 'required|email',
            'password' => 'required'
        );

        $validator = Validator::make($request->all(), $validatorRules);


        if ($validator->fails())
        {
            return $this->failureMessage;
        }

        $credentials = $request->only('email', 'password');

        if ($this->auth->attempt($credentials, $request->has('remember')))
        {
            return array_merge($this->successMessage, $this->auth->user()->toArray());
        }
        else
        {
            return $this->failureMessage;
        }
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
        $this->auth->logout();
        return redirect($this->redirectPath);
    }

    /**
     * Create a new authentication controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\Guard $auth
     * @param  \Illuminate\Contracts\Auth\Registrar $registrar
     */
    public function __construct(Guard $auth, Registrar $registrar)
    {
        $this->auth = $auth;
        $this->registrar = $registrar;
        $this->middleware('guest', ['except' => ['getLogout', 'postCheckCredentials']]);
    }

}
