<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Mitra;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Constraint\IsEmpty;

class UserController extends Controller
{

    public function register(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
            $user = new User;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();

            return response()->json([
                'status' => '200',
                'message' => 'User registered successfully',
                'body' => $user,
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
            if (User::where('email', $request->email)->first() && Hash::check($request->password, (User::where('email', $request->email)->first())->getAuthPassword())) {
                $user = User::where('email', $request->email)->first();
                $user->makeVisible('password');
                return response()->json([
                    'status' => '200',
                    'message' => 'Login successfully',
                    'body' => $user,
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
            if (User::where('email', $request->email)->first() && Hash::check($request->password, (User::where('email', $request->email)->first())->getAuthPassword())) {
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
    public function getProfile($user_id)
    {
        try {
            $profile = User::find($user_id);
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
    public function updateProfile(Request $request, $user_id)
    {
        try {
            $profile = User::find($user_id)->makeVisible('password');
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
                $profile->save();

                return response()->json([
                    'status' => '200',
                    'message' => 'Update data successfully',
                    'body' => $profile,
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
    public function getAllUser()
    {
        try {
            $users = User::all();
            return response()->json([
                'status' => '200',
                'message' => 'Get all user successfully',
                'body' => $users,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => '400',
                'message' => $th,
            ], 400);
        }
    }
    // public function getMitra($mitraid)
    // {
    //     try {
    //         $post = Mitra::findOrFail($mitraid);
    //         return response()->json(['body' => $post]);
    //     } catch (\Throwable $th) {
    //         return response()->json(['message' => $th]);
    //     }
    // }
}