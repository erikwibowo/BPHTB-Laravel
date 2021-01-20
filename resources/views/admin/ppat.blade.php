@extends('admin.layout.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus"></i> Tambah</a>
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped datatable yajra-datatable">
                        <thead>
                            <tr>
                                <th>ID PPAT</th>
                                <th>Nama PPAT</th>
                                <th>Alamat</th>
                                <th>SK Penetapan</th>
                                <th>TMT</th>
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
            ajax: "{{ route('admin.ppat.index') }}",
            columns: [
                { data: 'id_ppat', name: 'id_ppat'},
                { data: 'nama_ppat', name: 'nama_ppat'},
                { data: 'alamat_ppat', name: 'alamat_ppat' },
                { data: 'sk_penetapan_ppat', name: 'sk_penetapan_ppat' },
                { data: 'tmt_ppat', name: 'tmt_ppat' },
                { data: 'status_ppat', name: 'status_ppat' },
                { data: 'action', name: 'action', orderable: false, searchable: true },
            ]
        });
    });
    $(document).ready(function() {
        $(document).on("click", '.btn-edit', function() {
            let id = $(this).attr("data-id");
            $('#modal-edit').modal('show');
            $('#modal-edit').modal({
                backdrop: 'static',
                keyboard: false
            });
            $.ajax({
                url: "{{ route('admin.ppat.data') }}",
                type: "POST",
                dataType: "JSON",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    $("#id_ppat").val(data.id_ppat);
                    $("#nama_ppat").val(data.nama_ppat);
                    $("#alamat_ppat").val(data.alamat_ppat);
                    $("#sk_penetapan_ppat").val(data.sk_penetapan_ppat);
                    $("#tmt_ppat").val(data.tmt_ppat);
                    $("#sk_pemberhentian_ppat").val(data.sk_pemberhentian_ppat);
                    $("#telp_ppat").val(data.telp_ppat);
                    $("#fax_ppat").val(data.fax_ppat);
                    $("#email_ppat").val(data.email_ppat);
                    $("#id").val(data.id_ppat);
                },
            });
        });
        $(document).on("click", '.btn-delete', function() {
            let id = $(this).attr("data-id");
            let name = $(this).attr("data-name");
            $("#did").val(id);
            $("#delete-data").html(name);
            $('#modal-delete').modal('show');
            $('#modal-delete').modal({
                backdrop: 'static',
                keyboard: false
            });
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
            <form action="{{ route('admin.ppat.create') }}" method="POST">
                @csrf
                <div class="input-group">
                    <label>ID PPAT</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('id_ppat') is-invalid @enderror" placeholder="ID PPAT" name="id_ppat" value="{{ old('id_ppat') }}" required>
                        @error('id_ppat')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Nama PPAT</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('nama_ppat') is-invalid @enderror" placeholder="Nama PPAT" name="nama_ppat" value="{{ old('nama_ppat') }}" required>
                        @error('nama_ppat')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Alamat PPAT</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('alamat_ppat') is-invalid @enderror" placeholder="Alamat PPAT" name="alamat_ppat" value="{{ old('alamat_ppat') }}" required>
                        @error('alamat_ppat')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>SK Penetapan PPAT</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('sk_penetapan_ppat') is-invalid @enderror" placeholder="SK Penetapan PPAT" name="sk_penetapan_ppat" value="{{ old('sk_penetapan_ppat') }}" required>
                        @error('sk_penetapan_ppat')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>TMT PPAT</label>
                    <div class="input-group">
                        <input type="date" class="form-control @error('tmt_ppat') is-invalid @enderror" placeholder="TMT PPAT" name="tmt_ppat" value="{{ old('tmt_ppat') }}" required>
                        @error('tmt_ppat')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>SK Pemberhentian PPAT</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('sk_pemberhentian_ppat') is-invalid @enderror" placeholder="SK Pemberhentian PPAT" name="sk_pemberhentian_ppat" value="{{ old('sk_pemberhentian_ppat') }}" required>
                        @error('sk_pemberhentian_ppat')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Telepon PPAT</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('telp_ppat') is-invalid @enderror" placeholder="Telepon PPAT" name="telp_ppat" value="{{ old('telp_ppat') }}" required>
                        @error('telp_ppat')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Fax PPAT</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('fax_ppat') is-invalid @enderror" placeholder="Fax PPAT" name="fax_ppat" value="{{ old('fax_ppat') }}" required>
                        @error('nama_ppat')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Email PPAT</label>
                    <div class="input-group">
                        <input type="email" class="form-control @error('email_ppat') is-invalid @enderror" placeholder="Email PPAT" name="email_ppat" value="{{ old('email_ppat') }}" required>
                        @error('email_ppat')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Password PPAT</label>
                    <div class="input-group">
                        <input type="password" class="form-control @error('password_ppat') is-invalid @enderror" placeholder="Password PPAT" name="password_ppat" autocomplete="off" required>
                        @error('password_ppat')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Status PPAT</label>
                    <div class="input-group">
                        <select class="form-control @error('status_ppat') is-invalid @enderror" name="status_ppat" value="{{ old('status_ppat') }}" required>
                            <option value="1">Aktif</option>
                            <option value="0">Non Aktif</option>
                        </select>
                        @error('status_ppat')
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
            <form action="{{ route('admin.ppat.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="input-group">
                    <label>ID PPAT</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('id_ppat') is-invalid @enderror" placeholder="ID PPAT" id="id_ppat" disabled value="{{ old('id_ppat') }}">
                        @error('id_ppat')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Nama PPAT</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('nama_ppat') is-invalid @enderror" placeholder="Nama PPAT" name="nama_ppat" id="nama_ppat" value="{{ old('nama_ppat') }}" required>
                        @error('nama_ppat')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Alamat PPAT</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('alamat_ppat') is-invalid @enderror" placeholder="Alamat PPAT" name="alamat_ppat" id="alamat_ppat" value="{{ old('alamat_ppat') }}" required>
                        @error('alamat_ppat')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>SK Penetapan PPAT</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('sk_penetapan_ppat') is-invalid @enderror" placeholder="SK Penetapan PPAT" name="sk_penetapan_ppat" id="sk_penetapan_ppat" value="{{ old('sk_penetapan_ppat') }}" required>
                        @error('sk_penetapan_ppat')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>TMT PPAT</label>
                    <div class="input-group">
                        <input type="date" class="form-control @error('tmt_ppat') is-invalid @enderror" placeholder="TMT PPAT" name="tmt_ppat" id="tmt_ppat" value="{{ old('tmt_ppat') }}" required>
                        @error('tmt_ppat')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>SK Pemberhentian PPAT</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('sk_pemberhentian_ppat') is-invalid @enderror" placeholder="SK Pemberhentian PPAT" name="sk_pemberhentian_ppat" id="sk_pemberhentian_ppat" value="{{ old('sk_pemberhentian_ppat') }}" required>
                        @error('sk_pemberhentian_ppat')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Telepon PPAT</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('telp_ppat') is-invalid @enderror" placeholder="Telepon PPAT" name="telp_ppat" id="telp_ppat" value="{{ old('telp_ppat') }}" required>
                        @error('telp_ppat')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Fax PPAT</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('fax_ppat') is-invalid @enderror" placeholder="Fax PPAT" name="fax_ppat" id="fax_ppat" value="{{ old('fax_ppat') }}" required>
                        @error('nama_ppat')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Email PPAT</label>
                    <div class="input-group">
                        <input type="email" class="form-control @error('email_ppat') is-invalid @enderror" placeholder="Email PPAT" id="email_ppat" disabled value="{{ old('email_ppat') }}">
                        @error('email_ppat')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Password PPAT</label> &nbsp;
                    <small class="form-text text-primary">Ketikkan password baru jika ingin mengganti password</small>
                    <div class="input-group">
                        <input type="password" class="form-control @error('password_ppat') is-invalid @enderror" placeholder="Password PPAT" name="password_ppat" autocomplete="off">
                        @error('password_ppat')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Status PPAT</label>
                    <div class="input-group">
                        <select class="form-control @error('status_ppat') is-invalid @enderror" name="status_ppat" id="status_ppat" value="{{ old('status_ppat') }}" required>
                            <option value="1">Aktif</option>
                            <option value="0">Non Aktif</option>
                        </select>
                        @error('status_ppat')
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
            <form action="{{ route('admin.ppat.delete') }}" method="POST" enctype="multipart/form-data">
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