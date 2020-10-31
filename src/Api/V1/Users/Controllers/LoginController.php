<?php


namespace Api\V1\Users\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Api\V1\Users\Requests\LoginRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Support\ApiResponseFactory\ResponseFactoryInterface;

class LoginController extends Controller
{
    use AuthenticatesUsers;


    private ResponseFactoryInterface $responseFactory;


    public function __construct(ResponseFactoryInterface $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    public function login(LoginRequest $request)
    {
        $attempt = Auth::attempt([
            'email' => $request->input("email"),
            'password' => $request->input("password")
        ]);

        if (!$attempt) {
            return $this->responseFactory->setStatusCode(401)
                ->setMessage(__("Email veya şifre yanlış."))
                ->get();
        }

        $user = Auth::user();

        $successData = [
            "token" => $user->createToken("Blog")->accessToken,
            "user_id" => $user->id,
            "email" => $user->email,
            "name" => $user->name
        ];

        return $this->responseFactory->setStatusCode(200)
            ->setMessage(__("Giriş işlemi başarılı"))
            ->setData($successData)
            ->get();
    }


    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return $this->responseFactory->setStatusCode(200)
            ->setMessage(__("Çıkış işlemi başarılı"))
            ->get();
    }

}
