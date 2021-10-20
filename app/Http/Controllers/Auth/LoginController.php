<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Vonage\Client\Exception\Request as VonageRequest;
use Nexmo\Laravel\Facade\Nexmo;
use PhpParser\Node\Stmt\TryCatch;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        if (session()->has('verify:request_id')) {
            return redirect('verify');
        }
        return view('auth.login');
    }

        /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        try {
            // No dejamos que inicie sesión;
            Auth::logout();

            $request->session()->put('verify:user:id', $user->id);
            $request->session()->put('verify:user:phone_number', $user->phone_number);

            // $request = new \Vonage\Verify\Request(NUMBER, "Wehaa");
            // $response = $client->verify()->start($request);

            $verification = Nexmo::verify()->start([
                'number' => $user->phone_number,
                'brand' => env("APP_NAME")
            ]);

            $request->session()->put('verify:request_id', $verification->getRequestId());
            return redirect('verify')->with('message', ['success', __('Te hemos enviado un código de verificación a tú teléfono')]);

        } catch (VonageRequest $e) {
            /**
             * https://help.nexmo.com/hc/en-uis/articles/204014733-Nexmo-SMS_Delivery-Error_Codes
             */

            return back()->with("message", ["danger", __($e->getMessage())]);
        }
        //
    }
}
