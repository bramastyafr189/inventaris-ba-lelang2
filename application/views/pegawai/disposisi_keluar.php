          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">
                
              </h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <th>Tanggal Kirim</th>
                        <th>Nama Pengirim</th>
                        <th>OPD</th>
                        <th>Paket</th>
                        <th>Pagu</th>
                        <th>HPS</th>
                        <th>Nama Kepanitiaan</th>
                        <th>No Kepanitiaan</th>
                        <th>Nama CP</th>
                        <th>Telp CP</th>
                        <th>Aksi</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                        <th>Tanggal Kirim</th>
                        <th>Nama Pengirim</th>
                        <th>OPD</th>
                        <th>Paket</th>
                        <th>Pagu</th>
                        <th>HPS</th>
                        <th>Nama Kepanitiaan</th>
                        <th>No Kepanitiaan</th>
                        <th>Nama CP</th>
                        <th>Telp CP</th>
                        <th>Aksi</th>
                    </tr>
                  </tfoot>
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
              </div>
            </div>
          </div>