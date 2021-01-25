<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function store(Request $request){

    	$validator = Validator::make($request->all(), [
    		'name' => 'required',
    		'password' => 'required',
    		'email' => 'required|email'
    	]);

    	if($validator->fails()){
    		return response()->json(['message' => 'Incomplete data'], 422);
    	}
    	$user = User::where('name', $request->name)
    				->orWhere('email', $request->email)
    				->first();
    	if(! $user){
    		$user = User::create([
	            'name' => $request->name,
	            'password' => bcrypt($request->password),
	            'email' => $request->email,
	            'role' => 'particular',
	            'token' => strtoupper(md5(uniqid(rand(),true))),
        	]);
        	return response()->json([
        		'message' => 'Usuario creado con exito',
        		'token' => $user->token,
        	],201);

            // DE7FDF852A64B8E20B480F2C5A4BD239
    	}
    	return response()->json([
        		'message' => 'Credenciales ya se encuentran en el sistema'
        	],400);
    }
}
