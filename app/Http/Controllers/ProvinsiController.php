<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProvinsiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Provinsi::orderBy('id_provinsi', 'asc');
            return DataTables::of($data)
                ->make(true);
        }
        $x['title'] = "Data Provinsi";
        return view('admin.provinsi', $x);
    }
}
