<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Sistem Informasi Inventaris Berita Acara Lelang</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url() ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url() ?>css/sb-admin-2.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url() ?>assets/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url() ?>assets/vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="<?php echo base_url() ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- DataTable Button CSS -->
    <link href="<?php echo base_url() ?>assets/vendor/datatables/css/buttons.dataTables.min.css" rel="stylesheet">
    <script src="<?php echo base_url() ?>assets/dist/js/jquery-3-3-1.min.js"></script>
    <script type="text/JavaScript">
        function pemberitahuandatainput(){
            $.ajax({
                type:"POST",
                url:"<?php echo base_url()?>home/hitunginputdatabaru",
                dataType:'json',
                success:function(response){
                    $("#lelangbaru").text(""+response+"");
                    $("#lelangbaruisi").text(""+response+"");
                    timer = setTimeout("pemberitahuandatainput()",1000);
                }
            });
        }
        $(document).ready(function(){
            pemberitahuandatainput();
        });
    </script>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-envelope"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SINBALANG </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <?php
      if ($this->session->userdata('nama_jabatan') == 'LPSE') {
        echo '
          <!-- Nav Item - Dashboard -->
          <li class="nav-item active">
            <a class="nav-link" href="' . base_url('home') . '">
              <i class="fas fa-fw fa-tachometer-alt"></i>
              <span>Dashboard</span></a>
          </li>

          <!-- Divider -->
          <hr class="sidebar-divider">

          <!-- Heading -->
          <div class="sidebar-heading">
            Tabel
          </div>

          <!-- Nav Item - Charts -->
          <li class="nav-item">
            <a class="nav-link" href="' . base_url('home/disposisi_keluar') . '">
              <i class="fas fa-fw fa-table"></i>
              <span>Data Lelang</span></a>
          </li>

          <!-- Nav Item - Tables -->
          <li class="nav-item">
            <a class="nav-link" href="' . base_url('home/pegawai') . '">
              <i class="fas fa-fw fa-user"></i>
              <span>Pegawai</span></a>
          </li>
        ';
      } else {
        echo '
          <!-- Nav Item - Dashboard -->
          <li class="nav-item active">
            <a class="nav-link" href="' . base_url('home') . '">
              <i class="fas fa-fw fa-tachometer-alt"></i>
              <span>Dashboard</span></a>
          </li>

          <!-- Divider -->
          <hr class="sidebar-divider">

          <!-- Heading -->
          <div class="sidebar-heading">
            Tabel
          </div>

          <!-- Nav Item - Charts -->
          <li class="nav-item">
            <a class="nav-link" href="' . base_url('home/data_lelang') . '">
              <i class="fas fa-fw fa-table"></i>
              <span>Data Lelang</span></a>
          </li>
        ';
      }
      ?>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <div class="sidebar-brand-text mx-3">SEKRETARIAT DAERAH BAGIAN ADMINISTRASI PEMBANGUNAN KOTA SURAKARTA </div>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <?php
            if ($this->session->userdata('nama_jabatan') == 'LPSE') {
                echo'
                  <!-- Nav Item - Alerts -->
                  <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-bell fa-fw"></i>
                      <!-- Counter - Alerts -->
                      <span class="badge badge-danger badge-counter" id="lelangbaru"></span>
                    </a>
                    <!-- Dropdown - Alerts -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                      <h6 class="dropdown-header">
                        Pemberitahuan
                      </h6>
                      <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="mr-3">
                          <div class="icon-circle bg-primary">
                            <i class="fas fa-file-alt text-white"></i>
                          </div>
                        </div>
                        <div>
                          <div class="small text-gray-500">Data input baru</div>
                          <span class="font-weight-bold" id="lelangbaruisi"></span>
                        </div>
                      </a>
                      
                    </div>
                  </li>
                ';
            }
            ?>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                    <?php echo $this->session->userdata('nama_pegawai'); ?>
                </span>
                <img class="img-profile rounded-circle" src="http://pixsector.com/cache/94bed8d5/av3cbfdc7ee86dab9a41d.png">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal" href="<?php echo base_url('login/logout') ?>">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Keluar
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?php echo $judul;
                            if (isset($data_surat->tgl_kirim))
                                echo ' Tanggal ' . $data_surat->tgl_kirim
                            ?></h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <?php
                $notif = $this->session->flashdata('notif');
                if ($notif != null) {
                    echo '
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-info alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                ' . $notif . '
                            </div>                
                        </div>
                    </div>
                    ';
                }
                ?>
                <?php $this->load->view($main_view); ?>
            </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Bramastya 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Keluar</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Apakah Anda yakin ingin keluar?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
          <a class="btn btn-primary" href="<?php echo base_url('login/logout') ?>">Keluar</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url() ?>vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url() ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url() ?>vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url() ?>js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="<?php echo base_url() ?>vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?php echo base_url() ?>js/demo/chart-area-demo.js"></script>
  <script src="<?php echo base_url() ?>js/demo/chart-pie-demo.js"></script>
  <script src="<?php echo base_url() ?>js/demo/chart-bar-demo.js"></script>

  <!-- Page level plugins -->
  <script src="<?php echo base_url() ?>vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url() ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?php echo base_url() ?>js/demo/datatables-demo.js"></script>

  <!-- Metis Menu Plugin JavaScript -->
  <script src="<?php echo base_url() ?>assets/vendor/metisMenu/metisMenu.min.js"></script>

  <!-- Morris Charts JavaScript -->
  <script src="<?php echo base_url() ?>assets/vendor/raphael/raphael.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/morrisjs/morris.min.js"></script>
  <script src="<?php echo base_url() ?>assets/data/morris-data.js"></script>
<!-- Page-Level Demo Scripts - Tables - Use for reference -->
  <!-- DataTables JavaScript -->
  <script src="<?php echo base_url() ?>assets/vendor/datatables/js/dataTables.buttons.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/datatables/js/buttons.flash.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/datatables/js/jszip.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/datatables/js/pdfmake.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/datatables/js/vfs_fonts.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/datatables/js/buttons.html5.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/datatables/js/buttons.print.min.js"></script>
<script>
    $(document).ready(function () {
        $('#dataTables-example').DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>

</body>

</html>
