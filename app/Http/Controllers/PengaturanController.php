<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengaturanController extends Controller
{
    public function index(){
        $x['title'] = "Data Pengaturan";
        $x['data']  = Pengaturan::where('id_pengaturan', 1)->first();
        return view('admin/pengaturan', $x);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tenggat_waktu' => 'required|digits_between:1,2',
            'tenggat_waktu_daftar' => 'required|digits_between:1,2'
        ]);

        if ($validator->fails()) {
            return redirect('admin/pengaturan')
            ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'tenggat_waktu' => $request->input('tenggat_waktu'),
            'tenggat_waktu_daftar' => $request->input('tenggat_waktu_daftar')
        ];

        Pengaturan::where('id_pengaturan', $request->input('id'))->update($data);
        session()->flash('type', 'success');
        session()->flash('notif', 'Data berhasil disimpan');
        return redirect('admin/pengaturan');
    }
}
