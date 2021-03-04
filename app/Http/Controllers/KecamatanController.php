<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KecamatanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Kecamatan::orderBy('id_kecamatan', 'asc');
            return DataTables::of($data)
                ->addColumn('nama_provinsi', function ($row) {
                    return $row->kabupaten->provinsi->nama_provinsi;
                })
                ->addColumn('nama_kabupaten', function ($row) {
                    return $row->kabupaten->nama_kabupaten;
                })
                ->rawColumns(['nama_provinsi', 'nama_kabupaten'])
                ->make(true);
        }
        $x['title'] = "Data Kecamatan";
        return view('admin.kecamatan', $x);
    }
}
