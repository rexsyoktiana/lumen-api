<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class AuthController extends Controller
{

    private $users;
    public function __construct()
    {
        $this->users    = new User();
    }

    public function register(Request $request)
    {
        $name       = $request->name;
        $email      = $request->email;
        $password   = $request->password;
        $level      = $request->level;

        if (empty($name) or empty($email) or empty($password) or empty($level)) {
            return response()->json([
                'status'    =>  'error',
                'message'   =>  'You must fill all the fields'
            ]);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json([
                'status'    =>  'error',
                'message'   =>  'You must enter a valid email'
            ]);
        }

        if (strlen($password) < 6) {
            return response()->json([
                'status'    =>  'error',
                'message'   =>  'Password should be min 6 character'
            ]);
        }

        if (User::where('email', '=', $email)->exists()) {
            return response()->json([
                'status'    =>  'error',
                'message'   =>  'User already exists with this email'
            ]);
        }

        try {
            $user           =   new User();
            $user->name     =   $request->name;
            $user->email    =   $request->email;
            $user->password =   app('hash')->make($request->password);
            $user->level    =   $request->level;

            if ($user->save()) {
                return $this->login($request);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status'    =>  'error',
                'message'   =>  $e->getMessage()
            ]);
        }
    }

    public function login(Request $request)
    {
        $email      = $request->email;
        $password   = $request->password;

        if (empty($email) or empty($password)) {
            return response()->json([
                'status'    =>  'error',
                'message'   =>  'You must fill all the fields'
            ]);
        }

        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json([
                'status'    =>  'error',
                'message'   =>  'Unauthorized'
            ], 401);
        }

        $user = $this->users->get_where_email($email);
        $this->users->edit($user->id, [
            'last_login_at' =>  Carbon::now()->toDateTimeString(),
            'last_login_ip' =>  $request->getClientIp(),
        ]);

        $data = [
            'id_user'   =>  $user->id,
            'email'     =>  $user->email,
            'name'      =>  $user->name,
            'level'     =>  $user->level,
            'last_login_at' =>  date('Y-m-d H:i:s'),
            'last_login_ip' =>  $request->getClientIp(),
        ];
        return $this->respondWithToken($token, $data);
    }

    protected function respondWithToken($token, $data)
    {
        return response()->json([
            'data'          => $data,
            'access_token'  => $token,
            'token_type'    => 'bearer',
            'expires_in'    => auth()->factory()->getTTL() * 60 * 3
        ]);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json([
            'status'    =>  'success',
            'message'   =>  'Successfully logged out'
        ]);
    }
}
