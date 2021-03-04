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
                                <th>Kode Kab</th>
                                <th>Kode Kec</th>
                                <th>Kode Desa</th>
                                <th>Kode Blok</th>
                                <th>Jalan</th>
                                <th>Kode Zona</th>
                                <th>NJOP</th>
                                <th>NPASAR</th>
                                <th>Status</th>
                                <th>Udpate</th>
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
            ajax: "{{ route('admin.tariftanah.index') }}",
            columns: [
                { data: 'kdkab', name: 'kdkab'},
                { data: 'kdkec', name: 'kdkec'},
                { data: 'kddesa', name: 'kddesa'},
                { data: 'kdblok', name: 'kdblok'},
                { data: 'jalan', name: 'jalan'},
                { data: 'kdzona', name: 'kdzona'},
                { data: 'njop', name: 'njop', className: 'text-right'},
                { data: 'npasar', name: 'npasar', className: 'text-right'},
                { data: 'status', name: 'status' },
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
                url: "{{ route('admin.tariftanah.data') }}",
                type: "POST",
                dataType: "JSON",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    $("#kdkab").val(data.kdkab);
                    $("#kdkec").val(data.kdkec);
                    $("#kddesa").val(data.kddesa);
                    $("#kdblok").val(data.kdblok);
                    $("#jalan").val(data.jalan);
                    $("#kdzona").val(data.kdzona);
                    $("#njop").val(data.njop);
                    $("#npasar").val(data.npasar);
                    $("#status").val(data.status);
                    $("#id").val(data.id_tarif);
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
            <form action="{{ route('admin.tariftanah.create') }}" method="POST">
                @csrf
                <div class="input-group">
                    <label>Kode Kabupaten</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('kdkab') is-invalid @enderror" placeholder="Kode Kabupaten" name="kdkab" value="{{ old('kdkab') }}" required>
                        @error('kdkab')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Kode Kecamatan</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('kdkec') is-invalid @enderror" placeholder="Kode Kecamatan" name="kdkec" value="{{ old('kdkec') }}" required>
                        @error('kdkec')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Kode Desa</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('kddesa') is-invalid @enderror" placeholder="Kode Desa" name="kddesa" value="{{ old('kddesa') }}" required>
                        @error('kddesa')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Kode Blok</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('kdblok') is-invalid @enderror" placeholder="Kode Blok" name="kdblok" value="{{ old('kdblok') }}" required>
                        @error('kdblok')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Jalan</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('jalan') is-invalid @enderror" placeholder="Jalan" name="jalan" value="{{ old('jalan') }}" required>
                        @error('jalan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Kode Zona</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('kdzona') is-invalid @enderror" placeholder="Kode Zona" name="kdzona" value="{{ old('kdzona') }}" required>
                        @error('kdzona')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>NJOP</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('njop') is-invalid @enderror" placeholder="NJOP" name="njop" value="{{ old('njop') }}" required>
                        @error('njop')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>NPASAR</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('npasar') is-invalid @enderror" placeholder="NPASAR" name="npasar" value="{{ old('npasar') }}" required>
                        @error('npasar')
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
            <form action="{{ route('admin.tariftanah.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="input-group">
                    <label>Kode Kabupaten</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('kdkab') is-invalid @enderror" placeholder="Kode Kabupaten" name="kdkab" id="kdkab" value="{{ old('kdkab') }}" required>
                        @error('kdkab')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Kode Kecamatan</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('kdkec') is-invalid @enderror" placeholder="Kode Kecamatan" name="kdkec" id="kdkec" value="{{ old('kdkec') }}" required>
                        @error('kdkec')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Kode Desa</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('kddesa') is-invalid @enderror" placeholder="Kode Desa" name="kddesa" id="kddesa" value="{{ old('kddesa') }}" required>
                        @error('kddesa')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Kode Blok</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('kdblok') is-invalid @enderror" placeholder="Kode Blok" name="kdblok" id="kdblok" value="{{ old('kdblok') }}" required>
                        @error('kdblok')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Jalan</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('jalan') is-invalid @enderror" placeholder="Jalan" name="jalan" id="jalan" value="{{ old('jalan') }}" required>
                        @error('jalan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Kode Zona</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('kdzona') is-invalid @enderror" placeholder="Kode Zona" name="kdzona" id="kdzona" value="{{ old('kdzona') }}" required>
                        @error('kdzona')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>NJOP</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('njop') is-invalid @enderror" placeholder="NJOP" name="njop" id="njop" value="{{ old('njop') }}" required>
                        @error('njop')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>NPASAR</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('npasar') is-invalid @enderror" placeholder="NPASAR" name="npasar" id="npasar" value="{{ old('npasar') }}" required>
                        @error('npasar')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <label>Status</label>
                    <div class="input-group">
                        <select class="form-control @error('status') is-invalid @enderror" name="status" id="status" value="{{ old('status') }}" required>
                            <option value="0">Non Aktif</option>
                            <option value="1">Aktif</option>
                        </select>
                        @error('status')
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
            <form action="{{ route('admin.tariftanah.delete') }}" method="POST" enctype="multipart/form-data">
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