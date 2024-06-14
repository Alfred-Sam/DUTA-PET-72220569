<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\movieapp;

class APIcontroller extends Controller
{
    public function searchmovies(Request $request)
    {
        $cari = $request->input('q');
        $movies = movieapp::where('nama', 'LIKE', "%$cari%")->get();

        if ($movies->isEmpty()) {
            return response()->json([
                'success' => false,
                'data' => 'Data Tidak Ditemukan'
            ], 200)->header('Access-Control-Allow-Origin', '*');
        }
        else {
            return response()->json([
                'success' => true,
                'data' => $movies
            ], 200)->header('Access-Control-Allow-Origin', '*');
        }
    }
}
