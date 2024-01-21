<?php
namespace App\Http\Middleware;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;

class JWTMiddleware
{

    public function handle(Request $request, \Closure $next, $guard = null)
    {
        if (!$token = JWTAuth::getToken()) {
            return response()->json(['token' => 'token_not_provided'], 200); // 400
            // return \MetaResponse::error('token_not_provided');
            // return Resolver([
            //     'payload'       => 'token_not_provided',
            //     'status'        => 'token_not_provided',
            //     // 'credentials'   => [
            //     //     'role'      => role_slug(),
            //     //     // 'token'      => JWTToken(),
            //     //     'logged'    => logged(),
            //     // ]
            // ]);
        }

        try {

            $user = JWTAuth::authenticate($token);
            // $authuser = JWTAuth::toUser(JWTAuth::getToken());
            // $user = JWTAuth::parseToken()->authenticate();
            // $payload = JWTAuth::parseToken()->getPayload();

            if (!$user) {
                return response()->json(['token' => 'invalid_credentials'], 200); // 401
                // return \MetaResponse::error('invalid_credentials');
                // return Resolver([
                //     'payload'       => 'invalid_credentials',
                //     'status'        => 'invalid_credentials',
                //     // 'credentials'   => [
                //     //     'role'      => role(),
                //     //     // 'token'      => JWTToken(),
                //     //     'logged'    => logged(),
                //     // ]
                // ]);
            }

            // setter('user', $user);

            $response = $next($request);

            return $response;
        } catch (JWTException $e) {

            // something went wrong
            return response()->json(['token' => 'could_not_create_token'], 200); // 500
            // return \MetaResponse::error('could_not_create_token');
            // return Resolver([
            //     'payload'       => 'could_not_create_token',
            //     'status'        => 'could_not_create_token',
            //     // 'credentials'   => [
            //     //     'role'      => role(),
            //     //     // 'token'      => JWTToken(),
            //     //     'logged'    => logged(),
            //     // ]
            // ]);

        } catch (TokenExpiredException $e) {

            return response()->json(array('token' => 'token_expired'), 200); // $e->getStatusCode()
            // return \MetaResponse::error('token_expired');
            // return Resolver([
            //     'payload'       => 'token_expired',
            //     'status'        => 'token_expired',
            //     // 'credentials'   => [
            //     //     'role'      => role(),
            //     //     // 'token'      => JWTToken(),
            //     //     'logged'    => logged(),
            //     // ]
            // ]);

        } catch (TokenInvalidException $e) {

            return response()->json(array('token' => 'token_invalid'), 200); // $e->getStatusCode()
            // return \MetaResponse::error('token_invalid');
            // return Resolver([
            //     'payload'       => 'token_invalid',
            //     'status'        => 'token_invalid',
            //     // 'credentials'   => [
            //     //     'role'      => role(),
            //     //     // 'token'      => JWTToken(),
            //     //     'logged'    => logged(),
            //     // ]
            // ]);

        } catch (JWTException $e) {

            return response()->json(array('token' => 'token_absent'), 200); // $e->getStatusCode()
            // return \MetaResponse::error('token_absent');
            // return Resolver([
            //     'payload'       => 'token_absent',
            //     'status'        => 'token_absent',
            //     // 'credentials'   => [
            //     //     'role'      => role(),
            //     //     // 'token'      => JWTToken(),
            //     //     'logged'    => logged(),
            //     // ]
            // ]);
        }
    }

    public function terminate($request, $response)
    {
        return "protocol clear";
    }
}
