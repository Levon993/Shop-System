<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
//use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Logs\LogsRepository;
use Illuminate\Http\JsonResponse;
class AuthController extends Controller
{


    public function login(LoginRequest $request):?JsonResponse
    {
//        try {
        $loginData = $request->all();
//        return response()->json($loginData);

            if (!auth()->attempt($loginData)) {
                return response()->json(['message' => 'invalid Credential']);
            }
            $accessToken = auth()->user()->createToken('authToken')->accessToken;
            $role = auth()->user()->role;
            list($rl) = $role;
             return response()->json(['user' => auth()->user()->name, 'access_token' => $accessToken, 'role' => $rl->{'name'}]);
          //  return response()->json(['user' => auth()->user()->name,  'role' => $rl->{'name'}]);

//        }catch (\Throwable $exception){
////            $log = new LogsRepository();
////            $log->create($exception);
//
//
//            return response()->json(['success'=>false]);
//        }

    }

    public function register(RegisterRequest  $request): ?JsonResponse
    {
        try {
            $user = User::create(
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password)
                ]

            );
            $accessToken = $user->createToken('authToken')->accessToken;

            return response()->json(['user' => $user, 'accessToken' => $accessToken]);
        }catch (\Throwable $exception){
//            $log = new LogsRepository();
//            $log->create($exception);
            return response()->json($exception->getMessage());
        }
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

    public function authUser(Request $request)
    {
        $role = auth()->user()->role;
        list($rl) = $role;
        $user = auth()->user()->name;


       return response()->json(['user' =>$user, 'role'=> $rl->{'name'} ]);
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
