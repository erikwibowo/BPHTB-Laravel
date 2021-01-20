<?php

namespace App\Http\Controllers;

use App\Models\Ppat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use DataTables;

class PpatController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Ppat::orderBy('dibuat', 'desc');
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $btn = '<div class="btn-group"><button type="button" data-id="' . $row->id_ppat . '" class="btn btn-primary btn-sm btn-edit"><i class="fa fa-eye"></i></button><button type="button" data-id="' . $row->id_ppat . '" data-name="' . $row->nama_ppat . '" class="btn btn-danger btn-sm btn-delete"><i class="fa fa-trash"></i></button></div>';
                    return $btn;
                })
                ->addColumn('status_ppat', function ($row) {
                    if ($row->status_ppat == 0) {
                        $aktif = '<span class="badge badge-danger">Nonaktif</span>';
                    } else {
                        $aktif = '<span class="badge badge-success">Aktif</span>';
                    }
                    return $aktif;
                })
                ->rawColumns(['action', 'status_ppat'])
                ->make(true);
        }
        $x['title'] = "Data PPAT";
        return view('admin/ppat', $x);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_ppat' => 'required|unique:tb_ppat',
            'nama_ppat' => 'required',
            'alamat_ppat' => 'required',
            'sk_penetapan_ppat' => 'required',
            'tmt_ppat' => 'required',
            'sk_pemberhentian_ppat' => 'required',
            'telp_ppat' => 'required',
            'fax_ppat' => 'required',
            'email_ppat' => 'required|unique:tb_ppat',
            'status_ppat' => 'required',
            'password_ppat' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('admin/ppat')
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'id_ppat' => $request->input('id_ppat'),
            'nama_ppat' => $request->input('nama_ppat'),
            'alamat_ppat' => $request->input('alamat_ppat'),
            'sk_penetapan_ppat' => $request->input('sk_penetapan_ppat'),
            'tmt_ppat' => $request->input('tmt_ppat'),
            'sk_pemberhentian_ppat' => $request->input('sk_pemberhentian_ppat'),
            'telp_ppat' => $request->input('telp_ppat'),
            'fax_ppat' => $request->input('fax_ppat'),
            'email_ppat' => $request->input('email_ppat'),
            'password_ppat' => Hash::make($request->input('password_ppat')),
            'status_ppat' => $request->input('status_ppat'),
            'dibuat' => now()
        ];
        Ppat::insert($data);
        session()->flash('type', 'success');
        session()->flash('notif', 'Data berhasil ditambah');
        return redirect('admin/ppat');
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_ppat' => 'required',
            'alamat_ppat' => 'required',
            'sk_penetapan_ppat' => 'required',
            'tmt_ppat' => 'required',
            'sk_pemberhentian_ppat' => 'required',
            'telp_ppat' => 'required',
            'fax_ppat' => 'required',
            'status_ppat' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('admin/ppat')
                ->withErrors($validator)
                ->withInput();
        }

        if (empty($request->input('password_ppat'))){
            $data = [
                'nama_ppat' => $request->input('nama_ppat'),
                'alamat_ppat' => $request->input('alamat_ppat'),
                'sk_penetapan_ppat' => $request->input('sk_penetapan_ppat'),
                'tmt_ppat' => $request->input('tmt_ppat'),
                'sk_pemberhentian_ppat' => $request->input('sk_pemberhentian_ppat'),
                'telp_ppat' => $request->input('telp_ppat'),
                'fax_ppat' => $request->input('fax_ppat'),
                'status_ppat' => $request->input('status_ppat'),
            ];
        }else{
            $data = [
                'nama_ppat' => $request->input('nama_ppat'),
                'alamat_ppat' => $request->input('alamat_ppat'),
                'sk_penetapan_ppat' => $request->input('sk_penetapan_ppat'),
                'tmt_ppat' => $request->input('tmt_ppat'),
                'sk_pemberhentian_ppat' => $request->input('sk_pemberhentian_ppat'),
                'telp_ppat' => $request->input('telp_ppat'),
                'fax_ppat' => $request->input('fax_ppat'),
                'password_ppat' => Hash::make($request->input('password_ppat')),
                'status_ppat' => $request->input('status_ppat'),
            ];
        }

        Ppat::where('id_ppat', $request->input('id'))->update($data);
        session()->flash('type', 'success');
        session()->flash('notif', 'Data berhasil disimpan');
        return redirect('admin/ppat');
    }
    
    public function delete(Request $request)
    {
        $id = $request->input('id');
        Ppat::where(['id_ppat' => $id])->delete();
        session()->flash('notif', 'Data berhasil dihapus');
        session()->flash('type', 'success');
        return redirect('admin/ppat');
    }

    public function data(Request $request)
    {
        echo json_encode(Ppat::where(['id_ppat' => $request->input('id')])->first());
    }
}
