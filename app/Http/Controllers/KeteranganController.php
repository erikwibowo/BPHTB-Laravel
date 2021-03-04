<?php

namespace App\Http\Controllers;

use App\Models\Keterangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class KeteranganController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Keterangan::orderBy('dibuat', 'desc');
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $btn = '<div class="btn-group"><button type="button" data-id="' . $row->id_keterangan . '" class="btn btn-primary btn-sm btn-edit"><i class="fa fa-eye"></i></button><button type="button" data-id="' . $row->id_keterangan . '" data-name="' . $row->keterangan . '" class="btn btn-danger btn-sm btn-delete"><i class="fa fa-trash"></i></button></div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $x['title'] = "Data Keterangan";
        return view('admin.keterangan', $x);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'keterangan' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('admin/keterangan')
            ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'keterangan' => $request->input('keterangan')
        ];

        Keterangan::where('id_keterangan', $request->input('id'))->update($data);
        session()->flash('type', 'success');
        session()->flash('notif', 'Data berhasil disimpan');
        return redirect('admin/keterangan');
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'keterangan' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('admin/keterangan')
            ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'keterangan' => $request->input('keterangan')
        ];
        Keterangan::insert($data);
        session()->flash('type', 'success');
        session()->flash('notif', 'Data berhasil ditambah');
        return redirect('admin/keterangan');
    }

    public function data_id(Request $request)
    {
        echo json_encode(Keterangan::where(['id_keterangan' => $request->input('id')])->first());
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        Keterangan::where(['id_keterangan' => $id])->delete();
        session()->flash('notif', 'Data berhasil dihapus');
        session()->flash('type', 'success');
        return redirect('admin/keterangan');
    }

    public function data(Request $request){
        echo json_encode(Keterangan::get());
    }
}
