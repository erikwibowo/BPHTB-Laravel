<?php

namespace App\Http\Controllers;

use App\Models\Pemberitahuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class PemberitahuanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Pemberitahuan::orderBy('dibuat', 'desc');
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $btn = '<div class="btn-group"><button type="button" data-id="' . $row->id_pemberitahuan . '" class="btn btn-primary btn-sm btn-edit"><i class="fa fa-eye"></i></button><button type="button" data-id="' . $row->id_pemberitahuan . '" data-name="' . $row->pemberitahuan . '" class="btn btn-danger btn-sm btn-delete"><i class="fa fa-trash"></i></button></div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $x['title'] = "Data Pemberitahuan";
        return view('admin.pemberitahuan', $x);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pemberitahuan' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('admin/pemberitahuan')
            ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'pemberitahuan' => $request->input('pemberitahuan')
        ];

        Pemberitahuan::where('id_pemberitahuan', $request->input('id'))->update($data);
        session()->flash('type', 'success');
        session()->flash('notif', 'Data berhasil disimpan');
        return redirect('admin/pemberitahuan');
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pemberitahuan' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('admin/pemberitahuan')
            ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'pemberitahuan' => $request->input('pemberitahuan')
        ];
        Pemberitahuan::insert($data);
        session()->flash('type', 'success');
        session()->flash('notif', 'Data berhasil ditambah');
        return redirect('admin/pemberitahuan');
    }

    public function data(Request $request)
    {
        echo json_encode(Pemberitahuan::where(['id_pemberitahuan' => $request->input('id')])->first());
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        Pemberitahuan::where(['id_pemberitahuan' => $id])->delete();
        session()->flash('notif', 'Data berhasil dihapus');
        session()->flash('type', 'success');
        return redirect('admin/pemberitahuan');
    }
}
