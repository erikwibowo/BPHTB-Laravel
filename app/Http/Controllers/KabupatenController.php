<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KabupatenController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Kabupaten::orderBy('id_kabupaten', 'asc');
            return DataTables::of($data)
                ->addColumn('nama_provinsi', function ($row) {
                    return $row->provinsi->nama_provinsi;
                })
                ->rawColumns(['nama_provinsi'])
                ->make(true);
        }
        $x['title'] = "Data Kabupaten";
        return view('admin/kabupaten', $x);
    }
}
