          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">
                <button class="btn btn-warning" data-toggle="modal" data-target="#tambah_pegawai">
                    <i class="fa fa-user"></i> Tambah <?php echo $judul ?>
                </button>
              </h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <th>NIK</th>
                        <th>Nama Pegawai</th>
                        <th>Aksi</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                        <th>NIK</th>
                        <th>Nama Pegawai</th>
                        <th>Aksi</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php
                    if (isset($data_pegawai)) {
                        foreach ($data_pegawai as $pegawai) {
                            echo '
                            <tr>
                                <td class="text-center" style="vertical-align: middle;">' . $pegawai->nik . '</td>
                                <td class="text-center" style="vertical-align: middle;">' . $pegawai->nama_pegawai . '</td>
                                
                                <td class="text-center" style="vertical-align: middle;">
                                    
                                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#ubah_pegawai" onclick="ubah_pegawai(' . $pegawai->id_pegawai . ')">Ubah</button>
                                    
                                    <a href="' . base_url('home/hapus_pegawai/' . $pegawai->id_pegawai) . '" onClick="return doconfirm();" class="btn btn-sm btn-danger">Hapus</a>
                                </td>
                            </tr>
                            ';
                        }
                    }
                    ?>
                  </tbody>
                </table>
              </div>
<div class="modal fade" id="tambah_pegawai" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" action="<?php echo base_url('home/tambah_pegawai') ?>" method="post"
                  enctype="multipart/form-data">
                <div class="modal-header">
                    
                    <h4 class="modal-title text-center" id="myModalLabel">Tambah <?php echo $judul ?></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>NIK</label>
                        <input class="form-control" type="text" name="nik" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Pegawai</label>
                        <input class="form-control" type="text" name="nama_pegawai" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input class="form-control" type="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input class="form-control" type="password" name="confirm_password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button>
                    <input type="submit" value="Tambah <?php echo $judul ?>" name="submit" class="btn btn-success">
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="ubah_pegawai" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" action="<?php echo base_url('home/ubah_pegawai') ?>" method="post"
                  enctype="multipart/form-data">
                <div class="modal-header">
                    
                    <h4 class="modal-title text-center" id="myModalLabel">Ubah <?php echo $judul ?></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="ubah_id_pegawai" id="ubah_id_pegawai">
                    <div class="form-group">
                        <label>NIK</label>
                        <input class="form-control" type="text" name="ubah_nik" id="ubah_nik" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Pegawai</label>
                        <input class="form-control" type="text" name="ubah_nama_pegawai" id="ubah_nama_pegawai" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input class="form-control" type="password" name="ubah_password" id="ubah_password" required>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input class="form-control" type="password" name="ubah_confirm_password" required>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button>
                    <input type="submit" value="Ubah <?php echo $judul ?>" name="submit" class="btn btn-success">
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

            <script>
            function doconfirm()
            {
                job=confirm("Data akan dihapus?");
                if(job!=true)
                {
                    return false;
                }
            }
            </script>
            <script>
                function ubah_surat(id_surat) {
                    $('#ubah_id_surat').empty();
                    // $('#ubah_nomor_surat').empty();
                    $('#ubah_tgl_kirim').empty();
                    // $('#ubah_tujuan').empty();
                    // $('#ubah_perihal').empty();
                    $('#ubah_nama_pengirim').empty();
                    $('#ubah_opd').empty();
                    $('#ubah_paket').empty();
                    $('#ubah_pagu').empty();
                    $('#ubah_hps').empty();
                    $('#ubah_nama_kepanitiaan').empty();
                    $('#ubah_no_kepanitiaan').empty();
                    $('#ubah_nama_cp').empty();
                    $('#ubah_telp_cp').empty();
                    $('#ubah_file_surat').empty();

                    $.getJSON('<?php echo base_url('home/get_data_lelang_by_id/')?>' + id_surat, function (data) {
                        $('#ubah_id_surat').val(data.id_surat);
                        // $('#ubah_nomor_surat').val(data.nomor_surat);
                        $('#ubah_tgl_kirim').val(data.tgl_kirim);
                        // $('#ubah_tujuan').val(data.tujuan);
                        // $('#ubah_perihal').val(data.perihal);
                        $('#ubah_nama_pengirim').val(data.nama_pengirim);
                        $('#ubah_opd').val(data.opd);
                        $('#ubah_paket').val(data.paket);
                        $('#ubah_pagu').val(data.pagu);
                        $('#ubah_hps').val(data.hps);
                        $('#ubah_nama_kepanitiaan').val(data.nama_kepanitiaan);
                        $('#ubah_no_kepanitiaan').val(data.no_kepanitiaan);
                        $('#ubah_nama_cp').val(data.nama_cp);
                        $('#ubah_telp_cp').val(data.telp_cp);
                        $('#ubah_file_surat').val(data.id_surat);
                    })
                }
            </script>
            <script>
                function ubah_pegawai(id_pegawai) {
                    $('#ubah_id_pegawai').empty();
                    $('#ubah_nik').empty();
                    $('#ubah_nama_pegawai').empty();
                    $('#ubah_password').empty();
                    

                    $.getJSON('<?php echo base_url('home/get_pegawai_by_id/')?>' + id_pegawai, function (data) {
                        $('#ubah_id_pegawai').val(data.id_pegawai);
                        $('#ubah_nik').val(data.nik);
                        $('#ubah_nama_pegawai').val(data.nama_pegawai);
                        //$('#ubah_password').val(data.password);
                        
                    })
                }
            </script>
            </div>
          </div>