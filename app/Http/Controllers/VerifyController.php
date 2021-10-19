<?php

namespace App\Http\Controllers;

use Nexmo\Laravel\Facade\Nexmo;
use Vonage\Client\Exception\Request as VonageRequest;

class VerifyController extends Controller
{
    public function show() {
        return view('nexmo.verify');
    }

        /**
     *
     * Reenvia un nuevo código al usuario para que pueda acceder
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resend () {
        try {
            /**
             * @TODO controlar que no hayan pasado menos de 30 segundos
             */

            /**
             * No se puede cancelar si no han pasado 30 segundos desde la solicitud anterior
             */
            Nexmo::verify()->cancel(session('verify:request_id'));
            $verification = Nexmo::verify()->start([
                'number' => session('verify:user:phone_number'),
                'brand'  => env("APP_NAME")
            ]);
            session()->put('verify:request_id', $verification->getRequestId());
            return back()->with('message', ['success', __("Te hemos enviado un nuevo código a tu teléfono")]);
        } catch (VonageRequest $e) {
            /**
             * https://help.nexmo.com/hc/en-us/articles/204014733-Nexmo-SMS-Delivery-Error-Codes
             */
            return back()->with('message', ['danger', __($e->getMessage())]);
        }
    }

    /**
     *
     * Verifica si el código es correcto, si es así, inicia sesión
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function verify()
    {

        $this->validate(request(), [
            'code' => 'size:4',
        ]);

        try {
            Nexmo::verify()->check(
                session('verify:request_id'),
                request('code')
            );

            auth()->loginUsingId(session()->pull('verify:user:id'));
            session()->remove('verify:request_id');
            return redirect('/home')->withO("message", ["success", __("Bienvenidos, has accedido correctamente")]);

        } catch (VonageRequest $e) {
            /**
             * Validar códigos
             * https://help.nexmo.com/hc/en-us/articles/360025561931-Verify-Response-Codes
             */
            return back()->withErrors([
                'code' => $e->getMessage()
            ]);
        }
    }
}
