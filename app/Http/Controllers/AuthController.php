<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;

use App\AppModel\ServiceSuccessResponse;
use App\Services\ExternalLoginService;

class AuthController extends Controller
{
    private $external_login_handler;

    public function __construct(ExternalLoginService $external_login_handler)
    {
        $this->external_login_handler = $external_login_handler;
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $login = $request->input('login');
        $password = $request->input('password');
        
        $result = $this->external_login_handler->verifyCredentials($login, $password);

        if ($result instanceof ServiceSuccessResponse)
        {
            $jwt = JWT::encode([
                'login' => $login,
                'system' => $result->getData(),
            ], env('JWT_SECRET'));

            return response()->json([
                'status' => 'success',
                'token' => $jwt
            ]);
        }

        else {

            return response()->json([
                'status' => 'failure'
            ]);

        }
    }
}
