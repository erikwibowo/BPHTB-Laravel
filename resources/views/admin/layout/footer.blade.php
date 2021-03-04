<footer class="main-footer">
    <div class="modal fade" id="modal-logout">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Keluar</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Apakah anda yakin akankeluar dari sistem?</p>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            <a href="{{ route('admin.logout') }}" type="button" class="btn btn-danger">Keluar</a>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <div class="modal" id="modal-loading">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title">Sedang memuat data...</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <center>
              <img src="{{ asset('loading.gif') }}" class="img">
            </center>
          </div>
        </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>
    <strong>Copyright &copy; 2020-{{ date('Y') }} <a href="https://sebamitradata.com" target="_blank">SEBA MITRADATA</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Versi</b> 2.0.0
    </div>
  </footer>