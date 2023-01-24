<?php

namespace App\Http\Controllers\Api\Userfolder;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;


class UserApiController extends Controller
{


    public function register(Request $request)
    {
        $validateRequest =
            [
                'name' => 'required',
                'email' => 'required|unique:users',
            ];

        $messages = [
            'name.required' => 'Name is required',
            'email.required' =>  'Email is required ',
        ];

        $validator = Validator::make($request->all(), $validateRequest, $messages);

        if ($validator->fails()) {
            $errors = implode("\n", $validator->messages()->all());
            return $this->sendError($errors,   '',  200, 'login');
        }
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ];

        User::create($data);
        $user = User::latest()->first();
        Auth::loginUsingId($user->id);
        $token = $user->createToken('token')->plainTextToken;
        $userData['user'] = $user;
        return $this->sendResponse($userData, $token, 'user_is_registered');
    }

    public function sendResponse($result, $token, $message, $redirect = 'home')
    {
        $response = [
            'success' => true,
            'token' => $token,
            'token_type' => 'Bearer',
            'data'    => $result,
            'message' => $message,
            'redirect' => $redirect,
        ];

        return response()->json($response, 200);
    }

    public function sendError($message, $errorMessages = [], $code = 404, $redirect = 'register')
    {
        $response = [
            'success' => false,
            'message' => $message,
            'redirect' => $redirect
        ];


        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }

public function login(Request $request)
{
 

    $validateRequest =
    [
       'email' => 'required|email|',
       'password' => 'required',
    ];
   $messages = [
    'email.required' =>  'email_required',
    'email.required' =>  'email_this_email_is_not_valid',
    'password.required' =>  'password_required'
    ];
  

    $validator = Validator::make($request->all(),$validateRequest,$messages );

    if ($validator->fails()) {
        $errors_en = implode("\n",$validator->messages()->all());
        return $this->sendError($errors_en, '',  200,'login');
      }
 
    if(Auth::attempt(['email' =>$request->email, 'password' => $request->password,]))
    {
        
        return $this->sendResponse(
            auth('sanctum')->user(),
            User::find(auth('sanctum')->user()->id)->createToken('token')->plainTextToken,
            'User Logged in Successfully',
            'home');
     
    }
    else
    {
        return $this->sendError('Login failed', 'login failed ', '',  200,'login');
    }

}
}