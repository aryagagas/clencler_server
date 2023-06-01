<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function getUserTransaksi($userid)
    {
        try {
            $transaksi = Transaksi::with('user','mitra')->where('user_id', $userid)->get();
            return response()->json(['message' => $transaksi]);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th]);
        }
    }
    public function getMitraTransaksi($mitraid)
    {
        try {
            $transaksi = Transaksi::with('user','mitra')->where('mitra_id', $mitraid)->get();
            return response()->json(['message' => $transaksi]);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th]);
        }
    }
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
            return response()->json(['message' => 'Transaksi berhasil dibuat']);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th]);
        }
    }
    public function updateTransaksi(Request $request, $transaksiid)
    {
        try {
            $request->validate([
                'status' => 'required',
            ]);
            Transaksi::where('id', $transaksiid)->update([
                'status' => $request->status,
            ]);
            $transaksi = Transaksi::findOrFail($transaksiid);
            return response()->json(['message' => 'Update successfully','body'=>$transaksi]);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th]);
        }
    }
}
