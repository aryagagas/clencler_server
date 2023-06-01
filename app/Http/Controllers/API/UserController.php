<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Mitra;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function register(Request $request)
    {
        try {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'phone_number' => 'required',
                'address' => 'required',
                'country' => 'required',
                'city' => 'required',
                'postal_code' => 'required',
                'birthdate' => 'required',
                'gender' => 'required',
            ]);
            $user = new User;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->phone_number = $request->phone_number;
            $user->address = $request->address;
            $user->country = $request->country;
            $user->city = $request->city;
            $user->postal_code = $request->postal_code;
            $user->birthdate = $request->birthdate;
            $user->gender = $request->gender;
            $user->save();

            return response()->json(['message' => 'User registered successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th]);
        }

    }
    public function login(Request $request)
    {
        try {
            $input = $request->all();
            $validation = \Validator::make($input, [
                'email' => 'required|email',
                'password' => 'required',
            ]);
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
            if ($validation->fails()) {
                return response()->json(['error' => $validation->errors()]);
            }
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $token = $user->createToken($input['email'], ['userr'])->plainTextToken;
                return response()->json(['token' => $token]);
            } else {
                return response()->json(['error' => 'error blok']);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => $th]);
        }

    }
    public function logout(Request $request)
    {
        try {
            Auth::guard('userr')->logout();
            auth()->user()->tokens()->delete();
            return response()->json(['message' => 'Logout successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th]);
        }
    }
    public function getProfile($userid)
    {
        try {
            $profile = User::find($userid);
            return response()->json($profile);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th]);
        }
    }
    public function getAllMitras(Request $request)
    {
        try {
            $posts = Mitra::all();
            return response()->json(['body'=>$posts]);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th]);
        }
    }
    public function getMitra($mitraid)
    {
        try {
            $post = Mitra::findOrFail($mitraid);
            return response()->json(['body'=>$post]);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th]);
        }
    }
}