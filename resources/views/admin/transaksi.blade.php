@extends('admin.layout.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                {{-- <div class="card-header">
                    <div class="card-title">
                        <select class="form-control" id="tahuns">
                            <option {{ Request::input('tahun') == '2020' ? 'selected':'' }} value="2020">Tahun 2020</option>
                            <option {{ Request::input('tahun') == '2021' ? 'selected':'' }} value="2021">Tahun 2021</option>
                        </select>
                    </div>
                </div> --}}
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
                                <th>Tahun</th>
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
                { data: 'nilai_transaksi', name: 'nilai_transaksi', className: 'text-right' },
                { data: 'dibuat', name: 'dibuat' },
                { data: 'tahun', name: 'tahun', className: 'text-center' },
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
                url: "{{ route('admin.transaksi.datarincitransaksi') }}",
                type: "POST",
                dataType: "JSON",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data){
                    //console.log(data);
                    $('#modal-edit').modal({backdrop: 'static', keyboard: false});
                    $('#modal-edit').modal('show');
                    $('.modal-title').text("Rincian Transaksi BPHTB : "+id+" ("+data[0].tgl_trans+")");
                    $('#nik_wp').val(data[0].nik_wp);
                    $('#npwp').val(data[0].npwp);
                    $('#nama_wp').val(data[0].nama_wp);
                    $('#tgl_lahir_wp').val(data[0].tgl_lahir_wp);
                    $('#pekerjaan_wp').val(data[0].pekerjaan_wp);
                    $('#alamat_wp').val(data[0].alamat_wp);
                    $('#blok_wp').val(data[0].blok_wp);
                    $('#desa_wp').val(data[0].desa_wp);
                    $('#kec_wp').val(data[0].kec_wp);
                    $('#kab_wp').val(data[0].kab_wp);
                    $('#kodepos_wp').val(data[0].kodepos_wp);
                    $('#telp_wp').val(data[0].telp_wp);
                    $('#email_wp').val(data[0].email_wp);
                    $('#jenis_transaksi').val(data[0].jenis_transaksi);
                    $('#nilai_transaksi').val(data[0].nilai_transaksi);
                    $('#njoptkp').val(data[0].njoptkp);
                    $('#njkp').val(data[0].njkp);
                    $('#bphtb').val(data[0].bphtb);
                    if (data[0].dikuasakan == "1") {
                        $('#dikuasakan').val("Ya");
                        $('#petugas-ppat').show(400);
                        $('#nama_petugas_ppat').val(data[0].nama_petugas_ppat);
                        $('#umur_petugas_ppat').val(data[0].umur_petugas_ppat);
                        $('#pekerjaan_petugas_ppat').val(data[0].pekerjaan_petugas_ppat);
                        $('#alamat_petugas_ppat').val(data[0].alamat_petugas_ppat);
                        $('#no_hp_petugas_ppat').val(data[0].no_hp_petugas_ppat);
                    }else{
                        $('#dikuasakan').val("Tidak");
                        $('#petugas-ppat').hide(400);
                    }
                    $('#nama_ppat').val(data[0].nama_ppat);
                    $('#no_sertifikat_tanah').val(data[0].no_sertifikat_tanah);
                    $('#nop').val(data[0].nop);
                    $('#desa_op').val(data[0].desa_op);
                    $('#kec_op').val(data[0].kec_op);
                    $('#alamat_op').val(data[0].alamat_op);
                    $('#luas_tanah').val(data[0].luas_tanah);
                    $('#njop_tanah').val(data[0].njop_tanah);
                    $('#luas_bangunan').val(data[0].luas_bangunan);
                    $('#njop_bangunan').val(data[0].njop_bangunan);
                    $('#nama_wp_trans').val(data[0].nama_wp_trans);
                    $('#alamat_wp_trans').val(data[0].alamat_wp_trans);
                },
            });
        });
        $(document).on("click", '.btn-delete', function() {
            let id = $(this).attr("data-id");
            let name = $(this).attr("data-name");
            $("#did").val(id);
            $("#delete-data").html(id);
            $('#modal-delete').modal('show');
            $('#modal-delete').modal({
                backdrop: 'static',
                keyboard: false
            });
        });
        $(document).on("click", '.btn-restore', function() {
            let id = $(this).attr("data-id");
            let name = $(this).attr("data-name");
            $("#dir").val(id);
            $("#restore-data").html(id);
            $('#modal-restore').modal('show');
            $('#modal-restore').modal({
                backdrop: 'static',
                keyboard: false
            });
        });
        $(document).on("click", '.btn-riwayat', function() {
            let id = $(this).attr("data-id");
            $("#riwayat-data").html(id);
            get_riwayat(id);

        });

        function get_riwayat(id){
            $.ajax({
                url: "{{ route('admin.riwayattransaksi.databytransaksi') }}",
                type: "POST",
                dataType: "JSON",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    let html = ``;
                    for (let i = 0; i < data.length; i++) {
                        html += `
                        <div>
                            <i class="fas fa-clock bg-green"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fas fa-clock"></i> ${data[i].dibuat}</span>
                                <h3 class="timeline-header no-border"><a href="#">${data[i].oleh}</a> ${data[i].riwayat_transaksi}</h3>
                                <div class="timeline-footer btn-group">
                                    <a onclick="return confirm('Hahahahaah')" class="btn btn-primary btn-xs">Edit</a>
                                    <a onclick="return confirm('Hahahahaah')" class="btn btn-danger btn-xs">Hapus</a>
                                </div>
                            </div>
                        </div>
                        `;                        
                    }
                    $("#timeline").html(html);
                    $('#modal-riwayat').modal('show');
                    $('#modal-riwayat').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                },
            });
        }
        // $("#tahuns").on("change", function(){
        //     var tahun = $(this).val();
        //     window.location = '{{ URL::current() }}'+'?tahun='+tahun;
        // });
    });
</script>
<!-- Modal Rinci -->
<div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" role="form" class="form-horizontal" data-toggle="validator" method="post" accept-charset="utf-8">
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9">
                        <label class="badge badge-primary p-2">INFORMASI PEMOHON</label>
                        </div>
                    </div>
                    <div class="info-wp-num">
                    <div class="input-group row mb-1">
                        <label class="col-sm-3 col-form-label">NIK</label>
                        <div class="col-sm-9">
                            <input type="text" id="nik_wp" value="" readonly placeholder="Masukkan NIK" class="form-control">
                        </div>
                    </div>
                    <div class="input-group row mb-1">
                        <label class="col-sm-3 col-form-label">NPWP</label>
                        <div class="col-sm-9">
                            <input type="text" id="npwp" value="" readonly placeholder="Masukkan NPWP" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">NAMA WP</label>
                    <div class="col-sm-9">
                        <input type="text" id="nama_wp" value="" readonly placeholder="Masukkan Nama Wajib Pajak" class="form-control">
                    </div>
                </div>
                <div id="info-wp">
                    <div class="input-group row mb-1">
                        <label class="col-sm-3 col-form-label">TANGGAL LAHIR WP</label>
                        <div class="col-sm-9">
                            <input type="text" id="tgl_lahir_wp" value="" required readonly placeholder="Tanggal Lahir" class="form-control">
                    </div>
                    </div>
                    <div class="input-group row mb-1">
                        <label class="col-sm-3 col-form-label">PEKERJAAN WP</label>
                        <div class="col-sm-9">
                            <input type="text" id="pekerjaan_wp" readonly value="" required readonly placeholder="Pekerjaan" class="form-control">
                        </div>
                    </div>
                    <div class="input-group row mb-1">
                        <label class="col-sm-3 col-form-label">ALAMAT WP</label>
                        <div class="col-sm-9">
                            <textarea readonly id="alamat_wp" placeholder="Masukkan Alamat WP" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="input-group row mb-1">
                        <label class="col-sm-3 col-form-label">BLOK/KAV/NOMOR</label>
                        <div class="col-sm-9">
                            <input readonly id="blok_wp" value="" type="text" placeholder="BLOK/KAV/NOMOR" class="form-control">
                        </div>
                    </div>
                    <div class="input-group row mb-1">
                        <label class="col-sm-3 col-form-label">KELURAHAN/DESA WP</label>
                        <div class="col-sm-9">
                            <input readonly id="desa_wp" type="text" value="" placeholder="KELURAHAN/DESA" class="form-control">
                        </div>
                    </div>
                    <div class="input-group row mb-1">
                        <label class="col-sm-3 col-form-label">KECAMATAN WP</label>
                        <div class="col-sm-9">
                            <input readonly id="kec_wp" type="text" value="" placeholder="KECAMATAN" class="form-control">
                        </div>
                    </div>
                    <div class="input-group row mb-1">
                        <label class="col-sm-3 col-form-label">KAB/KOTA WP</label>
                        <div class="col-sm-9">
                            <input readonly id="kab_wp" type="text" value="" placeholder="KAB/KOTA" class="form-control">
                        </div>
                    </div>
                    <div class="input-group row mb-1">
                        <label class="col-sm-3 col-form-label">KODE POS WP</label>
                        <div class="col-sm-9">
                            <input readonly id="kodepos_wp" type="text" value="" placeholder="KODE POS" class="form-control">
                        </div>
                    </div>
                    <div class="input-group row mb-1">
                        <label class="col-sm-3 col-form-label">NO. TELEPON WP</label>
                        <div class="col-sm-9">
                            <input readonly id="telp_wp" type="text" value="" placeholder="NO. TELEPON" class="form-control">
                        </div>
                    </div>
                    <div class="input-group row mb-1">
                        <label class="col-sm-3 col-form-label">EMAIL WP</label>
                        <div class="col-sm-9">
                            <input readonly id="email_wp" type="text" value="" placeholder="EMAIL" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9">
                        <a href="#" class="btn btn-success btn-sm btnaction">Detail</a>
                        <script type="text/javascript">
                            $(document).ready(function(){
                                $('#info-wp').hide(400);
                                $('.info-wp-num').hide(400);
                                $('.btnaction').on('click', function() {
                                    if ($('.btnaction').text() == "Detail") {
                                        $('#info-wp').show(400);
                                        $('.info-wp-num').show(400);
                                        $('.btnaction').text("Sembunyikan");
                                    }else{
                                        $('#info-wp').hide(400);
                                        $('.info-wp-num').hide(400);
                                        $('.btnaction').text("Detail");
                                    }
                                });
                            });
                        </script>
                    </div>
                </div>
                <div class="input-group row mb-3">
                    <label class="col-sm-3 col-form-label">NOP</label>
                    <div class="col-sm-9">
                        <input type="text" maxlength="18" id="nop" readonly required placeholder="Masukkan NOP. Contoh : 3326xxxxxxxxxxxxxx" class="form-control">
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9">
                            <label class="badge badge-primary p-2">LETAK OBJEK PAJAK</label>
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">DESA/KELURAHAN</label>
                    <div class="col-sm-9">
                        <input type="text" id="desa_op" required readonly placeholder="Desa/Kelurahan Objek Pajak" class="form-control">
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">KECAMATAN</label>
                    <div class="col-sm-9">
                        <input type="text" id="kec_op" required readonly placeholder="Kecamatan Objek Pajak" class="form-control">
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">ALAMAT OBJEK PAJAK</label>
                    <div class="col-sm-9">
                        <textarea id="alamat_op" required readonly placeholder="Alamat Objek Pajak" class="form-control"></textarea>
                    </div>
                </div><div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">LUAS TANAH (M<sup>2</sup>)</label>
                    <div class="col-sm-9">
                        <input type="text" id="luas_tanah" required readonly placeholder="Luas Tanah Objek Pajak" class="form-control">
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">NJOP TANAH</label>
                    <div class="col-sm-9">
                        <input type="text" id="njop_tanah" readonly name="njop_tanah" required placeholder="NJOP TANAH" class="form-control">
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">LUAS BANGUNAN (M<sup>2</sup>)</label>
                    <div class="col-sm-9">
                        <input type="text" id="luas_bangunan" required readonly placeholder="Luas bangunan Objek Pajak" class="form-control">
                    </div>
                </div>
                <div class="input-group row mb-3">
                    <label class="col-sm-3 col-form-label">NJOP BANGUNAN</label>
                    <div class="col-sm-9">
                        <input type="text" id="njop_bangunan" readonly name="njop_bangunan" required placeholder="NJOP BANGUNAN" class="form-control">
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9">
                        <label class="badge badge-primary p-2">TRANSAKSI</label>
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">JENIS TRANSAKSI</label>
                    <div class="col-sm-9">
                        <input readonly id="jenis_transaksi" type="text" value="" placeholder="Jenis Transaksi" class="form-control">
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">NILAI TRANSAKSI</label>
                    <div class="col-sm-9">
                        <input type="text" id="nilai_transaksi" readonly name="nilai_transaksi" required placeholder="Ketikkan Nilai Transaksi" class="form-control">
                    </div>
                </div>
                <script type="text/javascript">
                    $(document).ready(function(){
                        $('#nilai_transaksi').on('input', function() {
                            var nilai_transaksi = $('#nilai_transaksi').val();
                            var njoptkp = $('#njoptkp').val();
                            var njkp = nilai_transaksi-njoptkp;
                            if (njkp <= 0) {
                                $('#njkp').val(0);
                                $('#bphtb').val(0);
                            }else{
                                $('#njkp').val(njkp);
                                $('#bphtb').val(5/100*njkp);
                            }
                        });
                    });
                </script>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">NJOPTKP</label>
                    <div class="col-sm-9">
                        <input type="text" id="njoptkp" name="njoptkp" required readonly placeholder="NJOPTKP" class="form-control">
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">NJKP</label>
                    <div class="col-sm-9">
                        <input type="text" id="njkp" name="njkp" required readonly placeholder="NJKP" class="form-control">
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">BPHTB</label>
                    <div class="col-sm-9">
                        <input type="text" id="bphtb" name="bphtb" readonly required placeholder="BPHTB" class="form-control">
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">DIKUASAKAN</label>
                    <div class="col-sm-9">
                        <input type="text" id="dikuasakan" required readonly placeholder="DIKUASAKAN" class="form-control">
                    </div>
                </div>
                <div class="input-group row mb-3">
                    <label class="col-sm-3 col-form-label">NAMA PPAT</label>
                    <div class="col-sm-9">
                        <input type="text" id="nama_ppat" readonly placeholder="NAMA PPAT" class="form-control">
                    </div>
                </div>
                <div id="petugas-ppat">
                    <div class="input-group row mb-1">
                        <label class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                            <label class="badge badge-primary p-2">DIKUASAKAN OLEH</label>
                        </div>
                    </div>
                    <div class="input-group row mb-1">
                        <label class="col-sm-3 col-form-label">NAMA</label>
                        <div class="col-sm-9">
                            <input type="text" id="nama_petugas_ppat" readonly placeholder="NAMA" class="form-control">
                        </div>
                    </div>
                    <div class="input-group row mb-1">
                        <label class="col-sm-3 col-form-label">UMUR</label>
                        <div class="col-sm-9">
                            <input type="number" id="umur_petugas_ppat" readonly placeholder="UMUR" class="form-control">
                        </div>
                    </div>
                    <div class="input-group row mb-1">
                        <label class="col-sm-3 col-form-label">PEKERJAAN</label>
                        <div class="col-sm-9">
                            <input type="text" id="pekerjaan_petugas_ppat" readonly placeholder="PEKERJAAN" class="form-control">
                        </div>
                    </div>
                    <div class="input-group row mb-1">
                        <label class="col-sm-3 col-form-label">ALAMAT</label>
                        <div class="col-sm-9">
                            <textarea id="alamat_petugas_ppat" readonly placeholder="ALAMAT" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="input-group row mb-1">
                        <label class="col-sm-3 col-form-label">NO. HP</label>
                        <div class="col-sm-9">
                            <input type="number" id="no_hp_petugas_ppat" readonly placeholder="NO. HP" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="input-group row mb-3">
                    <label class="col-sm-3 col-form-label">NOMOR SERTIFIKAT</label>
                    <div class="col-sm-9">
                        <input type="text" maxlength="18" readonly id="no_sertifikat_tanah" name="no_sertifikat_tanah" required placeholder="Nomor Sertifikat" class="form-control">
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9">
                        <label class="badge badge-primary p-2">DATA WAJIB PAJAK PBB</label>
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">NAMA WAJIB PAJAK</label>
                    <div class="col-sm-9">
                        <input type="text" id="nama_wp_trans" required readonly placeholder="Nama Wajib Pajak" class="form-control">
                    </div>
                </div>
                <div class="input-group row mb-1">
                    <label class="col-sm-3 col-form-label">ALAMAT WAJIB PAJAK</label>
                    <div class="col-sm-9">
                        <textarea id="alamat_wp_trans" required readonly placeholder="Alamat WP" class="form-control"></textarea>
                    </div>
                </div>
            </div>
            {{-- end modal body --}}
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
<!-- End of modal Rinci -->
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
            <form action="{{ route('admin.transaksi.delete') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <p class="modal-text">Apakah anda yakin akan menghapus? <b id="delete-data"></b></p>
                <input type="hidden" name="id" id="did">
                <input type="hidden" name="segment" value="{{ Request::segment(3) }}">
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
<div class="modal fade" id="modal-restore">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Restore Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.transaksi.restore') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <p class="modal-text">Apakah anda yakin akan merestore? <b id="restore-data"></b></p>
                <input type="hidden" name="id" id="dir">
                <input type="hidden" name="segment" value="{{ Request::segment(3) }}">
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-danger">Restore</button>
        </div>
        </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-riwayat">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Riwayat Transaksi <b id="riwayat-data"</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="timeline" id="timeline">
                <!-- timeline item -->
                
                <!-- END timeline item -->
              </div>
            {{-- <form action="{{ route('admin.admin.delete') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('DELETE')
                <p class="modal-text">Apakah anda yakin akan menghapus? <b id="delete-data"></b></p>
                <input type="hidden" name="id" id="did"> --}}
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
        </div>
        </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection