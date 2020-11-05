<div class="row">
    <div class="col-lg-6 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $jumlah_pegawai['pegawai'] ?></div>
                        <div>Pegawai</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo base_url('home/pegawai') ?>">
                <div class="panel-footer">
                    <span class="pull-left">Daftar Pegawai</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-6 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-envelope fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $jumlah_surat['data_lelang'] ?></div>
                        <div>Data Lelang</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo base_url('home/data_lelang') ?>">
                <div class="panel-footer">
                    <span class="pull-left">Daftar Data Lelang</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- /.row -->