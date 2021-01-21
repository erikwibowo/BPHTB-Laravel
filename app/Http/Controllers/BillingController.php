<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class BillingController extends Controller
{
    public function index(Request $request)
    {
        $url = '';
        if ($request->ajax()) {
            if($request->segment(3) == 'lunas'){
                $data = Billing::where('status', 1)->orderBy('dibuat', 'desc');
                $url = route('admin.billing.lunas');
            }elseif($request->segment(3) == 'belum-lunas'){
                $data = Billing::where('status', 0)->orderBy('dibuat', 'desc');
                $url = route('admin.billing.belumlunas');
            }elseif($request->segment(3) == 'kadaluarsa'){
                $data = Billing::where('status', 2)->orderBy('dibuat', 'desc');
                $url = route('admin.billing.kadaluarsa');
            }elseif($request->segment(2) == 'billing' && $request->segment(3) == ''){
                $data = Billing::orderBy('dibuat', 'desc');
                $url = route('admin.billing.kadaluarsa');
            }
            return DataTables::of($data)
                ->addColumn('action', function($row){
                    $action = '';
                    if ($row->status == 2) {
                        $action = '
                        <div class="btn-group">
                            <button type="button" data-toggle="tooltip" title="Perpanjang Kode Billing" class="btn btn-sm btn-warning btn-perpanjang"><i class="fas fa-sync-alt"></i></button>
                        </div>
                        ';
                    }
                    return $action;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 0) {
                        $status = '<span class="badge badge-warning">Belum Lunas</span>';
                    } else if($row->status == 1) {
                        $status = '<span class="badge badge-success">Lunas</span>';
                    } else if($row->status == 2) {
                        $status = '<span class="badge badge-danger">Kadaluarsa</span>';
                    }
                    return $status;
                })
                ->addColumn('nama_wp', function($row){
                    return $row->transaksi->wp->nama_wp;
                })
                ->addColumn('nop', function($row){
                    return $row->transaksi->nop;
                })
                ->addColumn('jenis_transaksi', function($row){
                    return $row->transaksi->jenistransaksi->jenis_transaksi;
                })
                ->rawColumns(['nama_wp', 'nop', 'jenis_transaksi', 'status', 'action'])
                ->make(true);
        }
        $x['title'] = "Data Billing ".Str::ucfirst(str_replace("-", " ", $request->segment(3)));
        $x['url']   = $url;
        return view('admin/billing', $x);
    }
}
