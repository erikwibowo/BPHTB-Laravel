<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DesaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Desa::orderBy('id_kecamatan', 'asc');
            return DataTables::of($data)
                ->addColumn('nama_provinsi', function ($row) {
                    return $row->kecamatan->kabupaten->provinsi->nama_provinsi;
                })
                ->addColumn('nama_kabupaten', function ($row) {
                    return $row->kecamatan->kabupaten->nama_kabupaten;
                })
                ->addColumn('nama_kecamatan', function ($row) {
                    return $row->kecamatan->nama_kecamatan;
                })
                ->rawColumns(['nama_provinsi', 'nama_kabupaten', 'nama_kecamatan'])
                ->make(true);
        }
        $x['title'] = "Data Desa";
        return view('admin.desa', $x);
    }
}
