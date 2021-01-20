<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!session('login_status')) {
            session()->flash('type', 'error');
            session()->flash('notif', 'Anda harus login terlebih dahulu');
            return redirect('admin/login');
        }
        $data = Admin::where('id_admin', session('id_admin'))->first();
        if ($data->aktif == 0) {
            session()->flash('type', 'error');
            session()->flash('notif', 'Akun anda nonaktif. Silahkan hubungi administrator');
            return redirect('admin/login');
        }
        return $next($request);
    }
}
