<?php
/**
 * Created by PhpStorm.
 * User: doxa
 * Date: 31/01/18
 * Time: 07.22
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property  HomeModel $HomeModel
 */
class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('HomeModel');
    }

    public function index() {
        if ($this->session->userdata('logged_in') == true) {
            if ($this->session->userdata('nama_jabatan') == 'LPSE') {
                $data['judul'] = 'Selamat Datang, ' . $this->session->userdata('nama_pegawai') . '!';
                $data['jumlah_surat'] = $this->HomeModel->get_jumlah_surat();
                $data['jumlah_pegawai'] = $this->HomeModel->get_jumlah_surat();
                $data['main_view'] = 'admin/dashboard';
                $this->load->view('template', $data);
            } else {
                $data['judul'] = 'Selamat Datang, ' . $this->session->userdata('nama_pegawai') . '!';
                //$data['jumlah_disposisi'] = $this->HomeModel->get_jumlah_disposisi();
                $data['jumlah_surat'] = $this->HomeModel->get_jumlah_surat();
                $data['main_view'] = 'pegawai/dashboard';
                $this->load->view('template', $data);
            }
        } else {
            redirect('login');
        }
    }

    public function pegawai() {
        if ($this->session->userdata('logged_in') == true) {
            if ($this->session->userdata('nama_jabatan') == 'LPSE') {
                $data['judul'] = 'Pegawai';
                $data['main_view'] = 'admin/pegawai';
                $data['data_pegawai'] = $this->HomeModel->get_pegawai();
                $this->load->view('template', $data);
            } else {
                redirect('logout');
            }
        } else {
            redirect('login');
        }
    }

    public function data_lelang() {
        if ($this->session->userdata('logged_in') == true) {
            if ($this->session->userdata('nama_jabatan') == 'BLP') {
                $data['judul'] = 'Data Lelang';
                $data['main_view'] = 'admin/data_lelang';
                $data['data_data_lelang'] = $this->HomeModel->get_data_lelang();
                $this->load->view('template', $data);
            } else {
                redirect('logout');
            }
        } else {
            redirect('login');
        }
    }

    public function disposisi_selesai($id_surat) {
        if ($this->session->userdata('logged_in') == true) {
            if ($this->session->userdata('nama_jabatan') == 'BLP') {
                if ($this->HomeModel->disposisi_selesai($id_surat) == true) {
                    $this->session->set_flashdata('notif', 'Disposisi surat ini telah selesai!');
                    redirect('home/disposisi/' . $id_surat);
                } else {
                    $this->session->set_flashdata('notif', 'Gagal update status disposisi!');
                    redirect('home/disposisi/' . $id_surat);
                }
            } else {
                redirect('logout');
            }
        } else {
            redirect('login');
        }
    }

    public function disposisi($id_surat) {
        if ($this->session->userdata('logged_in') == true) {
            if ($this->session->userdata('nama_jabatan') == 'BLP') {
                $data['judul'] = 'Disposisi Surat';
                $data['main_view'] = 'admin/disposisi';
                $data['data_surat'] = $this->HomeModel->get_pegawai_by_id($id_surat);
                $data['drop_down_jabatan'] = $this->HomeModel->get_jabatan();
                $data['data_disposisi'] = $this->HomeModel->get_disposisi($id_surat);
                $this->load->view('template', $data);
            } else {
                redirect('logout');
            }
        } else {
            redirect('login');
        }
    }

    public function disposisi_keluar() {
        if ($this->session->userdata('logged_in') == true) {

            $data_lihat = $this->HomeModel->get_data_belum_baca();

            foreach($data_lihat as $ubahlihat){
                $data['status'] = 'R';

                $where = array('id_surat' => $ubahlihat->id_surat);
                $table = 'data_lelang';

                $this->HomeModel->update_data_lihat($where,$data,$table);
            }

            $data['judul'] = 'Data Lelang';
            $data['main_view'] = 'pegawai/disposisi_keluar';
            $data['data_data_lelang'] = $this->HomeModel->get_data_lelang();
            $this->load->view('template', $data);
        } else {
            redirect('login');
        }
    }

    public function disposisi_masuk() {
        if ($this->session->userdata('logged_in') == true) {
            $data['judul'] = 'Disposisi Masuk';
            $data['main_view'] = 'pegawai/disposisi_masuk';
            $data['data_disposisi_masuk'] = $this->HomeModel->get_disposisi_masuk($this->session->userdata('id_pegawai'));
            $this->load->view('template', $data);
        } else {
            redirect('login');
        }
    }

    public function disposisi_keluar_pegawai($id_surat) {
        if ($this->session->userdata('logged_in') == true) {
            $data['judul'] = 'Disposisi Keluar';
            $data['main_view'] = 'pegawai/disposisi_keluar';
            $data['data_surat'] = $this->HomeModel->get_pegawai_by_id($id_surat);
            $data['data_disposisi_keluar'] = $this->HomeModel->get_disposisi_keluar($id_surat);
            $data['drop_down_jabatan'] = $this->HomeModel->get_jabatan();
            $this->load->view('template', $data);
        } else {
            redirect('login');
        }
    }

    public function tambah_disposisi($id_surat) {
        if ($this->session->userdata('logged_in') == true) {
            if ($this->session->userdata('nama_jabatan') == 'BLP') {
                $this->form_validation->set_rules('tujuan_unit', 'Tujuan Unit', 'trim|required');
                $this->form_validation->set_rules('tujuan_pegawai', 'Tujuan Pegawai', 'trim|required');
                $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');

                if ($this->form_validation->run() == true) {
                    if ($this->HomeModel->tambah_disposisi($id_surat) == true) {
                        $this->session->set_flashdata('notif', 'Tambah disposisi surat berhasil!');
                        redirect('home/disposisi/' . $id_surat);
                    } else {
                        $this->session->set_flashdata('notif', 'Tambah disposisi surat gagal!');
                        redirect('home/disposisi/' . $id_surat);
                    }
                } else {
                    $this->session->set_flashdata('notif', validation_errors());
                    redirect('home/disposisi/' . $id_surat);
                }
            } else {
                redirect('logout');
            }
        } else {
            redirect('login');
        }
    }

    public function tambah_disposisi_pegawai($id_surat) {
        if ($this->session->userdata('logged_in') == true) {
            $this->form_validation->set_rules('tujuan_unit', 'Tujuan Unit', 'trim|required');
            $this->form_validation->set_rules('tujuan_pegawai', 'Tujuan Pegawai', 'trim|required');
            $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');

            if ($this->form_validation->run() == true) {
                if ($this->HomeModel->tambah_disposisi($id_surat) == true) {
                    $this->session->set_flashdata('notif', 'Tambah disposisi surat berhasil!');
                    redirect('home/disposisi_keluar_pegawai/' . $id_surat);
                } else {
                    $this->session->set_flashdata('notif', 'Tambah disposisi surat gagal!');
                    redirect('home/disposisi_keluar_pegawai/' . $id_surat);
                }
            } else {
                $this->session->set_flashdata('notif', validation_errors());
                redirect('home/disposisi_keluar_pegawai/' . $id_surat);
            }
        } else {
            redirect('login');
        }
    }

    public function tambah_data_lelang() {
        if ($this->session->userdata('logged_in') == true) {
            if ($this->session->userdata('nama_jabatan') == 'BLP') {
                //$this->form_validation->set_rules('nomor_surat', 'Nomor Surat', 'trim|required');
                $this->form_validation->set_rules('tgl_kirim', 'Tanggal Kirim', 'trim|required|date');
                $this->form_validation->set_rules('nama_pengirim', 'Nama Pengirim', 'trim|required');
                $this->form_validation->set_rules('opd', 'OPD', 'trim|required');
                $this->form_validation->set_rules('paket', 'Paket', 'trim|required');
                $this->form_validation->set_rules('pagu', 'Pagu', 'trim|required');
                $this->form_validation->set_rules('hps', 'HPS', 'trim|required');
                $this->form_validation->set_rules('nama_kepanitiaan', 'Nama Kepanitiaan', 'trim|required');
                $this->form_validation->set_rules('no_kepanitiaan', 'No Kepanitiaan', 'trim|required');
                $this->form_validation->set_rules('nama_cp', 'Nama CP', 'trim|required');
                $this->form_validation->set_rules('telp_cp', 'Telp CP', 'trim|required');

                if ($this->form_validation->run() == true) {
                    $config['upload_path'] = './uploads/';
                    $config['allowed_types'] = 'pdf';
                    $config['max_size'] = 2000000;
                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('file_surat')) {
                        if ($this->HomeModel->tambah_data_lelang($this->upload->data()) == true) {
                            $this->session->set_flashdata('notif', 'Tambah Data Lelang Berhasil!');
                            redirect('home/data_lelang');
                        } else {
                            $this->session->set_flashdata('notif', 'Tambah Surat Gagal!');
                            redirect('home/data_lelang');
                        }
                    } else {
                        $this->session->set_flashdata('notif', $this->upload->display_errors());
                        redirect('home/data_lelang');
                    }
                } else {
                    $this->session->set_flashdata('notif', validation_errors());
                    redirect('home/data_lelang');
                }
            } else {
                redirect('logout');
            }
        } else {
            redirect('login');
        }
    }

    public function tambah_pegawai() {
        if ($this->session->userdata('logged_in') == true) {
            if ($this->session->userdata('nama_jabatan') == 'LPSE') {
                $this->form_validation->set_rules('nik', 'NIK', 'trim|required');
                $this->form_validation->set_rules('nama_pegawai', 'Nama Pegawai', 'trim|required');
                $this->form_validation->set_rules('password', 'Password', 'trim|required');
                $this->form_validation->set_rules('confirm_password','Confirm password','required|matches[password]');

                if ($this->form_validation->run() == true) {
                    if ($this->HomeModel->tambah_pegawai() == true) {
                        $this->session->set_flashdata('notif', 'Tambah Pegawai Berhasil!');
                        redirect('home/pegawai');
                    } else {
                        $this->session->set_flashdata('notif', 'Tambah Pegawai Gagal!');
                        redirect('home/pegawai');
                    }
                } else {
                    $this->session->set_flashdata('notif', validation_errors());
                    redirect('home/pegawai');
                }
            } else {
                redirect('logout');
            }
        } else {
            redirect('login');
        }
    }

    public function ubah_data_lelang() {
        if ($this->session->userdata('logged_in') == true) {
            if ($this->session->userdata('nama_jabatan') == 'BLP') {
                //$this->form_validation->set_rules('ubah_nomor_surat', 'Nomor Surat', 'trim|required');
                $this->form_validation->set_rules('ubah_tgl_kirim', 'Tanggal Kirim', 'trim|required|date');
                //$this->form_validation->set_rules('ubah_tujuan', 'Tujuan', 'trim|required');
                //$this->form_validation->set_rules('ubah_perihal', 'Perihal', 'trim|required');

                $this->form_validation->set_rules('ubah_nama_pengirim', 'Nama Pengirim', 'trim|required');
                $this->form_validation->set_rules('ubah_opd', 'OPD', 'trim|required');
                $this->form_validation->set_rules('ubah_paket', 'Paket', 'trim|required');
                $this->form_validation->set_rules('ubah_pagu', 'Pagu', 'trim|required');
                $this->form_validation->set_rules('ubah_hps', 'HPS', 'trim|required');
                $this->form_validation->set_rules('ubah_nama_kepanitiaan', 'Nama Kepanitiaan', 'trim|required');
                $this->form_validation->set_rules('ubah_no_kepanitiaan', 'No Kepanitiaan', 'trim|required');
                $this->form_validation->set_rules('ubah_nama_cp', 'Nama CP', 'trim|required');
                $this->form_validation->set_rules('ubah_telp_cp', 'Telp CP', 'trim|required');

                if ($this->form_validation->run() == true) {
                    if ($this->HomeModel->ubah_data_lelang() == true) {
                        $this->session->set_flashdata('notif', 'Ubah Data Lelang Berhasil!');
                        redirect('home/data_lelang');
                    } else {
                        $this->session->set_flashdata('notif', 'Ubah Data Lelang Gagal!');
                        redirect('home/data_lelang');
                    }
                } else {
                    $this->session->set_flashdata('notif', validation_errors());
                    redirect('home/data_lelang');
                }
            } else {
                redirect('logout');
            }
        } else {
            redirect('login');
        }
    }

    public function ubah_pegawai() {
        if ($this->session->userdata('logged_in') == true) {
            if ($this->session->userdata('nama_jabatan') == 'LPSE') {
                $this->form_validation->set_rules('ubah_nik', 'NIK', 'trim|required');
                $this->form_validation->set_rules('ubah_nama_pegawai', 'Nama Pegawai', 'trim|required');
                $this->form_validation->set_rules('ubah_password', 'Password', 'trim|required');
                $this->form_validation->set_rules('ubah_confirm_password','Confirm password','required|matches[ubah_password]');

                if ($this->form_validation->run() == true) {
                    if ($this->HomeModel->ubah_pegawai() == true) {
                        $this->session->set_flashdata('notif', 'Update Pegawai Berhasil!');
                        redirect('home/pegawai');
                    } else {
                        $this->session->set_flashdata('notif', 'Update Pegawai Gagal!');
                        redirect('home/pegawai');
                    }
                } else {
                    $this->session->set_flashdata('notif', validation_errors());
                    redirect('home/pegawai');
                }
            } else {
                redirect('logout');
            }
        } else {
            redirect('login');
        }
    }

    public function ubah_file_data_lelang() {
        if ($this->session->userdata('logged_in') == true) {
            if ($this->session->userdata('nama_jabatan') == 'BLP') {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'pdf';
                $config['max_size'] = 2000000;
                $this->load->library('upload', $config);
                $path = './uploads/' . $this->HomeModel->get_nama_file_data_lelang($this->input->post('ubah_file_surat'));
                if (unlink($path)) {
                    if ($this->upload->do_upload('ubah_file_surat')) {
                        if ($this->HomeModel->ubah_file_data_lelang($this->upload->data()) == true) {
                            $this->session->set_flashdata('notif', 'Ubah file Data Lelang berhasil!');
                            redirect('home/data_lelang');
                        } else {
                            $this->session->set_flashdata('notif', 'Ubah file Data Lelang gagal!');
                            redirect('home/data_lelang');
                        }
                    } else {
                        $this->session->set_flashdata('notif', $this->upload->display_errors());
                        redirect('home/data_lelang');
                    }
                } else {
                    $this->session->set_flashdata('notif', 'Gagal menghapus file sebelumnya!');
                    redirect('home/data_lelang');
                }
            } else {
                redirect('logout');
            }
        } else {
            redirect('login');
        }
    }
/*
    public function ubah_file_pegawai() {
        if ($this->session->userdata('logged_in') == true) {
            if ($this->session->userdata('nama_jabatan') == 'BLP') {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'pdf';
                $config['max_size'] = 2000000;
                $this->load->library('upload', $config);
                $path = './uploads/' . $this->HomeModel->get_nama_file_pegawai($this->input->post('ubah_file_surat'));

                if (unlink($path)) {
                    if ($this->upload->do_upload('ubah_file_surat')) {
                        if ($this->HomeModel->ubah_file_pegawai($this->upload->data()) == true) {
                            $this->session->set_flashdata('notif', 'Ubah file Pegawai berhasil!');
                            redirect('home/pegawai');
                        } else {
                            $this->session->set_flashdata('notif', 'Ubah file Pegawai gagal!');
                            redirect('home/pegawai');
                        }
                    } else {
                        $this->session->set_flashdata('notif', $this->upload->display_errors());
                        redirect('home/pegawai');
                    }
                } else {
                    $this->session->set_flashdata('notif', 'Gagal menghapus file sebelumnya!');
                    redirect('home/pegawai');
                }
            } else {
                redirect('logout');
            }
        } else {
            redirect('login');
        }
    }
*/
    public function get_data_lelang_by_id($id_surat) {
        if ($this->session->userdata('logged_in') == true) {
            if ($this->session->userdata('nama_jabatan') == 'BLP') {
                $data_data_lelang_by_id = $this->HomeModel->get_data_lelang_by_id($id_surat);
                echo json_encode($data_data_lelang_by_id);
            } else {
                redirect('logout');
            }
        } else {
            redirect('login');
        }
    }

    public function get_pegawai_by_id($id_pegawai) {
        if ($this->session->userdata('logged_in') == true) {
            if ($this->session->userdata('nama_jabatan') == 'LPSE') {
                $data_pegawai_by_id = $this->HomeModel->get_pegawai_by_id($id_pegawai);
                echo json_encode($data_pegawai_by_id);
            } else {
                redirect('logout');
            }
        } else {
            redirect('login');
        }
    }

    public function get_pegawai_by_jabatan($id_jabatan) {
        if ($this->session->userdata('logged_in') == true) {
            $data_pegawai_by_id_jabatan = $this->HomeModel->get_pegawai_by_jabatan($id_jabatan);
            echo json_encode($data_pegawai_by_id_jabatan);
        } else {
            redirect('login');
        }
    }

    public function hapus_data_lelang($id_surat) {
        if ($this->session->userdata('logged_in') == true) {
            if ($this->session->userdata('nama_jabatan') == 'BLP') {
                $path = './uploads/' . $this->HomeModel->get_nama_file_data_lelang($id_surat);

                if (unlink($path)) {
                    if ($this->HomeModel->hapus_data_lelang($id_surat) == true) {
                        $this->session->set_flashdata('notif', 'Hapus Data Lelang berhasil!');
                        redirect('home/data_lelang');
                    } else {
                        $this->session->set_flashdata('notif', 'Hapus Data Lelang gagal');
                        redirect('home/data_lelang');
                    }
                } else {
                    $this->session->set_flashdata('notif', 'Gagal menghapus file sebelumnya!');
                    redirect('home/data_lelang');
                }
            } else {
                redirect('logout');
            }
        } else {
            redirect('login');
        }
    }

    public function hapus_pegawai($id_pegawai) {
        if ($this->session->userdata('logged_in') == true) {
            if ($this->session->userdata('nama_jabatan') == 'LPSE') {
                //$path = './uploads/' . $this->HomeModel->get_nama_file_pegawai($id_surat);
                
                    if ($this->HomeModel->hapus_pegawai($id_pegawai) == true) {
                        $this->session->set_flashdata('notif', 'Hapus Pegawai Berhasil!');
                        redirect('home/pegawai');
                    } else {
                        $this->session->set_flashdata('notif', 'Tidak dapat menghapus Pegawai!');
                        redirect('home/pegawai');
                    }
                
            } else {
                redirect('logout');
            }
        } else {
            redirect('login');
        }
    }

    public function hapus_disposisi($id_disposisi, $id_surat) {
        if ($this->session->userdata('logged_in') == true) {
            if ($this->session->userdata('nama_jabatan') == 'BLP') {
                if ($this->HomeModel->hapus_disposisi($id_disposisi) == true) {
                    $this->session->set_flashdata('notif', 'Hapus Disposisi Surat Berhasil!');
                    redirect('home/disposisi/' . $id_surat);
                } else {
                    $this->session->set_flashdata('notif', 'Hapus Disposisi Surat Gagal!');
                    redirect('home/disposisi' . $id_surat);
                }
            } else {
                redirect('logout');
            }
        } else {
            redirect('login');
        }
    }

    public function hapus_disposisi_pegawai($id_disposisi, $id_surat) {
        if ($this->session->userdata('logged_in') == true) {
            if ($this->HomeModel->hapus_disposisi($id_disposisi) == true) {
                $this->session->set_flashdata('notif', 'Hapus Disposisi Surat Berhasil!');
                redirect('home/disposisi_keluar_pegawai/' . $id_surat);
            } else {
                $this->session->set_flashdata('notif', 'Hapus Disposisi Surat Gagal!');
                redirect('home/disposisi_keluar_pegawai/' . $id_surat);
            }
        } else {
            redirect('login');
        }
    }

    public function hitunginputdatabaru(){
        $data_baru = $this->HomeModel->jumlah_data_baru();

        echo json_encode($data_baru);
    }

}
