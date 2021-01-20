@extends('admin.layout.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <select class="form-control" id="tahuns">
                            <option value="2020">Tahun 2020</option>
                            <option value="2021">Tahun 2021</option>
                        </select>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped datatable yajra-datatable">
                        <thead>
                            <tr>
                                <th>ID Transaksi</th>
                                <th>Nama WP</th>
                                <th>Jenis Transaksi</th>
                                <th>NOP</th>
                                <th>Alamat OP</th>
                                <th>Nilai Transaksi</th>
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
            ajax: "{{ $url }}",
            columns: [
                { data: 'id_transaksi', name: 'id_transaksi'},
                { data: 'nama_wp', name: 'nama_wp'},
                { data: 'jenis_transaksi', name: 'jenis_transaksi'},
                { data: 'nop', name: 'nop' },
                { data: 'alamat_op', name: 'alamat_op' },
                { data: 'nilai_transaksi', name: 'nilai_transaksi' },
                { data: 'dibuat', name: 'dibuat' },
                { data: 'status', name: 'status' },
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
                url: "{{ route('admin.admin.data') }}",
                type: "POST",
                dataType: "JSON",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    $("#nama_admin").val(data.nama_admin);
                    $("#username").val(data.username);
                    $("#level").val(data.level);
                    $("#aktif").val(data.aktif);
                    $("#id").val(data.id_admin);
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
        $("#tahun").on("change", function(){
            
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
            <form action="{{ route('admin.admin.create') }}" method="POST">
                @csrf
                <div class="input-group">
                    <label>Nama Admin</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('nama_admin') is-invalid @enderror" placeholder="Nama Admin" name="nama_admin" value="{{ old('nama_admin') }}" required>
                        @error('nama_admin')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Username</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Username" name="username" value="{{ old('username') }}" required>
                        @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" autocomplete="off" required>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Level</label>
                    <div class="input-group">
                        <select class="form-control @error('level') is-invalid @enderror" name="level" value="{{ old('level') }}" required>
                            <option value="Administrator">Administrator</option>
                            <option value="Petugas Pendaftaran">Petugas Pendaftaran</option>
                            <option value="Petugas Verifikator I">Petugas Verifikator I</option>
                            <option value="Petugas Verifikator II">Petugas Verifikator II</option>
                            <option value="BPN">BPN</option>
                        </select>
                        @error('level')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Aktif</label>
                    <div class="input-group">
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
            <form action="{{ route('admin.admin.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="input-group">
                    <label>Nama Admin</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('nama_admin') is-invalid @enderror" placeholder="Nama Admin" name="nama_admin" id="nama_admin" value="{{ old('nama_admin') }}" required>
                        @error('nama_admin')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Username</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Username" name="username" id="username" value="{{ old('username') }}" required>
                        @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Password</label> &nbsp;
                    <small class="form-text text-primary">Ketikkan password baru jika ingin mengganti password</small>
                    <div class="input-group">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" autocomplete="off">
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Level</label>
                    <div class="input-group">
                        <select class="form-control @error('level') is-invalid @enderror" name="level" id="level" value="{{ old('level') }}" required>
                            <option value="Administrator">Administrator</option>
                            <option value="Petugas Pendaftaran">Petugas Pendaftaran</option>
                            <option value="Petugas Verifikator I">Petugas Verifikator I</option>
                            <option value="Petugas Verifikator II">Petugas Verifikator II</option>
                            <option value="BPN">BPN</option>
                        </select>
                        @error('level')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Aktif</label>
                    <div class="input-group">
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
            <form action="{{ route('admin.admin.delete') }}" method="POST" enctype="multipart/form-data">
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