<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Wp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WpController extends Controller
{
    public function login(Request $request)
    {
        $nik = $request->nik;
        $password = $request->password;

        $data = Wp::where(['nik_wp' => $nik]);
        if ($data->count() == 1) {
            $data = $data->first();
            if ($data->aktif == 1) {
                if (Hash::check($password, $data->password_wp)) {
                    Wp::where("id_wp", $data->id_wp)->update(['login_at' => now()]);
                    $res = [
                        'status'    => true,
                        'message'   => "NIK dan kata sandi anda tidak sesuai",
                        'data'      => [
                            'nik'   => $data->nik_wp
                        ]
                    ];
                } else {
                    $res = [
                        'status'    => false,
                        'message'   => "NIK dan kata sandi anda tidak sesuai",
                        'data'      => []
                    ];
                }
            } else {
                $res = [
                    'status'    => false,
                    'message'   => "Akun anda nonaktif, silahkan hubungi BPKD untuk mengaktifkan kembali",
                    'data'      => []
                ];
            }
        } else {
            $res = [
                'status'    => false,
                'message'   => "NIK dan kata sandi anda tidak sesuai",
                'data'      => []
            ];
        }

        return response()->json($res, 200);
    }
}
