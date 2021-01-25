<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Str;

class LoginController extends Controller
{

    public function login(Request $request){

    	$validator = Validator::make($request->all(), [
    		'name' => 'required',
    		'password' => 'required',
    	]);

    	if($validator->fails()){
    		return response()->json(['message' => 'Incomplete data'], 422);
    	}

    	$user = User::where('name', $request->name)->first();
    	if(! $user || ! Hash::check($request->password, $user->password)){    		
    		return response()->json(['message' => 'The given data was invalid.', 
	    			'errors' => 
	    				[
	    					'message' => 'The provided credentials are incorrect.'
	    				]
	    			]
	    			,401);
    	}
    	$user->token = strtoupper(md5(uniqid(rand(),true)));
    	$user->save();
    	return response()->json([
    		'message' => 'Usuario logeado con exito'
    	], 200);
    }

    public function recovery(Request $request){

    	$validator = Validator::make($request->all(), [
    		'email' => 'required|email'
    	]);

    	if($validator->fails()){
    		return response()->json($validator, 422);
    	}
    	$user = User::where('email', $request->email)->first();
    	if(! $user){
    		return response()->json(['message' => 'The given data was invalid.', 
	    			'errors' => 
	    				[
	    					'message' => 'The provided credentials are incorrect.'
	    				]
	    			]
	    			,401);
    	}
    	$pass = Str::random(12);
    	$password = bcrypt($pass);
    	$user->password = $password;
    	$user->save();
    	return response()->json([
    		'password' => $pass,
    	], 200);
    }
}
