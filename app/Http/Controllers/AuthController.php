<?php

namespace App\Http\Controllers;

// use auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
//    use SendsPasswordResetEmails, ResetsPasswords;
    /**
     * Handle the login request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'fcm_token' => 'string',
        ]);

        $credentials = $request->only('email', 'password');
        
       
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('appToken')->plainTextToken;

            $newDeviceToken = $request->input('fcm_token');
            if ($user->fcm_token !== $newDeviceToken) {
                $user->fcm_token = $newDeviceToken;
                $user->save();
            }


            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
                // 'data' => [
                //     'user' => new UserResource($user), // Return the user resource here
                // ],
            ]);
        }

        return response()->json(['message' => 'The provided credentials do not match our records.'], 401);
    }


    public function register(Request $request)
    {
        $data=$request->validate([
            'name'=>['required','string'],
            'email'=>['required','email','unique:users'],
            'password'=>['required','min:6'],
        ]);
        $user=User::create($data);
        $token = $user->createToken('appToken')->plainTextToken;

        return [
            'user'=>$user,
            'token'=>$token

        ];
    }
    /**
     * Handle the logout request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logout successful']);
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }


    // public function change_password(Request $request)
    // {
    //     $request->validate([
    //         'password'=>'required,'
    //     ]);
    //     $loggeduser=auth()->user();
        
    //     return true;
    // }
}
