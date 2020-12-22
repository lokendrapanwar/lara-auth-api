<?php

namespace App\Http\Controllers;
use App\User;
use Auth;
use App\SocialIdentity;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Handles Registration Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'first_name' => 'required', 
            'email' => 'required|unique:users,email', 
            'password' => 'required|min:6'
        ]);

        if ($validator->fails($validator)) {
            return response()->json($validator->errors());
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $data = [];
        $data['token'] = $user->createToken('stryds')->accessToken;

        return response()->json(['data' => $data, 'success' => true], 200);
    }
 
    /**
     * Handles Login Request and SocialIdentity
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {

        /**
        * Handles Login Request from SocialIdentity
        */
        if($request->has('provider_name')){

            $validator = Validator::make($request->all(), [
                'provider_name' => 'required', 
                'auth_token' => 'required'
            ]);

            if ($validator->fails($validator)) {
                return response()->json($validator->errors());
            }

            $res = SocialIdentity::where(['provider_name'=>$request->provider_name, "auth_token"=>$request->auth_token ])->first();
        
            if ($res) {
                $user = User::where('id','=',$res->user_id)->first();
                $data = [];
                Auth::login($user);
                $data['token'] = auth()->user()->createToken('stryds')->accessToken;
    
                return response()->json(['data' => $data, 'success' => true], 200);
            } else {
                return response()->json(['error' => 'UnAuthorised'], 401);
            }
        }

        $validator = Validator::make($request->all(), [
            'email' => 'required|email', 
            'password' => 'required'
        ]);

        if ($validator->fails($validator)) {
            return response()->json($validator->errors());
        }

        /**
        * Handles Login Request from app
        */
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
 
        if (auth()->attempt($credentials)) {
            $data = [];
            $data['token'] = auth()->user()->createToken('stryds')->accessToken;

            return response()->json(['data' => $data, 'success' => true], 200);
        } else {
            return response()->json(['error' => 'UnAuthorised'], 401);
        }
    }
 
    /** 
     * Returns Authenticated User Details
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function details()
    {
        $data = [];
        $data['user_details'] = auth()->user();
        return response()->json(['data' => $data, 'success' => true], 200);
    }

    /**
     * Returns all Users Details
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllUsers()
    {
        $data = [];
        $data['users'] = User::with('social_connectivity')->get();
        return response()->json(['data' => $data, 'success' => true], 200);
    }
}
