<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class Auth extends Controller
{
    
    private $roles_id = 2;

    public function register(Request $request){
        try {
            $request->validate([
                'name'      => 'required',
                'surname'   => 'required',
                'password'  => 'required',
                'email'     => 'required' 
            ]);
    
            $user = User::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'surname'   => $request->surname,
                'password'  => Hash::make($request->password), 
                'roles_id'  => $this->roles_id,
            ]);
    
            $user->save();
    
            return redirect('/login');
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email'     => 'required',
            'password'  => 'required',
        ]);

        if(FacadesAuth::attempt($credentials)){
            $request->session()->regenerate();

            return redirect('/products');
        }
    }

    public function logout(Request $request){
        FacadesAuth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('login');
    }

    public function forgot_password(Request $request){
        $request->validate(['email' => 'required|email']);
 
        $status = Password::sendResetLink(
            $request->only('email')
        );
    
        return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
    }

    public function reset_password(Request $request){
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
     
        $status = Password::reset(
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
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
    }

}
