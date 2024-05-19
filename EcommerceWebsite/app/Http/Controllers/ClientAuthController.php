<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use App\Notifications\ClientResetPassword;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\Concerns\Has;
use Laravel\Socialite\Facades\Socialite;

class ClientAuthController extends Controller
{
    public function connexion()
    {
        if (Auth::guard('client')->check()) {
            return redirect('/');
        } else {
            return view('user.login');
        }
    }

    public function connexioncheck(Request $req)
    {
        $credentials = $req->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('client')->attempt($credentials)) {
            $req->session()->regenerate();

            return redirect()->intended('/dashboard');
        } else {
            return back()->withErrors([
                'email' => 'Votre email ou mot de passe est inccorect.',
            ]);
        }

    }
    public function SocialLoginRedirect($type){
        if($type=='facebook'){
            return Socialite::driver('facebook')->redirect();

        }else if($type=='google'){
            return Socialite::driver('google')->redirect();
        }
    }
    public function SocialLoginRedirectBack(Request $request,$type){
        $user = Socialite::driver($type)->stateless()->user();
        $isexist=Client::where('email',$user->email)->first();
        if($isexist){
            Auth::guard('client')->loginUsingId($isexist->id);
        }
        else{
            Client::create([
                'user_name' => $user->name,
                'email' => $user->email,
                'telephone' => '',
                'password' => Hash::make('')
            ]);
        }

        return redirect('/dashboard');
    }
    public function inscrire()
    {
        if (Auth::guard('client')->check()) {
            return redirect('/');
        } else {
            return view('user.logup');
        }
    }

    public function inscrirecheck(Request $req)
    {
        $validated = $req->validate([
            'name' => 'required|min:3|max:100',
            'lastname' => 'required|min:3|max:100',
            'email' => 'required|min:3|max:100',
            'telephone' => 'required|min:3|max:100',
            'password' => 'required|min:8|max:100',
            'password2' => 'required|min:8|max:100|same:password',
        ]);

        Client::create([
            'user_name' => $req->name . ' ' . $req->last_name,
            'email' => $req->email,
            'telephone' => $req->telephone,
            'password' => Hash::make($req->password)
        ]);
        $req->session()->regenerate();
        return redirect()->intended('/');


    }
    protected function guard()
    {
        return Auth::guard('clients');
    }
    public function forgetpassword()
    {
        return view('user.forgetpassword');
    }

    public function forgetpasswordcheck(Request $req)
    {
//        return $this->notify(new ClientResetPassword());
        $req->validate(['email' => 'required|email']);
        $status = Password::broker('clients')->sendResetLink(
            $req->only('email')
        );
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function changepassword($token)
    {
         $token=substr($token,6);
        return view('user.changepassword', ['token' => $token]);
    }

    public function changepasswpordcheck(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::broker('clients')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));

            }
        );
        return $status === Password::PASSWORD_RESET
            ? redirect('/connexion')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function logout()
    {
        Auth::guard('client')->logout();
        return redirect('/');
    }

    public function information()
    {
        $user = Client::where('id', Auth::guard('client')->id())->first();
        return view('client.informations', compact('user'));
    }

    public function informationcheck(Request $req)
    {
        if ($req->modifypassword) {
            $validated = $req->validate([
                'name' => 'required|min:3|max:100',
                'email' => 'required|min:3|max:100',
                'telephone' => 'required|min:3|max:100',
                'newpassword1' => 'required|min:8|max:100',
                'newpassword2' => 'required|min:8|max:100|same:newpassword1',
            ]);
        } else {
            $validated = $req->validate([
                'name' => 'required|min:3|max:100',
                'email' => 'required|min:3|max:100',
                'telephone' => 'required|min:3|max:100',
            ]);
        }
        $user = Client::where('id', Auth::guard('client')->id())->update([
            'user_name' => $req->name,
            'email' => $req->email,
            'telephone' => $req->telephone
        ]);
        if ($req->modifypassword) {
            if (!Hash::check($req->password, $req->user()->password)) {
                return back()->withErrors([
                    'password' => ['actuel mot de passe est inccorect.']
                ]);
            } else {
                $user = Client::where('id', Auth::guard('client')->id())->update([
                    'password' => Hash::make($req->newpassword1)
                ]);
            }
        }
        return redirect('/information');
    }

    public function adresses()
    {
        $user = Client::where('id', Auth::guard('client')->id())->first();
        return view('client.adresses', compact('user'));
    }

    public function adressecheck(Request $req)
    {
        $validator = $req->validate([
            'adresse' => 'required',
            'city' => 'required'
        ]);
        $user = Client::where('id', Auth::guard('client')->id())->update([
            'adresse' => $req->adresse,
            'city' => $req->city,
        ]);
        return redirect('/adresses');
    }

}
