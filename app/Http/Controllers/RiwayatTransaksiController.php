<?php

namespace App\Http\Controllers;

use App\Models\RiwayatTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RiwayatTransaksiController extends Controller
{
    public function data_by_transaksi(Request $request)
    {
        $ar = [];
        $data = DB::select("SELECT a.id_transaksi, a.riwayat_transaksi, b.nama_admin, c.nama_ppat, d.nama_wp, a.dibuat FROM tb_riwayat_transaksi a LEFT JOIN tb_admin b ON a.id_admin = b.id_admin LEFT JOIN tb_ppat c ON a.id_ppat = c.id_ppat LEFT JOIN tb_wp d ON a.id_wp = d.id_wp WHERE a.id_transaksi = '$request->id'");
        foreach ($data as $key) {
            $a['id_transaksi']  = $key->id_transaksi;
            $a['oleh'] = $key->nama_admin != null ? $key->nama_admin." (Petugas)":($key->nama_ppat != null ? $key->nama_ppat." (PPAT)":($key->nama_wp != null ? $key->nama_wp." (WP)":"Sistem"));
            $a['riwayat_transaksi']  = $key->riwayat_transaksi;
            $a['dibuat'] = $key->dibuat;
            array_push($ar, $a);
        }
        echo json_encode($ar);
    }
}
