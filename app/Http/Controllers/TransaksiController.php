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
        if ($request->ajax()) {
            $data = Transaksi::orderBy('dibuat', 'desc');
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $btn = '
                    <div class="btn-group">
                        <button type="button" data-toggle="tooltip" title="Data" data-id="' . $row->id_transaksi . '" class="btn btn-primary btn-sm btn-edit"><i class="fa fa-eye"></i></button>
                        <button type="button" data-toggle="tooltip" title="Data" data-id="' . $row->id_transaksi . '" class="btn btn-success btn-sm btn-riwayat"><i class="fa fa-clock"></i></button>
                        <button type="button" data-toggle="tooltip" title="Data" data-id="' . $row->id_transaksi . '" data-name="' . $row->id_wp . '" class="btn btn-danger btn-sm btn-delete"><i class="fa fa-trash"></i></button>
                    </div>';
                    return $btn;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 1) {
                        $sts = '<span class="badge badge-info">Didaftarkan</span>';
                    }elseif ($row->status == 2) {
                        $sts = '<span class="badge badge-primary">Diperiksa</span>';
                    }elseif ($row->status == 3) {
                        $sts = '<span class="badge badge-danger">Ditolak</span>';
                    }elseif ($row->status == 4) {
                        $sts = '<span class="badge badge-warning">Menunggu Pembayaran</span>';
                    }elseif ($row->status == 5) {
                        $sts = '<span class="badge badge-success">Selesai</span>';
                    }elseif ($row->status == 6) {
                        $sts = '<span class="badge badge-danger">Kadaluarsa</span>';
                    }

                    if ($row->finalisasi == 1) {
                        $sts .= '<span class="badge badge-info">Finalisasi</span>';
                    }

                    if ($row->dihapus == 1) {
                        $sts .= '<span class="badge badge-danger">Dihapus</span>';
                    }
                    return $sts;
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
        $x['url']   = route('admin.transaksi.index');
        return view('admin/transaksi', $x);
    }

    public function dihapus(Request $request)
    {

        if ($request->ajax()) {
            $data = Transaksi::where('dihapus', 1)->orderBy('dibuat', 'desc');
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $btn = '
                    <div class="btn-group">
                        <button type="button" data-toggle="tooltip" title="Data" data-id="' . $row->id_transaksi . '" class="btn btn-primary btn-sm btn-edit"><i class="fa fa-eye"></i></button>
                        <button type="button" data-toggle="tooltip" title="Data" data-id="' . $row->id_transaksi . '" class="btn btn-success btn-sm btn-riwayat"><i class="fa fa-clock"></i></button>
                        <button type="button" data-toggle="tooltip" title="Data" data-id="' . $row->id_transaksi . '" data-name="' . $row->id_wp . '" class="btn btn-danger btn-sm btn-delete"><i class="fa fa-trash"></i></button>
                    </div>';
                    return $btn;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 1) {
                        $sts = '<span class="badge badge-info">Didaftarkan</span>';
                    }elseif ($row->status == 2) {
                        $sts = '<span class="badge badge-primary">Diperiksa</span>';
                    }elseif ($row->status == 3) {
                        $sts = '<span class="badge badge-danger">Ditolak</span>';
                    }elseif ($row->status == 4) {
                        $sts = '<span class="badge badge-warning">Menunggu Pembayaran</span>';
                    }elseif ($row->status == 5) {
                        $sts = '<span class="badge badge-success">Selesai</span>';
                    }elseif ($row->status == 6) {
                        $sts = '<span class="badge badge-danger">Kadaluarsa</span>';
                    }

                    if ($row->finalisasi == 1) {
                        $sts .= '<span class="badge badge-info">Finalisasi</span>';
                    }

                    if ($row->dihapus == 1) {
                        $sts .= '<span class="badge badge-danger">Dihapus</span>';
                    }
                    return $sts;
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
        $x['url']   = route('admin.transaksi.dihapus');
        return view('admin/transaksi', $x);
    }

    public function where(Request $request)
    {

        $tahun = $request->input('tahun');
        if($request->segment(3) == 'didaftarkan'){
            $status = 1;
            $url = route('admin.transaksi.didaftarkan');
        }elseif($request->segment(3) == 'diperiksa'){
            $status = 2;
            $url = route('admin.transaksi.diperiksa');
        }elseif($request->segment(3) == 'ditolak'){
            $status = 3;
            $url = route('admin.transaksi.ditolak');
        }elseif($request->segment(3) == 'diverifikasi'){
            $status = 4;
            $url = route('admin.transaksi.diverifikasi');
        }elseif($request->segment(3) == 'selesai'){
            $status = 5;
            $url = route('admin.transaksi.selesai');
        }elseif($request->segment(3) == 'kadaluarsa'){
            $status = 6;
            $url = route('admin.transaksi.kadaluarsa');
        }

        if ($request->ajax()) {
            $data = Transaksi::where('status', $status)->where('dihapus', 0)->orderBy('dibuat', 'desc');
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $btn = '
                    <div class="btn-group">
                        <button type="button" data-toggle="tooltip" title="Data" data-id="' . $row->id_transaksi . '" class="btn btn-primary btn-sm btn-edit"><i class="fa fa-eye"></i></button>
                        <button type="button" data-toggle="tooltip" title="Data" data-id="' . $row->id_transaksi . '" class="btn btn-success btn-sm btn-riwayat"><i class="fa fa-clock"></i></button>
                        <button type="button" data-toggle="tooltip" title="Data" data-id="' . $row->id_transaksi . '" data-name="' . $row->id_wp . '" class="btn btn-danger btn-sm btn-delete"><i class="fa fa-trash"></i></button>
                    </div>';
                    return $btn;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 1) {
                        $sts = '<span class="badge badge-info">Didaftarkan</span>';
                    }elseif ($row->status == 2) {
                        $sts = '<span class="badge badge-primary">Diperiksa</span>';
                    }elseif ($row->status == 3) {
                        $sts = '<span class="badge badge-danger">Ditolak</span>';
                    }elseif ($row->status == 4) {
                        $sts = '<span class="badge badge-warning">Menunggu Pembayaran</span>';
                    }elseif ($row->status == 5) {
                        $sts = '<span class="badge badge-success">Selesai</span>';
                    }elseif ($row->status == 6) {
                        $sts = '<span class="badge badge-danger">Kadaluarsa</span>';
                    }

                    if ($row->finalisasi == 1) {
                        $sts .= '<span class="badge badge-info">Finalisasi</span>';
                    }

                    if ($row->dihapus == 1) {
                        $sts .= '<span class="badge badge-danger">Dihapus</span>';
                    }
                    return $sts;
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
        $x['url']   = $url;
        return view('admin/transaksi', $x);
    }
}
