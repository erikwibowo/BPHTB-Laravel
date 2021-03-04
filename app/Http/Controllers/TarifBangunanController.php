<?php

namespace App\Http\Controllers;

use App\Models\TarifBangunan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class TarifBangunanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = TarifBangunan::orderBy('kode', 'asc');
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $btn = '<div class="btn-group"><button type="button" data-id="' . $row->kode . '" class="btn btn-primary btn-sm btn-edit"><i class="fa fa-eye"></i></button><button type="button" data-id="' . $row->kode . '" data-name="' . $row->uraian . '" class="btn btn-danger btn-sm btn-delete"><i class="fa fa-trash"></i></button></div>';
                    return $btn;
                })
                ->editColumn('tarif', '{{ number_format($tarif, 2, ",",".") }}')
                ->rawColumns(['action'])
                ->make(true);
        }
        $x['title'] = "Data Tarif Bangunan";
        return view('admin.tarifbangunan', $x);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'uraian' => 'required',
            'luas1' => 'required',
            'luas2' => 'required',
            'ket_luas' => 'required',
            'lantai1' => 'required',
            'lantai2' => 'required',
            'ket_lantai' => 'required',
            'tarif' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('admin/tarif-bangunan')
            ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'uraian' => $request->input('uraian'),
            'luas1' => $request->input('luas1'),
            'luas2' => $request->input('luas2'),
            'ket_luas' => $request->input('ket_luas'),
            'lantai1' => $request->input('lantai1'),
            'lantai2' => $request->input('lantai2'),
            'ket_lantai' => $request->input('ket_lantai'),
            'tarif' => $request->input('tarif')
        ];

        TarifBangunan::where('kode', $request->input('id'))->update($data);
        session()->flash('type', 'success');
        session()->flash('notif', 'Data berhasil disimpan');
        return redirect('admin/tarif-bangunan');
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'required|unique:tb_tarif_bangunan',
            'uraian' => 'required',
            'luas1' => 'required',
            'luas2' => 'required',
            'ket_luas' => 'required',
            'lantai1' => 'required',
            'lantai2' => 'required',
            'ket_lantai' => 'required',
            'tarif' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('admin/tarif-bangunan')
            ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'kode' => $request->input('kode'),
            'uraian' => $request->input('uraian'),
            'luas1' => $request->input('luas1'),
            'luas2' => $request->input('luas2'),
            'ket_luas' => $request->input('ket_luas'),
            'lantai1' => $request->input('lantai1'),
            'lantai2' => $request->input('lantai2'),
            'ket_lantai' => $request->input('ket_lantai'),
            'tarif' => $request->input('tarif')
        ];
        TarifBangunan::insert($data);
        session()->flash('type', 'success');
        session()->flash('notif', 'Data berhasil ditambah');
        return redirect('admin/tarif-bangunan');
    }

    public function data(Request $request)
    {
        echo json_encode(TarifBangunan::where(['kode' => $request->input('id')])->first());
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        TarifBangunan::where(['kode' => $id])->delete();
        session()->flash('notif', 'Data berhasil dihapus');
        session()->flash('type', 'success');
        return redirect('admin/tarif-bangunan');
    }
}
