@extends('admin.layout.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-tambah" data-backdrop="static" data-keyboard="false"><i class="fas fa-plus"></i> Tambah</a>
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped datatable yajra-datatable" style="width: 100%">
                        <thead>
                            <tr>
                                <th>NIK</th>
                                <th>Nama Wajib Pajak</th>
                                <th>Tanggal Lahir</th>
                                <th>Alamat</th>
                                <th>No. Telepon</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
        </div>
    </div>
<script>
    $(function() {
        var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.wp.index') }}",
            columns: [
                { data: 'nik_wp', name: 'nik_wp'},
                { data: 'nama_wp', name: 'nama_wp'},
                { data: 'tgl_lahir_wp', name: 'tgl_lahir_wp' },
                { data: 'alamat_wp', name: 'alamat_wp' },
                { data: 'telp_wp', name: 'telp_wp' },
                { data: 'dibuat', name: 'dibuat' },
                { data: 'aktif', name: 'aktif' },
                { data: 'action', name: 'action', orderable: false, searchable: true },
            ]
        });
    });
    $(document).ready(function() {
        $(document).on("click", '.btn-edit', function() {
            let id = $(this).attr("data-id");
            $('#modal-loading').modal({backdrop: 'static', keyboard: false, show: true});
            $.ajax({
                url: "{{ route('admin.wp.data') }}",
                type: "POST",
                dataType: "JSON",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    $("#nik_wp").val(data.nik_wp);
                    $("#npwp").val(data.npwp);
                    $("#nama_wp").val(data.nama_wp);
                    $("#tgl_lahir_wp").val(data.tgl_lahir_wp);
                    $("#alamat_wp").val(data.alamat_wp);
                    $("#prov_wp").val(data.prov_wp);
                    $("#kab_wp").val(data.kab_wp);
                    $("#kec_wp").val(data.kec_wp);
                    $("#desa_wp").val(data.desa_wp);
                    $("#blok_wp").val(data.blok_wp);
                    $("#kodepos_wp").val(data.kodepos_wp);
                    $("#telp_wp").val(data.telp_wp);
                    $("#email_wp").val(data.email_wp);
                    $("#pekerjaan_wp").val(data.pekerjaan_wp);
                    $("#aktif").val(data.aktif);
                    $("#id").val(data.id_wp);
                    $('#modal-loading').modal('hide');
                    $('#modal-edit').modal({backdrop: 'static', keyboard: false, show: true});
                },
            });
        });
        $(document).on("click", '.btn-delete', function() {
            let id = $(this).attr("data-id");
            let name = $(this).attr("data-name");
            $("#did").val(id);
            $("#delete-data").html(name);
            $('#modal-delete').modal({backdrop: 'static', keyboard: false, show: true});
        });
    });
</script>
<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Tambah Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.wp.create') }}" method="POST" class="form-horizontal">
                @csrf
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">NIK WP</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('nik_wp') is-invalid @enderror" placeholder="NIK WP" name="nik_wp" value="{{ old('nik_wp') }}" required>
                        @error('nik_wp')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">NPWP</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('npwp') is-invalid @enderror" placeholder="NPWP" name="npwp" value="{{ old('npwp') }}" required>
                        @error('npwp')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">Nama WP</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('nama_wp') is-invalid @enderror" placeholder="Nama WP" name="nama_wp" value="{{ old('nama_wp') }}" required>
                        @error('nama_wp')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">Tanggal Lahir WP</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control @error('tgl_lahir_wp') is-invalid @enderror" placeholder="Tanggal Lahir WP" name="tgl_lahir_wp" value="{{ old('tgl_lahir_wp') }}" required>
                        @error('tgl_lahir_wp')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">Alamat WP</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('alamat_wp') is-invalid @enderror" placeholder="Alamat WP" name="alamat_wp" value="{{ old('alamat_wp') }}" required>
                        @error('alamat_wp')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">Provinsi WP</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('prov_wp') is-invalid @enderror" placeholder="Provinsi WP" name="prov_wp" value="{{ old('prov_wp') }}" required>
                        @error('prov_wp')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">Kabupaten WP</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('kab_wp') is-invalid @enderror" placeholder="Kabupaten WP" name="kab_wp" value="{{ old('kab_wp') }}" required>
                        @error('kab_wp')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">Kecamatan WP</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('kec_wp') is-invalid @enderror" placeholder="Kecamatan WP" name="kec_wp" value="{{ old('kec_wp') }}" required>
                        @error('kec_wp')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">Desa/Kelurahan WP</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('desa_wp') is-invalid @enderror" placeholder="Desa/Kelurahan WP" name="desa_wp" value="{{ old('desa_wp') }}" required>
                        @error('desa_wp')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">Blok WP</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('blok_wp') is-invalid @enderror" placeholder="Blok WP" name="blok_wp" value="{{ old('blok_wp') }}" required>
                        @error('blok_wp')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">Kode Pos WP</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('kodepos_wp') is-invalid @enderror" placeholder="Kode Pos WP" name="kodepos_wp" value="{{ old('kodepos_wp') }}" required>
                        @error('kodepos_wp')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">Telepon WP</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('telp_wp') is-invalid @enderror" placeholder="Telepon WP" name="telp_wp" value="{{ old('telp_wp') }}" required>
                        @error('telp_wp')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">Email WP</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control @error('email_wp') is-invalid @enderror" placeholder="Email WP" name="email_wp" value="{{ old('email_wp') }}" required>
                        @error('email_wp')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">Pekerjaan WP</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('pekerjaan_wp') is-invalid @enderror" placeholder="Pekerjaan WP" name="pekerjaan_wp" value="{{ old('pekerjaan_wp') }}" required>
                        @error('pekerjaan_wp')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">Password WP</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control @error('password_wp') is-invalid @enderror" placeholder="Password WP" name="password_wp" autocomplete="off" required>
                        @error('password_wp')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-9">
                        <select class="form-control @error('aktif') is-invalid @enderror" name="aktif" value="{{ old('aktif') }}" required>
                            <option value="1">Aktif</option>
                            <option value="0">Non Aktif</option>
                        </select>
                        @error('aktif')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Edit Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.wp.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">NIK WP</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('nik_wp') is-invalid @enderror" placeholder="NIK WP" id="nik_wp" value="{{ old('nik_wp') }}">
                        @error('nik_wp')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">NPWP</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('npwp') is-invalid @enderror" placeholder="NPWP" name="npwp" id="npwp" value="{{ old('npwp') }}" required>
                        @error('npwp')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">Nama WP</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('nama_wp') is-invalid @enderror" placeholder="Nama WP" name="nama_wp" id="nama_wp" value="{{ old('nama_wp') }}" required>
                        @error('nama_wp')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">Tanggal Lahir WP</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control @error('tgl_lahir_wp') is-invalid @enderror" placeholder="Tanggal Lahir WP" name="tgl_lahir_wp" id="tgl_lahir_wp" value="{{ old('tgl_lahir_wp') }}" required>
                        @error('tgl_lahir_wp')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">Alamat WP</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('alamat_wp') is-invalid @enderror" placeholder="Alamat WP" name="alamat_wp" id="alamat_wp" value="{{ old('alamat_wp') }}" required>
                        @error('alamat_wp')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">Provinsi WP</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('prov_wp') is-invalid @enderror" placeholder="Provinsi WP" name="prov_wp" id="prov_wp" value="{{ old('prov_wp') }}" required>
                        @error('prov_wp')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">Kabupaten WP</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('kab_wp') is-invalid @enderror" placeholder="Kabupaten WP" name="kab_wp" id="kab_wp" value="{{ old('kab_wp') }}" required>
                        @error('kab_wp')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">Kecamatan WP</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('kec_wp') is-invalid @enderror" placeholder="Kecamatan WP" name="kec_wp" id="kec_wp" value="{{ old('kec_wp') }}" required>
                        @error('kec_wp')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">Desa/Kelurahan WP</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('desa_wp') is-invalid @enderror" placeholder="Desa/Kelurahan WP" name="desa_wp" id="desa_wp" value="{{ old('desa_wp') }}" required>
                        @error('desa_wp')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">Blok WP</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('blok_wp') is-invalid @enderror" placeholder="Blok WP" name="blok_wp" id="blok_wp" value="{{ old('blok_wp') }}" required>
                        @error('blok_wp')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">Kode Pos WP</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('kodepos_wp') is-invalid @enderror" placeholder="Kode Pos WP" name="kodepos_wp" id="kodepos_wp" value="{{ old('kodepos_wp') }}" required>
                        @error('kodepos_wp')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">Telepon WP</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('telp_wp') is-invalid @enderror" placeholder="Telepon WP" name="telp_wp" id="telp_wp" value="{{ old('telp_wp') }}" required>
                        @error('telp_wp')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">Email WP</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control @error('email_wp') is-invalid @enderror" placeholder="Email WP" name="email_wp" id="email_wp" value="{{ old('email_wp') }}" required>
                        @error('email_wp')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">Pekerjaan WP</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('pekerjaan_wp') is-invalid @enderror" placeholder="Pekerjaan WP" name="pekerjaan_wp" id="pekerjaan_wp" value="{{ old('pekerjaan_wp') }}" required>
                        @error('pekerjaan_wp')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">Password WP</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control @error('password_wp') is-invalid @enderror" placeholder="Password WP" name="password_wp" autocomplete="off">
                        <small class="form-text text-primary">Ketikkan password baru jika ingin mengganti password</small>
                        @error('password_wp')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-9">
                        <select class="form-control @error('aktif') is-invalid @enderror" name="aktif" id="aktif" value="{{ old('aktif') }}" required>
                            <option value="1">Aktif</option>
                            <option value="0">Non Aktif</option>
                        </select>
                        @error('aktif')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
        </div>
        <div class="modal-footer justify-content-between">
            <input type="hidden" name="id" id="id">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-delete">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Hapus Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.wp.delete') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('DELETE')
                <p class="modal-text">Apakah anda yakin akan menghapus? <b id="delete-data"></b></p>
                <input type="hidden" name="id" id="did">
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-danger">Hapus</button>
        </div>
        </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection