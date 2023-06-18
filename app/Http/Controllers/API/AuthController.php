<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    public function login(Request $request)
    {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $result['token'] = $user->createToken('MdpApp')->plainTextToken;
            $result['name'] = $user->name;

            return $this->sendResponse($result, 'User Login Successfully.');
        } else {
            return $this->sendError('Login Failed');
        }
    }
} 

// class RegisterController extends BaseController
// {
//     public function register(Request $request)
//     {
//         $validator = Validator::make($request->all(), [
//             'name' => 'required',
//             'email' => 'required|email',
//             'password' => 'required',
//             'c_password' => 'required|same:password',
//             'role' => 'required',
//         ]);

//         if ($validator->fails()) {
//             return $this->sendError('Validation Error.', $validator->erors());
//         }

//         $input = $request->all();
//         $input['password'] = bcrypt($input['password']);
//         $user = User::create($input);
//         $success['token'] = $user->createToken('MyApp')->plainTextToken;
//         $success['name'] = $user->name;

//         return $this->sendResponse($success, 'User Register Successfully.');
//     }

//     public function login(Request $request)
//     {
//         if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
//             $user = Auth::user();
//             $success['token'] = $user->createToken('MyApp')->plainTextToken;
//             $success['name'] = $user->name;

//             return $this->sendResponse($success, 'User Login Successfully.');
//         } else {
//             return $this->sendError($Unauthorised, ['error' => 'Unauthorised']);
//         }
//     }
// }