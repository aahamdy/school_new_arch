<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Services\UserService;
use Validator;
use Models\User;


class AuthenticateController extends Controller {

    private $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function index() {
        // TODO: show users
    }

    public function register(Request $request){

        $data         = $request->all();
        $validator    = Validator::make($data, User::$rules['save']);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->toArray()], 400);
        }
        $created   = $this->userService->create($data);
        if ($created) {
            return response(["created" => true], 200);
        }
    }

    /**
     * Login
     * @param Request $request
     * @return Token
     */
    public function authenticate(Request $request) {
        $credentials = $request->only('email', 'password');
        try {
            // verify the credentials and create a token for the user
            $user = $this->userService->login($credentials['email'], $credentials['password']);

            if (!$user) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        $customClaims = ['user_id' => $user->id];
        $token = JWTAuth::fromUser($user, $customClaims);
        // if no errors are encountered we can return a JWT
        return response()->json(compact('token'));
    }

    /**
     * Get Current Authenticated User
     *
     * @return User
     */
    public function getAuthenticatedUser() {

        try {
            $payload = JWTAuth::parseToken()->getPayload();
            if (!$payload->get('user_id')) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());
        }


        $user = $this->userService->getById($payload->get('user_id'));
        // the token is valid and we have found the user via the sub claim
        return response()->json(compact('user'));
    }

    /**
     * Log Out
     */
    public function invalidate() {
        JWTAuth::invalidate(JWTAuth::getToken());
    }

}
