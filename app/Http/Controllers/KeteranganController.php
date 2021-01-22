<?php

namespace App\Http\Controllers;

use App\Models\Keterangan;
use Illuminate\Http\Request;

class KeteranganController extends Controller
{
    public function data(Request $request){
        echo json_encode(Keterangan::get());
    }
}
