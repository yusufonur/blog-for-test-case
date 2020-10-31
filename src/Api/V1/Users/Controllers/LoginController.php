<?php


namespace Api\V1\Users\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
//        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            "email" => ["required", "email"],
            "password" => ["required"]
        ]);
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            $success['user_id'] = $user->id;
            $success['email'] = $user->email;
            $success['name'] = $user->name;
            return response()->json($success, 200);
        } else {
            return response()->json('Email veya şifre yanlış.', 401);
        }
    }


    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        $cookie = Cookie::forget('_token');
        return response()->json([
            'message' => 'successful-logout'
        ])->withCookie($cookie);
    }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        if ($user->save()) {
            return response()->json('Kullanıcı başarıyla eklendi.', 200);
        } else {
            return response()->json('Kullanıcı kaydı sırasında bir sorun oluştu.', 400);
        }
    }

    public function deneme()
    {
        return 'deneme';
    }
}
