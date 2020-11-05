<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-red">
            <div class="panel-heading">
                <?php echo 'Daftar ' . $judul ?>&nbsp;&nbsp;
                
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr>
                        <!-- <th>Nomor Surat</th> -->
                        <th>Tanggal Kirim</th>
                        <!-- <th>Tujuan</th>
                        <th>Perihal</th> -->
                        <th>Nama Pengirim</th>
                        <th>OPD</th>
                        <th>Paket</th>
                        <th>Pagu</th>
                        <th>HPS</th>
                        <th>Nama Kepanitiaan</th>
                        <th>No Kepanitiaan</th>
                        <th>Nama CP</th>
                        <th>Telp CP</th>

                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (isset($data_data_lelang)) {
                        foreach ($data_data_lelang as $data_lelang) {
                            echo '
                            <tr>
                                
                                <td class="text-center" style="vertical-align: middle;">' . $data_lelang->tgl_kirim . '</td>
                                <td class="text-center" style="vertical-align: middle;">' . $data_lelang->nama_pengirim . '</td>
                                <td class="text-center" style="vertical-align: middle;">' . $data_lelang->opd . '</td>
                                <td class="text-center" style="vertical-align: middle;">' . $data_lelang->paket . '</td>
                                <td class="text-center" style="vertical-align: middle;">' . $data_lelang->pagu . '</td>
                                <td class="text-center" style="vertical-align: middle;">' . $data_lelang->hps . '</td>
                                <td class="text-center" style="vertical-align: middle;">' . $data_lelang->nama_kepanitiaan . '</td>
                                <td class="text-center" style="vertical-align: middle;">' . $data_lelang->no_kepanitiaan . '</td>
                                <td class="text-center" style="vertical-align: middle;">' . $data_lelang->nama_cp . '</td>
                                <td class="text-center" style="vertical-align: middle;">' . $data_lelang->telp_cp . '</td>

                                <td class="text-center" style="vertical-align: middle;">
                                    <a href="' . base_url('uploads/' . $data_lelang->file_surat) . '" class="btn btn-info btn-sm">Lihat</a>
                                    
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