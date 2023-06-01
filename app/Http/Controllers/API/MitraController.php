<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
// use Auth;
use App\Models\Mitra;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MitraController extends Controller
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
                'degree' => 'required',
                'license_number' => 'required',
            ]);
            $mitra = new Mitra;
            $mitra->first_name = $request->first_name;
            $mitra->last_name = $request->last_name;
            $mitra->email = $request->email;
            $mitra->password = bcrypt($request->password);
            $mitra->phone_number = $request->phone_number;
            $mitra->address = $request->address;
            $mitra->country = $request->country;
            $mitra->city = $request->city;
            $mitra->postal_code = $request->postal_code;
            $mitra->birthdate = $request->birthdate;
            $mitra->gender = $request->gender;
            $mitra->degree = $request->degree;
            $mitra->license_number = $request->license_number;
            $mitra->save();

            return response()->json(['message' => 'Mitra registered successfully']);
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
            if (Auth::guard('mitra')->attempt($credentials)) {
                $user = Auth::guard('mitra')->user();
                $token = $user->createToken($input['email'], ['mitra'])->plainTextToken;
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
            Auth::guard('mitra')->logout();
            auth()->user()->tokens()->delete();
            return response()->json(['message' => 'Mitra logout successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th]);
        }
    }

    public function getProfile($mitraid)
    {
        try {
            $profile = Mitra::find($mitraid);
            return response()->json($profile);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th]);
        }
    }
}