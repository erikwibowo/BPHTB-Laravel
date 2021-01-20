<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {

        $tahun = $request->input('tahun');
        if($request->segment(3) == 'didaftarkan'){
            $status = 1;
        }elseif($request->segment(3) == 'diperiksa'){
            $status = 2;
        }elseif($request->segment(3) == 'ditolak'){
            $status = 3;
        }

        if ($request->ajax()) {
            $data = Transaksi::orderBy('dibuat', 'desc');
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $btn = '<div class="btn-group"><button type="button" data-id="' . $row->id_transaksi . '" class="btn btn-primary btn-sm btn-edit"><i class="fa fa-eye"></i></button><button type="button" data-id="' . $row->id_transaksi . '" data-name="' . $row->id_wp . '" class="btn btn-danger btn-sm btn-delete"><i class="fa fa-trash"></i></button></div>';
                    return $btn;
                })
                ->addColumn('status', function ($row) {
                    return '<span class="badge badge-info">Didaftarkan</span>';
                })
                ->addColumn('nama_wp', function($row){
                    return $row->wp->nama_wp;
                })
                ->addColumn('jenis_transaksi', function($row){
                    return $row->jenistransaksi->jenis_transaksi;
                })
                ->editColumn('nilai_transaksi', '{{ number_format($nilai_transaksi, 2, ",",".") }}')
                ->rawColumns(['action', 'status', 'nama_wp', 'jenis_transaksi'])
                ->make(true);
        }
        $x['title'] = "Data Transaksi ".Str::ucfirst($request->segment(3));
        $x['url']   = route('admin.transaksi.didaftarkan');
        return view('admin/transaksi', $x);
    }
}
