<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-green">
            <div class="panel-heading">
                <?php echo 'Daftar ' . $judul ?>&nbsp;&nbsp;
                <button class="btn btn-info" data-toggle="modal" data-target="#tambah_pegawai">
                    <i class="fa fa-user"></i> Tambah <?php echo $judul ?>
                </button>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr>
                        <th>NIK</th>
                        <th>Nama Pegawai</th>
                        <th>Action</th>
                    </tr>
                    </thead>
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
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<div class="modal fade" id="tambah_pegawai" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" action="<?php echo base_url('home/tambah_pegawai') ?>" method="post"
                  enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
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
                        <input class="form-control" type="text" name="password" required>
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
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
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
                        <input class="form-control" type="text" name="ubah_password" id="ubah_password" required>
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
<!--
<div class="modal fade" id="ubah_file_surat_masuk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" action="<?php //echo base_url('home/ubah_file_surat_masuk') ?>" method="post"
                  enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center" id="myModalLabel">Ubah File <?php //echo $judul ?></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="ubah_file_surat" id="ubah_file_surat">
                    <div class="form-group">
                        <label>File Surat</label>
                        <input class="form-control" type="file" accept="application/pdf" name="ubah_file_surat"
                               required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button>
                    <input type="submit" value="Ubah File <?php //echo $judul ?>" name="submit" class="btn btn-success">
                </div>
            </form>
        </div>-->
        <!-- /.modal-content -->
    <!--</div>
    <!-- /.modal-dialog -->
<!--</div>-->
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
    function ubah_pegawai(id_pegawai) {
        $('#ubah_id_pegawai').empty();
        $('#ubah_nik').empty();
        $('#ubah_nama_pegawai').empty();
        $('#ubah_password').empty();
        

        $.getJSON('<?php echo base_url('home/get_pegawai_by_id/')?>' + id_pegawai, function (data) {
            $('#ubah_id_pegawai').val(data.id_pegawai);
            $('#ubah_nik').val(data.nik);
            $('#ubah_nama_pegawai').val(data.nama_pegawai);
            $('#ubah_password').val(data.password);
            
        })
    }
</script>