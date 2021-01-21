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
                    <table class="table table-bordered table-hover table-striped datatable yajra-datatable">
                        <thead>
                            <tr>
                                <th>Kode Billing</th>
                                <th>ID Transaksi</th>
                                <th>Nama WP</th>
                                <th>NOP</th>
                                <th>Jenis Transaksi</th>
                                <th>Status</th>
                                <th>Kadaluarsa</th>
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
                { data: 'kode_billing', name: 'kode_billing'},
                { data: 'id_transaksi', name: 'id_transaksi'},
                { data: 'nama_wp', name: 'nama_wp' },
                { data: 'nop', name: 'nop' },
                { data: 'jenis_transaksi', name: 'jenis_transaksi' },
                { data: 'status', name: 'status' },
                { data: 'kadaluarsa', name: 'kadaluarsa' },
                { data: 'action', name: 'action', orderable: false, searchable: true },
            ]
        });
    });
</script>
@endsection