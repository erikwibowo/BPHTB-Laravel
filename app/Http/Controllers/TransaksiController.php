<?php

namespace App\Http\Controllers;

use App\Models\Keterangan;
use App\Models\RiwayatTransaksi;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            }elseif ($request->segment(3) == 'diverifikasi') {
                $data = Transaksi::where('status', 3)->where('dihapus', 0)->orderBy('dibuat', 'desc');
                $url = route('admin.transaksi.diverifikasi');
            }elseif($request->segment(3) == 'ditolak'){
                $data = Transaksi::where('status', 4)->where('dihapus', 0)->orderBy('dibuat', 'desc');
                $url = route('admin.transaksi.ditolak');
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
                    }else{
                        $btn .= '<button type="button" data-toggle="tooltip" title="Hapus Data" data-id="' . $row->id_transaksi . '" data-name="' . $row->id_wp . '" class="btn btn-danger btn-sm btn-delete"><i class="fa fa-trash"></i></button>';
                    }
                    $btn .= '</div>';
                    return $btn;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 1) {
                        $sts = '<button data-id="'.$row->id_transaksi.'" data-status="'.$row->status.'" data-desc="didaftarkan" data-toggle="tooltip" title="Klik untuk mengubah status" class="btn btn-xs btn-ubah-status btn-info">Didaftarkan</button>';
                    }elseif ($row->status == 2) {
                        $sts = '<button data-id="' . $row->id_transaksi . '" data-status="' . $row->status . '" data-desc="diverifikasi" data-toggle="tooltip" title="Klik untuk mengubah status" class="btn btn-xs btn-ubah-status btn-primary">Diperiksa</button>';
                    } elseif ($row->status == 3) {
                        $sts = '<button data-id="' . $row->id_transaksi . '" data-status="' . $row->status . '" data-desc="diverifikasi" data-toggle="tooltip" title="Klik untuk mengubah status" class="btn btn-xs btn-ubah-status btn-warning">Diverifikasi</button>';
                    } elseif ($row->status == 4) {
                        $sts = '<button data-id="' . $row->id_transaksi . '" data-status="'.$row->status.'" data-desc="ditolak" data-toggle="tooltip" title="Klik untuk mengubah status" class="btn btn-xs btn-ubah-status btn-danger">Ditolak</button>';
                    }elseif ($row->status == 5) {
                        $sts = '<button data-id="'.$row->id_transaksi.'" data-status="'.$row->status.'" data-desc="selesai" data-toggle="tooltip" title="Klik untuk mengubah status" class="btn btn-xs btn-ubah-status btn-success">Selesai</button>';
                    }elseif ($row->status == 6) {
                        $sts = '<button data-id="'.$row->id_transaksi.'" data-status="'.$row->status.'" data-desc="kadaluarsa" data-toggle="tooltip" title="Klik untuk mengubah status" class="btn btn-xs btn-ubah-status btn-danger">Kadaluarsa</button>';
                    }

                    if ($row->status == 2 && $row->finalisasi == 1) {
                        $sts .= '&nbsp;<button data-id="'.$row->id_transaksi.'" data-finalisasi="'.$row->finalisasi.'" data-toggle="tooltip" title="Klik untuk membatalkan finalisasi status" class="btn btn-xs btn-info btn-ubah-finalisasi">Final</button>';
                    }elseif($row->status == 2 && $row->finalisasi == 0){
                        $sts .= '&nbsp;<button data-id="'.$row->id_transaksi.'" data-finalisasi="'.$row->finalisasi.'" data-toggle="tooltip" title="Klik untuk finalisasi transaksi" class="btn btn-xs btn-warning btn-ubah-finalisasi">Belum Final</button>';
                    }

                    if ($row->dihapus == 1) {
                        $sts .= '&nbsp;<button data-toggle="tooltip" title="Klik untuk merestore" class="btn btn-xs btn-danger">Dihapus</button>';
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
                ->editColumn('dibuat', '{{ date("d-m-y", strtotime("$dibuat")) }}')
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
        return redirect('admin/transaksi/' . $request->input('segment'));
    }

    public function ubah_status(Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('status');
        $alasan = "";
        if ($status == 1) {
            $desc = "didaftarkan";
        } elseif ($status == 2) {
            $desc = "diperiksa";
        } elseif ($status == 3) {
            $desc = "diverifikasi";
        } elseif ($status == 4) {
            $desc = "ditolak";
            $alasan = " karena ". $request->input('alasan');
        } elseif ($status == 5) {
            $desc = "selesai";
        } elseif ($status == 6) {
            $desc = "kadaluarsa";
        }

        RiwayatTransaksi::insert(['id_transaksi' => $id, 'riwayat_transaksi' => 'Transaksi telah ' . $desc.$alasan, 'id_admin' => session('id_admin'), 'dibuat' => now()]);
        Transaksi::where(['id_transaksi' => $id])->update(['status' => $status]);
        session()->flash('notif', 'Status data berhasil disimpan');
        session()->flash('type', 'success');
        return redirect('admin/transaksi/' . $request->input('segment'));
    }

    public function ubah_finalisasi(Request $request)
    {
        $id = $request->input('id');
        $finalisasi = $request->input('finalisasi');
        if ($finalisasi == 1) {
            $desc = "difinalisasi";
        } else {
            $desc = "batal difinalisasi";
        }

        RiwayatTransaksi::insert(['id_transaksi' => $id, 'riwayat_transaksi' => 'Transaksi telah ' . $desc, 'id_admin' => session('id_admin'), 'dibuat' => now()]);
        Transaksi::where(['id_transaksi' => $id])->update(['finalisasi' => $finalisasi]);
        session()->flash('notif', 'Data berhasil disimpan');
        session()->flash('type', 'success');
        return redirect('admin/transaksi/' . $request->input('segment'));
    }

    public function data_rinci_transaksi(Request $request){
        $data = DB::select("SELECT a.id_wp, a.id_transaksi, c.nik_wp, c.npwp, c.nama_wp, c.tgl_lahir_wp, c.pekerjaan_wp, c.alamat_wp, c.blok_wp, c.desa_wp, c.kec_wp, c.kab_wp, c.prov_wp, c.kodepos_wp, c.telp_wp, c.email_wp, b.jenis_transaksi, a.id_jenis_transaksi, a.nilai_transaksi, a.njoptkp, a.njkp, a.bphtb, a.dikuasakan, a.id_ppat, d.nama_ppat, a.no_sertifikat_tanah, a.nop, a.luas_tanah, a.luas_bangunan, a.njop_tanah, a.njop_bangunan, a.dibuat as tgl_trans, a.nop, a.nama_wp as nama_wp_trans, a.alamat_wp as alamat_wp_trans, a.desa_op, a.kec_op, a.alamat_op, a.id_transaksi, a.status, a.dibuat, e.kode_billing, e.kadaluarsa, a.nama_petugas_ppat, a.umur_petugas_ppat, a.pekerjaan_petugas_ppat, alamat_petugas_ppat, a.no_hp_petugas_ppat, a.no_ssb, a.id_jenis_transaksi, a.potongan, a.tahun FROM tb_transaksi a JOIN tb_jenis_transaksi b ON a.id_jenis_transaksi = b.id_jenis_transaksi JOIN tb_wp c ON a.id_wp = c.id_wp LEFT JOIN tb_ppat d ON a.id_ppat = d.id_ppat LEFT JOIN tb_billing e ON a.id_transaksi = e.id_transaksi WHERE a.id_transaksi = '$request->id' AND a.dihapus = 0 ORDER BY a.diubah DESC");
        $arra = array();
		foreach ($data as $key) {
            $arr['tgl_trans']					= $key->tgl_trans;
            $arr['nik_wp']						= $key->nik_wp;
            $arr['npwp']						= $key->npwp;
            $arr['nama_wp']						= $key->nama_wp;
            $arr['tgl_lahir_wp']				= $key->tgl_lahir_wp;
            $arr['pekerjaan_wp']				= $key->pekerjaan_wp;
            $arr['alamat_wp']					= $key->alamat_wp;
            $arr['blok_wp']						= $key->blok_wp;
            $arr['desa_wp']						= $key->desa_wp;
            $arr['kec_wp']						= $key->kec_wp;
            $arr['kab_wp']						= $key->kab_wp;
            $arr['kodepos_wp']					= $key->kodepos_wp;
            $arr['telp_wp']						= $key->telp_wp;
            $arr['email_wp']					= $key->email_wp;
            $arr['jenis_transaksi']				= $key->jenis_transaksi;
            $arr['nilai_transaksi']				= number_format($key->nilai_transaksi, 2, ',','.');
            $arr['njoptkp']						= number_format($key->njoptkp, 2, ',','.');
            $arr['njkp']						= number_format($key->njkp, 2, ',','.');
            $arr['potongan']					= number_format($key->potongan, 2, ',','.');
            $arr['bphtb']						= number_format($key->bphtb, 2, ',','.');
            $arr['dikuasakan']					= $key->dikuasakan;
            $arr['nama_petugas_ppat']			= $key->nama_petugas_ppat;
            $arr['umur_petugas_ppat']			= $key->umur_petugas_ppat;
            $arr['pekerjaan_petugas_ppat']		= $key->pekerjaan_petugas_ppat;
            $arr['alamat_petugas_ppat']			= $key->alamat_petugas_ppat;
            $arr['no_hp_petugas_ppat']			= $key->no_hp_petugas_ppat;
            $arr['nama_ppat']					= $key->nama_ppat;
            $arr['no_sertifikat_tanah']			= $key->no_sertifikat_tanah;
            $arr['nop']							= $key->nop;
            $arr['desa_op']						= $key->desa_op;
            $arr['kec_op']						= $key->kec_op;
            $arr['alamat_op']					= $key->alamat_op;
            $arr['luas_tanah']					= $key->luas_tanah;
            $arr['njop_tanah']					= number_format($key->njop_tanah, 2, ',','.');
            $arr['luas_bangunan']				= $key->luas_bangunan;
            $arr['njop_bangunan']				= number_format($key->njop_bangunan, 2, ',','.');
            $arr['nama_wp_trans']				= $key->nama_wp_trans;
            $arr['alamat_wp_trans']				= $key->alamat_wp_trans;
            $arr['kode_billing']				= $key->kode_billing;
            $arr['status']						= $key->status;
            $arr['tahun']						= $key->tahun;
			array_push($arra, $arr);
		}
		echo json_encode($arra);
    }
}
