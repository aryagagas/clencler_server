<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
            if ($request->email == 'admin@gmail.com' && $request->password == '123') {
                return response()->json([
                    'status' => '200',
                    'message' => 'Login successfully',
                    'body' => null,
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
            if ($request->email == 'admin@gmail.com' && $request->password == '123') {
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
}
