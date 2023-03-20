<?php

namespace App\Http\Controllers\Api;

use App\Events\LoginMailEvent;
use App\Http\Controllers\Controller;
use App\Mail\LoginMail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class AuthController extends Controller
{
    //
    public function register(Request $request ){

        $validated = $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'c_password'=>'required|same:password',
            'phone_no'=>'required'
        ]);

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $success['name'] = $user->name;

        return response(['status'=>'true','data'=>$success,'message'=>'User registration Success']);

    }

    public function login(Request $request){

        // info($request->password);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            info($user);
            
            $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $success['name'] = $user->name;


            LoginMailEvent::dispatch($user);
            // Mail::to($user->email)->send(new LoginMail($user));
            return response(['status'=>true,'data'=>$success ,'message'=>'User Login successfully','SMS'=>'Sms send to the mobile'],200);

            }else
            {
            return response(['status'=>false ,'message'=>'Unauthorised user']);
            }
            
    }

}
