<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function createTransaksi(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required',
                'mitra_id' => 'required',
                'status' => 'required',
                'platform' => 'required',
                'total' => 'required',
               
            ]);
            $transaksi = new Transaksi;
            $transaksi->user_id = $request->user_id;
            $transaksi->mitra_id = $request->mitra_id;
            $transaksi->status = $request->status;
            $transaksi->platform = $request->platform;
            $transaksi->total = $request->total;
            $transaksi->save();
            return response()->json([
                'status' => '200',
                'message' => 'Transaksi created successfully',
                'body' => $transaksi,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => '400',
                'message' => $th,
            ], 400);
        }
    }
    public function getUserTransaksi($user_id)
    {
        try {
            $transaksi = Transaksi::with('user','mitra')->where('user_id', $user_id)->get();
            return response()->json([
                'status' => '200',
                'message' => 'Get data successfully',
                'body' => $transaksi,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => '400',
                'message' => $th,
            ], 400);
        }
    }
    public function getMitraTransaksi($mitra_id)
    {
        try {
            $transaksi = Transaksi::with('user','mitra')->where('mitra_id', $mitra_id)->get();
            return response()->json([
                'status' => '200',
                'message' => 'Get data successfully',
                'body' => $transaksi,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => '400',
                'message' => $th,
            ], 400);
        }
    }
    
    public function getDetailTransaksi($transaksi_id)
    {
        try {
            $transaksi = Transaksi::with('user','mitra')->findOrFail($transaksi_id);
            return response()->json([
                'status' => '200',
                'message' => 'Get detail successfully',
                'body' => $transaksi,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => '400',
                'message' => $th,
            ], 400);
        }
    }

    public function getAllTransaksi(Request $request)
    {
        try {
            $transaksi = Transaksi::all();
            return response()->json([
                'status' => '200',
                'message' => 'Get data successfully',
                'body' => $transaksi,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => '400',
                'message' => $th,
            ], 400);
        }
    }
}
