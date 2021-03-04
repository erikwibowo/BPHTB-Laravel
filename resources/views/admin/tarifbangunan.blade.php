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
                                <th>Kode</th>
                                <th>Uraian</th>
                                <th>Luas 1</th>
                                <th>Luas 2</th>
                                <th>Ket. Luas</th>
                                <th>Lantai 1</th>
                                <th>Lantai 2</th>
                                <th>Ket. Lantai</th>
                                <th>Tarif</th>
                                <th>Update</th>
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
            ajax: "{{ route('admin.tarifbangunan.index') }}",
            columns: [
                { data: 'kode', name: 'kode'},
                { data: 'uraian', name: 'uraian'},
                { data: 'luas1', name: 'luas1'},
                { data: 'luas2', name: 'luas2'},
                { data: 'ket_luas', name: 'ket_luas'},
                { data: 'lantai1', name: 'lantai1'},
                { data: 'lantai2', name: 'lantai2'},
                { data: 'ket_lantai', name: 'ket_lantai'},
                { data: 'tarif', name: 'potongan', className: 'text-right'},
                { data: 'diubah', name: 'diubah' },
                { data: 'action', name: 'action', orderable: false, searchable: true },
            ]
        });
    });
    $(document).ready(function() {
        $(document).on("click", '.btn-edit', function() {
            let id = $(this).attr("data-id");
            $('#modal-loading').modal({backdrop: 'static', keyboard: false, show: true});
            $.ajax({
                url: "{{ route('admin.tarifbangunan.data') }}",
                type: "POST",
                dataType: "JSON",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    $("#kode").val(data.kode);
                    $("#uraian").val(data.uraian);
                    $("#luas1").val(data.luas1);
                    $("#luas2").val(data.luas2);
                    $("#ket_luas").val(data.ket_luas);
                    $("#lantai1").val(data.lantai1);
                    $("#lantai2").val(data.lantai2);
                    $("#ket_lantai").val(data.ket_lantai);
                    $("#tarif").val(data.tarif);
                    $("#id").val(data.kode);
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
            <form action="{{ route('admin.tarifbangunan.create') }}" method="POST">
                @csrf
                <div class="input-group">
                    <label>Kode</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('kode') is-invalid @enderror" placeholder="Kode" name="kode" value="{{ old('kode') }}" required>
                        @error('kode')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Uraian</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('uraian') is-invalid @enderror" placeholder="Uraian" name="uraian" value="{{ old('uraian') }}" required>
                        @error('uraian')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Luas 1</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('luas1') is-invalid @enderror" placeholder="Luas 1" name="luas1" value="{{ old('luas1') }}" required>
                        @error('luas1')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Luas 2</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('luas2') is-invalid @enderror" placeholder="Luas 2" name="luas2" value="{{ old('luas2') }}" required>
                        @error('luas2')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Keterangan Luas</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('ket_luas') is-invalid @enderror" placeholder="Keterangan Luas" name="ket_luas" value="{{ old('ket_luas') }}" required>
                        @error('ket_luas')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Lantai 1</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('lantai1') is-invalid @enderror" placeholder="Lantai 1" name="lantai1" value="{{ old('lantai1') }}" required>
                        @error('lantai1')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Lantai 2</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('lantai2') is-invalid @enderror" placeholder="Lantai 2" name="lantai2" value="{{ old('lantai2') }}" required>
                        @error('lantai2')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Keterangan Lantai</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('ket_lantai') is-invalid @enderror" placeholder="Keterangan Lantai" name="ket_lantai" value="{{ old('ket_lantai') }}" required>
                        @error('ket_lantai')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Tarif</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('tarif') is-invalid @enderror" placeholder="Tarif" name="tarif" value="{{ old('tarif') }}" required>
                        @error('tarif')
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
            <form action="{{ route('admin.tarifbangunan.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="input-group">
                    <label>Kode</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('kode') is-invalid @enderror" placeholder="Kode" id="kode" value="{{ old('kode') }}" disabled>
                        @error('kode')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Uraian</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('uraian') is-invalid @enderror" placeholder="Uraian" name="uraian" id="uraian" value="{{ old('uraian') }}" required>
                        @error('uraian')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Luas 1</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('luas1') is-invalid @enderror" placeholder="Luas 1" name="luas1" id="luas1" value="{{ old('luas1') }}" required>
                        @error('luas1')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Luas 2</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('luas2') is-invalid @enderror" placeholder="Luas 2" name="luas2" id="luas2" value="{{ old('luas2') }}" required>
                        @error('luas2')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Keterangan Luas</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('ket_luas') is-invalid @enderror" placeholder="Keterangan Luas" name="ket_luas" id="ket_luas" value="{{ old('ket_luas') }}" required>
                        @error('ket_luas')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Lantai 1</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('lantai1') is-invalid @enderror" placeholder="Lantai 1" name="lantai1" id="lantai1" value="{{ old('lantai1') }}" required>
                        @error('lantai1')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Lantai 2</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('lantai2') is-invalid @enderror" placeholder="Lantai 2" name="lantai2" id="lantai2" value="{{ old('lantai2') }}" required>
                        @error('lantai2')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Keterangan Lantai</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('ket_lantai') is-invalid @enderror" placeholder="Keterangan Lantai" name="ket_lantai" id="ket_lantai" value="{{ old('kode') }}" required>
                        @error('ket_lantai')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Tarif</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('tarif') is-invalid @enderror" placeholder="Tarif" name="tarif" id="tarif" value="{{ old('tarif') }}" required>
                        @error('tarif')
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
            <form action="{{ route('admin.tarifbangunan.delete') }}" method="POST" enctype="multipart/form-data">
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