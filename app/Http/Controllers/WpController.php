<?php

namespace App\Http\Controllers;

use App\Models\Wp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class WpController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Wp::orderBy('dibuat', 'desc');
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $btn = '<div class="btn-group"><button type="button" data-id="' . $row->id_wp . '" class="btn btn-primary btn-sm btn-edit"><i class="fa fa-eye"></i></button><button type="button" data-id="' . $row->id_wp . '" data-name="' . $row->nama_wp . '" class="btn btn-danger btn-sm btn-delete"><i class="fa fa-trash"></i></button></div>';
                    return $btn;
                })
                ->addColumn('aktif', function ($row) {
                    if ($row->aktif == 0) {
                        $aktif = '<span class="badge badge-danger">Nonaktif</span>';
                    } else {
                        $aktif = '<span class="badge badge-success">Aktif</span>';
                    }
                    return $aktif;
                })
                ->rawColumns(['action', 'aktif'])
                ->make(true);
        }
        $x['title'] = "Data Wajib Pajak";
        return view('admin/wp', $x);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik_wp' => 'required|unique:tb_wp|max:16',
            'npwp' => 'required',
            'nama_wp' => 'required',
            'tgl_lahir_wp' => 'required',
            'alamat_wp' => 'required',
            'blok_wp' => 'required',
            'kodepos_wp' => 'required',
            'desa_wp' => 'required',
            'kec_wp' => 'required',
            'kab_wp' => 'required',
            'prov_wp' => 'required',
            'telp_wp' => 'required',
            'email_wp' => 'required',
            'pekerjaan_wp' => 'required',
            'password_wp' => 'required',
            'aktif' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('admin/wp')
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'nik_wp' => $request->input('nik_wp'),
            'npwp' => $request->input('npwp'),
            'nama_wp' => $request->input('nama_wp'),
            'tgl_lahir_wp' => $request->input('tgl_lahir_wp'),
            'alamat_wp' => $request->input('alamat_wp'),
            'blok_wp' => $request->input('blok_wp'),
            'kodepos_wp' => $request->input('kodepos_wp'),
            'desa_wp' => $request->input('desa_wp'),
            'kec_wp' => $request->input('kec_wp'),
            'kab_wp' => $request->input('kab_wp'),
            'prov_wp' => $request->input('prov_wp'),
            'telp_wp' => $request->input('telp_wp'),
            'email_wp' => $request->input('email_wp'),
            'pekerjaan_wp' => $request->input('pekerjaan_wp'),
            'password_wp' => Hash::make($request->input('password_wp')),
            'aktif' => $request->input('aktif'),
            'dibuat' => now()
        ];
        Wp::insert($data);
        session()->flash('type', 'success');
        session()->flash('notif', 'Data berhasil ditambah');
        return redirect('admin/wp');
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'npwp' => 'required',
            'nama_wp' => 'required',
            'tgl_lahir_wp' => 'required',
            'alamat_wp' => 'required',
            'blok_wp' => 'required',
            'kodepos_wp' => 'required',
            'desa_wp' => 'required',
            'kec_wp' => 'required',
            'kab_wp' => 'required',
            'prov_wp' => 'required',
            'telp_wp' => 'required',
            'email_wp' => 'required',
            'pekerjaan_wp' => 'required',
            'aktif' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('admin/wp')
                ->withErrors($validator)
                ->withInput();
        }

        if (empty($request->input('password_wp'))){
            $data = [
                'npwp' => $request->input('npwp'),
                'nama_wp' => $request->input('nama_wp'),
                'tgl_lahir_wp' => $request->input('tgl_lahir_wp'),
                'alamat_wp' => $request->input('alamat_wp'),
                'blok_wp' => $request->input('blok_wp'),
                'kodepos_wp' => $request->input('kodepos_wp'),
                'desa_wp' => $request->input('desa_wp'),
                'kec_wp' => $request->input('kec_wp'),
                'kab_wp' => $request->input('kab_wp'),
                'prov_wp' => $request->input('prov_wp'),
                'telp_wp' => $request->input('telp_wp'),
                'email_wp' => $request->input('email_wp'),
                'pekerjaan_wp' => $request->input('pekerjaan_wp'),
                'aktif' => $request->input('aktif')
            ];
        }else{
            $data = [
                'npwp' => $request->input('npwp'),
                'nama_wp' => $request->input('nama_wp'),
                'tgl_lahir_wp' => $request->input('tgl_lahir_wp'),
                'alamat_wp' => $request->input('alamat_wp'),
                'blok_wp' => $request->input('blok_wp'),
                'kodepos_wp' => $request->input('kodepos_wp'),
                'desa_wp' => $request->input('desa_wp'),
                'kec_wp' => $request->input('kec_wp'),
                'kab_wp' => $request->input('kab_wp'),
                'prov_wp' => $request->input('prov_wp'),
                'telp_wp' => $request->input('telp_wp'),
                'email_wp' => $request->input('email_wp'),
                'pekerjaan_wp' => $request->input('pekerjaan_wp'),
                'password_wp' => Hash::make($request->input('password_wp')),
                'aktif' => $request->input('aktif')
            ];
        }

        Wp::where('id_wp', $request->input('id'))->update($data);
        session()->flash('type', 'success');
        session()->flash('notif', 'Data berhasil disimpan');
        return redirect('admin/wp');
    }
    
    public function delete(Request $request)
    {
        $id = $request->input('id');
        Wp::where(['id_wp' => $id])->delete();
        session()->flash('notif', 'Data berhasil dihapus');
        session()->flash('type', 'success');
        return redirect('admin/wp');
    }

    public function data(Request $request)
    {
        echo json_encode(Wp::where(['id_wp' => $request->input('id')])->first());
    }
}
