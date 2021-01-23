<?php

namespace App\Http\Controllers;

use App\Models\Kodepos;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KodeposController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Kodepos::orderBy('id', 'asc');
            return DataTables::of($data)
                ->make(true);
        }
        $x['title'] = "Data Kode Pos";
        return view('admin/kodepos', $x);
    }
}
