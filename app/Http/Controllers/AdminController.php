<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::select("SELECT * FROM tb_admin");
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $btn = '<div class="btn-group"><button type="button" data-id="' . $row->id_admin . '" class="btn btn-primary btn-sm btn-edit"><i class="fa fa-eye"></i></button><button type="button" data-id="' . $row->id_admin . '" data-name="' . $row->nama_admin . '" class="btn btn-danger btn-sm btn-delete"><i class="fa fa-trash"></i></button></div>';
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
                ->addIndexColumn()
                ->make(true);
        }
        $x['title'] = "Data Admin";
        return view('admin.admin', $x);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_admin' => 'required',
            'aktif' => 'required',
            'level' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('admin/admin')
                ->withErrors($validator)
                ->withInput();
        }

        if (empty($request->input('password'))) {
            $data = [
                'nama_admin' => $request->input('nama_admin'),
                'username' => $request->input('username'),
                'level' => $request->input('level'),
                'aktif' => $request->input('aktif'),
            ];
        } else {
            $data = [
                'nama_admin' => $request->input('nama_admin'),
                'username' => $request->input('username'),
                'password' => Hash::make($request->input('password')),
                'level' => $request->input('level'),
                'aktif' => $request->input('aktif'),
            ];
        }
        Admin::where('id_admin', $request->input('id'))->update($data);
        session()->flash('type', 'success');
        session()->flash('notif', 'Data berhasil disimpan');
        return redirect('admin/admin');
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_admin' => 'required',
            'username' => 'required|unique:tb_admin',
            'aktif' => 'required',
            'level' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('admin/admin')
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'nama_admin' => $request->input('nama_admin'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'level' => $request->input('level'),
            'aktif' => $request->input('aktif'),
            'dibuat' => now()
        ];
        Admin::insert($data);
        session()->flash('type', 'success');
        session()->flash('notif', 'Data berhasil ditambah');
        return redirect('admin/admin');
    }

    public function data(Request $request)
    {
        echo json_encode(Admin::where(['id_admin' => $request->input('id')])->first());
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        Admin::where(['id_admin' => $id])->delete();
        session()->flash('notif', 'Data berhasil dihapus');
        session()->flash('type', 'success');
        return redirect('admin/admin');
    }

    public function auth(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
            'g-recaptcha-response' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('admin/login')
                ->withErrors($validator)
                ->withInput();
        }
        $username = $request->input('username');
        $password = $request->input('password');
        $response_key = $request->input('g-recaptcha-response');
        $secret_key = env('GOOGLE_RECHATPTCHA_SECRETKEY');

        $verify = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret_key . '&response=' . $response_key);
        $response = json_decode($verify);

        $data = Admin::where(['username' => $username]);
        if ($response->success) {
            if ($data->count() == 1) {
                $data = $data->first();
                if ($data->aktif == 1) {
                    if (Hash::check($password, $data->password)) {
                        session([
                            'id_admin' => $data->id_admin,
                            'nama_admin' => $data->nama_admin,
                            'level' => $data->level,
                            'username' => $data->username,
                            'login_status' => true
                        ]);
                        Admin::where("id_admin", $data->id_admin)->update(['login_at' => now()]);
                        session()->flash('notif', 'Selamat Datang ' . $data->nama_admin);
                        session()->flash('type', 'info');
                        return redirect('admin');
                    } else {
                        session()->flash('type', 'error');
                        session()->flash('notif', 'Email atau password anda tidak sesuai');
                    }
                } else {
                    session()->flash('type', 'error');
                    session()->flash('notif', 'Akun anda nonaktif. Silahkan hubungi administrator');
                }
            } else {
                session()->flash('type', 'error');
                session()->flash('notif', 'Email atau password anda tidak sesuai');
            }
        }else{
            session()->flash('type', 'error');
            session()->flash('notif', 'Ups! Sepertinya ada yang salah');
        }
        return redirect('admin/login');
    }

    public function logout()
    {
        session()->flash('type', 'info');
        session()->flash('notif', 'Sampai jumpa ' . session('nama_admin'));
        session()->forget(['id_admin', 'nama_admin', 'username', 'level', 'login_status']);
        return redirect('admin/login');
    }
}
