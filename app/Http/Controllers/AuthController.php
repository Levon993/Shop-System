<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
//use App\Http\Requests\UserCreateRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Logs\LogsRepository;

class AuthController extends Controller
{


    public function login(Request $request){


        try {


            $loginData = $request->validate([
                'email' => 'email|required',
                'password' => 'required'
            ]);
            if (!auth()->attempt($loginData)) {
                return response()->json(['message' => 'invalid Credential']);
            }
            $accessToken = auth()->user()->createToken('authToken')->accessToken;
            $role = auth()->user()->roles;
            return response()->json(['user' => auth()->user(), 'access_token' => $accessToken, 'role' => $role]);

        }catch (\Throwable $exception){
            $log = new LogsRepository();
            $log->create($exception);


            return response()->json(['success'=>false]);
        }

    }

    public function register(Request  $request){
//        return response()->json($request->all());
//        try {


            $user = User::create(
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password)
                ]

            );


            $accessToken = $user->createToken('authToken')->accessToken;
            return response()->json(['user' => $user, 'accessToken' => $accessToken]);
//        }catch (\Throwable $exception){
//            $log = new LogsRepository();
//            $log->create($exception);
//
//
//            return response()->json(['success'=>false]);
//        }
    }


    public function logout(Request $request)
    {
        try {

            Auth::logout();
        }catch (\Throwable $exception){
            $log = new LogsRepository();
            $log->create($exception);


            return response()->json(['success'=>false]);
        }

    }
    public function registerImage(){
        try {

            $image  = Storage::get('/public/LayoutImages/sd.jpg');
            return response($image);
        }catch (\Throwable $exception){
            $log = new LogsRepository();
            $log->create($exception);


            return response()->json(['success'=>false]);
        }
    }
}
