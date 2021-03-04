@extends('admin.layout.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                {{-- <div class="card-header">
                    <h3 class="card-title">
                        <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus"></i> Tambah</a>
                    </h3>
                </div> --}}
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped datatable yajra-datatable" style="width: 100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Kelurahan</th>
                                <th>Kecamatan</th>
                                <th>Kabupaten</th>
                                <th>Provinsi</th>
                                <th>Kode Pos</th>
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
            ajax: "{{ route('admin.kodepos.index') }}",
            columns: [
                { data: 'id', name: 'id'},
                { data: 'kelurahan', name: 'kelurahan'},
                { data: 'kecamatan', name: 'kecamatan' },
                { data: 'kabupaten', name: 'kabupaten' },
                { data: 'provinsi', name: 'provinsi' },
                { data: 'kodepos', name: 'kodepos' },
            ]
        });
    });
</script>
@endsection