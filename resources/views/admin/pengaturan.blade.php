@extends('admin.layout.master')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                {{-- <div class="card-header">
                    <h3 class="card-title">
                        <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus"></i> Tambah</a>
                    </h3>
                </div> --}}
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ route('admin.pengaturan.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="input-group">
                        <label>Tenggat Waktu Billing (Hari)</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('tenggat_waktu') is-invalid @enderror" placeholder="Tenggat Waktu Billing" name="tenggat_waktu" value="{{ $data->tenggat_waktu }}" required>
                            @error('tenggat_waktu')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="input-group">
                        <label>Tenggat Waktu Daftar (Hari)</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('tenggat_waktu_daftar') is-invalid @enderror" placeholder="Tenggat Waktu Billing" name="tenggat_waktu_daftar" value="{{ $data->tenggat_waktu_daftar }}" required>
                            @error('tenggat_waktu_daftar')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <input type="hidden" name="id" value="{{ $data->id_pengaturan }}">
                    <button type="reset" class="btn btn-danger">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection