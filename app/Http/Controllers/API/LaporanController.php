<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function getAllLaporan(){
        try {
            $laporan = Laporan::all();
            return response()->json([
                'status' => '200',
                'message' => 'Get laporan data successfully',
                'body' => $laporan,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => '400',
                'message' => $th,
            ], 400);
        }
    }
    public function getDetailLaporan($laporan_id){
        try {
            $laporan = Laporan::findOrFail($laporan_id);
            return response()->json([
                'status' => '200',
                'message' => 'Transaksi created successfully',
                'body' => $laporan,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => '400',
                'message' => $th,
            ], 400);
        }
    }
}
