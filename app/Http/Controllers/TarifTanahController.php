<?php

namespace App\Http\Controllers;

use App\Models\TarifTanah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class TarifTanahController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = TarifTanah::orderBy('id_tarif', 'asc');
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $btn = '<div class="btn-group"><button type="button" data-id="' . $row->id_tarif . '" class="btn btn-primary btn-sm btn-edit"><i class="fa fa-eye"></i></button><button type="button" data-id="' . $row->id_tarif . '" data-name="' . $row->jalan . '" class="btn btn-danger btn-sm btn-delete"><i class="fa fa-trash"></i></button></div>';
                    return $btn;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 0) {
                        $status = '<span class="badge badge-danger">Nonaktif</span>';
                    } else {
                        $status = '<span class="badge badge-success">Aktif</span>';
                    }
                    return $status;
                })
                ->editColumn('njop', '{{ number_format($njop, 2, ",",".") }}')
                ->editColumn('npasar', '{{ number_format($npasar, 2, ",",".") }}')
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        $x['title'] = "Data Tarif Tanah";
        return view('admin.tariftanah', $x);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kdkab' => 'required',
            'kdkec' => 'required',
            'kddesa' => 'required',
            'kdblok' => 'required',
            'jalan' => 'required',
            'kdzona' => 'required',
            'njop' => 'required',
            'npasar' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('admin/tarif-tanah')
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'kdkab' => $request->input('kdkab'),
            'kdkec' => $request->input('kdkec'),
            'kddesa' => $request->input('kddesa'),
            'kdblok' => $request->input('kdblok'),
            'jalan' => $request->input('jalan'),
            'kdzona' => $request->input('kdzona'),
            'njop' => $request->input('njop'),
            'npasar' => $request->input('npasar'),
            'status' => $request->input('status'),
        ];

        TarifTanah::where('id_tarif', $request->input('id'))->update($data);
        session()->flash('type', 'success');
        session()->flash('notif', 'Data berhasil disimpan');
        return redirect('admin/tarif-tanah');
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kdkab' => 'required',
            'kdkec' => 'required',
            'kddesa' => 'required',
            'kdblok' => 'required',
            'jalan' => 'required',
            'kdzona' => 'required',
            'njop' => 'required',
            'npasar' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('admin/tarif-tanah')
            ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'kdkab' => $request->input('kdkab'),
            'kdkec' => $request->input('kdkec'),
            'kddesa' => $request->input('kddesa'),
            'kdblok' => $request->input('kdblok'),
            'jalan' => $request->input('jalan'),
            'kdzona' => $request->input('kdzona'),
            'njop' => $request->input('njop'),
            'npasar' => $request->input('npasar')
        ];
        TarifTanah::insert($data);
        session()->flash('type', 'success');
        session()->flash('notif', 'Data berhasil ditambah');
        return redirect('admin/tarif-tanah');
    }

    public function data(Request $request)
    {
        echo json_encode(TarifTanah::where(['id_tarif' => $request->input('id')])->first());
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        TarifTanah::where(['id_tarif' => $id])->delete();
        session()->flash('notif', 'Data berhasil dihapus');
        session()->flash('type', 'success');
        return redirect('admin/tarif-tanah');
    }
}
