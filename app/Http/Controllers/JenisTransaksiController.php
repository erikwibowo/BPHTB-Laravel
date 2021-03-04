<?php

namespace App\Http\Controllers;

use App\Models\JenisTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class JenisTransaksiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = JenisTransaksi::orderBy('dibuat', 'desc');
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $btn = '<div class="btn-group"><button type="button" data-id="' . $row->id_jenis_transaksi . '" class="btn btn-primary btn-sm btn-edit"><i class="fa fa-eye"></i></button><button type="button" data-id="' . $row->id_jenis_transaksi . '" data-name="' . $row->jenis_transaksi . '" class="btn btn-danger btn-sm btn-delete"><i class="fa fa-trash"></i></button></div>';
                    return $btn;
                })
                ->editColumn('potongan', '{{ number_format($potongan, 2, ",",".") }}')
                ->rawColumns(['action'])
                ->make(true);
        }
        $x['title'] = "Data Jenis Transaksi";
        return view('admin.jenistransaksi', $x);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis_transaksi' => 'required',
            'potongan' => 'required|digits_between:0,15'
        ]);

        if ($validator->fails()) {
            return redirect('admin/jenis-transaksi')
            ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'jenis_transaksi' => $request->input('jenis_transaksi'),
            'potongan' => $request->input('potongan')
        ];

        JenisTransaksi::where('id_jenis_transaksi', $request->input('id'))->update($data);
        session()->flash('type', 'success');
        session()->flash('notif', 'Data berhasil disimpan');
        return redirect('admin/jenis-transaksi');
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis_transaksi' => 'required',
            'potongan' => 'required|digits_between:0,15'
        ]);

        if ($validator->fails()) {
            return redirect('admin/jenis-transaksi')
            ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'jenis_transaksi' => $request->input('jenis_transaksi'),
            'potongan' => $request->input('potongan')
        ];
        JenisTransaksi::insert($data);
        session()->flash('type', 'success');
        session()->flash('notif', 'Data berhasil ditambah');
        return redirect('admin/jenis-transaksi');
    }

    public function data(Request $request)
    {
        echo json_encode(JenisTransaksi::where(['id_jenis_transaksi' => $request->input('id')])->first());
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        JenisTransaksi::where(['id_jenis_transaksi' => $id])->delete();
        session()->flash('notif', 'Data berhasil dihapus');
        session()->flash('type', 'success');
        return redirect('admin/jenis-transaksi');
    }
}
