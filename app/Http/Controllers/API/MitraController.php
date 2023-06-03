<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
// use Auth;
use App\Models\Mitra;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MitraController extends Controller
{
    public function register(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
            $mitra = new Mitra;
            $mitra->email = $request->email;
            $mitra->password = bcrypt($request->password);
            $mitra->save();

            return response()->json([
                'status' => '200',
                'message' => 'Mitra registered successfully',
                'body' => $mitra,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => '400',
                'message' => $th,
            ], 400);
        }

    }
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
            if (Mitra::where('email', $request->email)->first() && Hash::check($request->password, (Mitra::where('email', $request->email)->first())->getAuthPassword())) {
                $mitra = Mitra::where('email', $request->email)->first();
                $mitra->makeVisible('password');
                return response()->json([
                    'status' => '200',
                    'message' => 'Login successfully',
                    'body' => $mitra,
                ], 200);
            } else {
                return response()->json([
                    'status' => '400',
                    'message' => 'Invalid User Credential',
                    'body' => null,
                ], 400);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => '400',
                'message' => $th,
            ], 400);
        }


    }
    public function logout(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
            if (Mitra::where('email', $request->email)->first() && Hash::check($request->password, (Mitra::where('email', $request->email)->first())->getAuthPassword())) {
                return response()->json([
                    'status' => '200',
                    'message' => 'Logout successfully',
                    'body' => null,
                ], 200);
            } else {
                return response()->json([
                    'status' => '400',
                    'message' => 'Invalid User Credential',
                ], 400);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => '400',
                'message' => $th,
            ], 400);
        }
    }

    public function getProfile($mitra_id)
    {
        try {
            $profile = Mitra::find($mitra_id);
            return response()->json([
                'status' => '200',
                'message' => 'Get data successfully',
                'body' => $profile,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => '400',
                'message' => $th,
            ], 400);
        }
    }
    public function updateProfile(Request $request, $mitra_id)
    {
        try {
            $profile = Mitra::find($mitra_id)->makeVisible('password');
            if ($profile) {
                $profile->first_name = $request->first_name ?: $profile->first_name;
                $profile->last_name = $request->last_name ?: $profile->last_name;
                $profile->password = $request->password ? bcrypt($request->password) : $profile->password;
                $profile->phone_number = $request->phone_number ?: $profile->phone_number;
                $profile->address = $request->address ?: $profile->address;
                $profile->country = $request->country ?: $profile->country;
                $profile->city = $request->city ?: $profile->city;
                $profile->postal_code = $request->postal_code ?: $profile->postal_code;
                $profile->birthdate = $request->birthdate ?: $profile->birthdate;
                $profile->gender = $request->gender ?: $profile->gender;
                $profile->degree = $request->degree ?: $profile->degree;
                $profile->license_number = $request->license_number ?: $profile->license_number;
                $profile->save();


                return response()->json([
                    'status' => '200',
                    'message' => 'Update data successfully',
                    'body' => $profile,
                ], 200);
            } else {
                return response()->json([
                    'status' => '400',
                    'message' => 'Invalid Mitra Credential',
                ], 400);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => '400',
                'message' => $th,
            ], 400);
        }
    }

    public function getAllMitra()
    {
        try {
            $mitra = Mitra::all();
            return response()->json([
                'status' => '200',
                'message' => 'Get data successfully',
                'body' => $mitra,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => '400',
                'message' => $th,
            ], 400);
        }
    }

    public function getDetailMitra($mitra_id)
    {
        try {
            $mitra = Mitra::findOrFail($mitra_id);
            return response()->json([
                'status' => '200',
                'message' => 'Get detail successfully',
                'body' => $mitra,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => '400',
                'message' => $th,
            ], 400);
        }
    }
}