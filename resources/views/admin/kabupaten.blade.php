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
                                <th>ID Kabupaten</th>
                                <th>Provinsi</th>
                                <th>Kabupaten</th>
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
            ajax: "{{ route('admin.kabupaten.index') }}",
            columns: [
                { data: 'id_kabupaten', name: 'id_kabupaten'},
                { data: 'nama_provinsi', name: 'nama_provinsi'},
                { data: 'nama_kabupaten', name: 'nama_kabupaten' },
            ]
        });
    });
</script>
@endsection