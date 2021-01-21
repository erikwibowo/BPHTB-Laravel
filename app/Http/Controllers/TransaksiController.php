<?php

namespace App\Http\Controllers;

use App\Models\RiwayatTransaksi;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $url = '';
        if ($request->ajax()) {
            if($request->segment(3) == 'didaftarkan'){
                $data = Transaksi::where('status', 1)->where('dihapus', 0)->orderBy('dibuat', 'desc');
                $url = route('admin.transaksi.didaftarkan');
            }elseif($request->segment(3) == 'diperiksa'){
                $data = Transaksi::where('status', 2)->where('dihapus', 0)->where('finalisasi' , 0)->orderBy('dibuat', 'desc');
                $url = route('admin.transaksi.diperiksa');
            }elseif($request->segment(3) == 'difinalisasi'){
                $data = Transaksi::where('status', 2)->where('dihapus', 0)->where('finalisasi' , 1)->orderBy('dibuat', 'desc');
                $url = route('admin.transaksi.difinalisasi');
            }elseif($request->segment(3) == 'ditolak'){
                $data = Transaksi::where('status', 3)->where('dihapus', 0)->orderBy('dibuat', 'desc');
                $url = route('admin.transaksi.ditolak');
            }elseif($request->segment(3) == 'diverifikasi'){
                $data = Transaksi::where('status', 4)->where('dihapus', 0)->orderBy('dibuat', 'desc');
                $url = route('admin.transaksi.diverifikasi');
            }elseif($request->segment(3) == 'selesai'){
                $data = Transaksi::where('status', 5)->where('dihapus', 0)->orderBy('dibuat', 'desc');
                $url = route('admin.transaksi.selesai');
            }elseif($request->segment(3) == 'kadaluarsa'){
                $data = Transaksi::where('status', 6)->where('dihapus', 0)->orderBy('dibuat', 'desc');
                $url = route('admin.transaksi.kadaluarsa');
            }elseif($request->segment(3) == 'dihapus'){
                $data = Transaksi::where('dihapus', 1)->orderBy('dibuat', 'desc');
                $url = route('admin.transaksi.dihapus');
            }elseif($request->segment(2) == 'transaksi' && $request->segment(3) == ''){
                $data = Transaksi::orderBy('dibuat', 'desc');
                $url = route('admin.transaksi.index');
            }
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $btn = '
                    <div class="btn-group">
                        <button type="button" data-toggle="tooltip" title="Lihat/Data" data-id="' . $row->id_transaksi . '" class="btn btn-primary btn-sm btn-edit"><i class="fa fa-eye"></i></button>
                        <button type="button" data-toggle="tooltip" title="Riwayat Data" data-id="' . $row->id_transaksi . '" class="btn btn-success btn-sm btn-riwayat"><i class="fa fa-clock"></i></button>';
                    if ($row->dihapus == 1) {
                        $btn .= '<button type="button" data-toggle="tooltip" title="Restore Data" data-id="' . $row->id_transaksi . '" data-name="' . $row->id_wp . '" class="btn btn-warning btn-sm btn-restore"><i class="fa fa-undo-alt"></i></button>';
                    }
                    $btn .= '<button type="button" data-toggle="tooltip" title="Hapus Data" data-id="' . $row->id_transaksi . '" data-name="' . $row->id_wp . '" class="btn btn-danger btn-sm btn-delete"><i class="fa fa-trash"></i></button>
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

    public function delete(Request $request)
    {
        $id = $request->input('id');
        Transaksi::where(['id_transaksi' => $id])->update(['dihapus' => 1]);
        RiwayatTransaksi::insert(['id_transaksi' => $id, 'riwayat_transaksi' => 'Transaksi dihapus', 'id_admin' => session('id_admin'), 'dibuat' => now()]);
        session()->flash('notif', 'Data berhasil dihapus');
        session()->flash('type', 'success');
        return redirect('admin/transaksi/'.$request->input('segment'));
    }

    public function restore(Request $request)
    {
        $id = $request->input('id');
        RiwayatTransaksi::insert(['id_transaksi' => $id, 'riwayat_transaksi' => 'Transaksi direstore', 'id_admin' => session('id_admin'), 'dibuat' => now()]);
        Transaksi::where(['id_transaksi' => $id])->update(['dihapus' => 0]);
        session()->flash('notif', 'Data berhasil direstore');
        session()->flash('type', 'success');
        return redirect('admin/transaksi/'.$request->input('segment'));
    }
}
