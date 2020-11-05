<?php
/**
 * Created by PhpStorm.
 * User: doxa
 * Date: 01/02/18
 * Time: 06.48
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class HomeModel extends CI_Model {

    public function get_jumlah_surat() {
        $pegawai = $this->db->select('count(*) as total_pegawai')
            ->get('pegawai')->row();

        $data_lelang = $this->db->select('count(*) as total_data_lelang')
            ->get('data_lelang')->row();

        return array(
            'pegawai' => $pegawai->total_pegawai,
            'data_lelang' => $data_lelang->total_data_lelang
        );
    }

    public function get_jumlah_disposisi() {
        $disposisi_keluar = $this->db
            ->select('count(id_pegawai_pengirim) as total_disposisi_keluar')
            ->where('id_pegawai_pengirim', $this->session->userdata('id_pegawai'))
            ->get('disposisi')->row();

        $disposisi_masuk = $this->db
            ->select('count(id_pegawai_penerima) as total_disposisi_masuk')
            ->where('id_pegawai_penerima', $this->session->userdata('id_pegawai'))
            ->get('disposisi')->row();

        return array(
            'disposisi_keluar' => $disposisi_keluar->total_disposisi_keluar,
            'disposisi_masuk' => $disposisi_masuk->total_disposisi_masuk
        );
    }

    public function tambah_data_lelang($file_surat) {
        $data = array(
            //'nomor_surat' => $this->input->post('nomor_surat'),
            'tgl_kirim' => $this->input->post('tgl_kirim'),
            //'tujuan' => $this->input->post('tujuan'),
            //'perihal' => $this->input->post('perihal'),
            'nama_pengirim' => $this->input->post('nama_pengirim'),
            'opd' => $this->input->post('opd'),
            'paket' => $this->input->post('paket'),
            'pagu' => $this->input->post('pagu'),
            'hps' => $this->input->post('hps'),
            'nama_kepanitiaan' => $this->input->post('nama_kepanitiaan'),
            'no_kepanitiaan' => $this->input->post('no_kepanitiaan'),
            'nama_cp' => $this->input->post('nama_cp'),
            'telp_cp' => $this->input->post('telp_cp'),
            'status' => 'UR',
            'file_surat' => $file_surat['file_name']
        );

        $this->db->insert('data_lelang', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function tambah_pegawai() {
        $data = array(
            'nik' => $this->input->post('nik'),
            'nama_pegawai' => $this->input->post('nama_pegawai'),
            'password' => md5($this->input->post('password'))
            
        );

        $this->db->insert('pegawai', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function tambah_disposisi($id_surat) {
        $data = array(
            'id_surat' => $id_surat,
            'id_pegawai_pengirim' => $this->session->userdata('id_jabatan'),
            'id_pegawai_penerima' => $this->input->post('tujuan_pegawai'),
            'keterangan' => $this->input->post('keterangan')
        );

        $this->db->insert('disposisi', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function disposisi_selesai($id_surat) {
        $data['status'] = 'selesai';

        $this->db->where('id_surat', $id_surat)
            ->update('surat_masuk', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function ubah_data_lelang() {
        $data = array(
            //'nomor_surat' => $this->input->post('ubah_nomor_surat'),
            'tgl_kirim' => $this->input->post('ubah_tgl_kirim'),
            //'tujuan' => $this->input->post('ubah_tujuan'),
            //'perihal' => $this->input->post('ubah_perihal'),

            'nama_pengirim' => $this->input->post('ubah_nama_pengirim'),
            'opd' => $this->input->post('ubah_opd'),
            'paket' => $this->input->post('ubah_paket'),
            'pagu' => $this->input->post('ubah_pagu'),
            'hps' => $this->input->post('ubah_hps'),
            'nama_kepanitiaan' => $this->input->post('ubah_nama_kepanitiaan'),
            'no_kepanitiaan' => $this->input->post('ubah_no_kepanitiaan'),
            'nama_cp' => $this->input->post('ubah_nama_cp'),
            'telp_cp' => $this->input->post('ubah_telp_cp'),
        );

        $this->db->where('id_surat', $this->input->post('ubah_id_surat'))
            ->update('data_lelang', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function ubah_pegawai() {
        $data = array(
            'nik' => $this->input->post('ubah_nik'),
            'nama_pegawai' => $this->input->post('ubah_nama_pegawai'),
            'password' => md5($this->input->post('ubah_password'))
            
        );

        $this->db->where('id_pegawai', $this->input->post('ubah_id_pegawai'))
            ->update('pegawai', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function ubah_file_data_lelang($file_surat) {
        $data = array(
            'file_surat' => $file_surat['file_name']
        );

        $this->db->where('id_surat', $this->input->post('ubah_file_surat'))
            ->update('data_lelang', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
/*
    public function ubah_file_surat_masuk($file_surat) {
        $data = array(
            'file_surat' => $file_surat['file_name']
        );

        $this->db->where('id_surat', $this->input->post('ubah_file_surat'))
            ->update('surat_masuk', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
*/
    public function get_disposisi($id_surat) {
        return $this->db->join('disposisi', 'disposisi.id_surat = surat_masuk.id_surat')
            ->join('jabatan', 'disposisi.id_pegawai_pengirim = jabatan.id_jabatan')
            ->join('pegawai', 'disposisi.id_pegawai_penerima = pegawai.id_pegawai')
            ->where('disposisi.id_surat', $id_surat)
            ->get('surat_masuk')->result();
    }

    public function get_disposisi_masuk($id_pegawai) {
        return $this->db->join('disposisi', 'disposisi.id_surat = surat_masuk.id_surat')
            ->join('pegawai', 'disposisi.id_pegawai_pengirim = pegawai.id_pegawai')
            ->join('jabatan', 'jabatan.id_jabatan = pegawai.id_jabatan')
            ->where('id_pegawai_penerima', $id_pegawai)
            ->get('surat_masuk')->result();
    }

    public function get_disposisi_keluar($id_surat) {
        return $this->db->join('disposisi', 'disposisi.id_surat = surat_masuk.id_surat')
            ->join('pegawai', 'disposisi.id_pegawai_penerima = pegawai.id_pegawai')
            ->join('jabatan', 'jabatan.id_jabatan = pegawai.id_jabatan')
            ->where('disposisi.id_pegawai_pengirim', $this->session->userdata('id_jabatan'))
            ->where('disposisi.id_surat', $id_surat)
            ->get('surat_masuk')->result();
    }

    public function get_all_disposisi_keluar() {
        return $this->db->join('disposisi', 'disposisi.id_surat = surat_masuk.id_surat')
            ->join('pegawai', 'disposisi.id_pegawai_penerima = pegawai.id_pegawai')
            ->join('jabatan', 'jabatan.id_jabatan = pegawai.id_jabatan')
            ->where('disposisi.id_pegawai_pengirim', $this->session->userdata('id_jabatan'))
            ->get('surat_masuk')->result();
    }

    public function get_data_lelang() {
        return $this->db->get('data_lelang')->result();
    }

    public function get_pegawai() {
        return $this->db->get('pegawai')->result();
    }

    public function get_data_lelang_by_id($id_surat) {
        return $this->db->where('id_surat', $id_surat)->get('data_lelang')
            ->row();
    }

    public function get_pegawai_by_id($id_pegawai) {
        return $this->db->where('id_pegawai', $id_pegawai)->get('pegawai')
            ->row();
    }

    public function get_nama_file_data_lelang($id_surat) {
        return $this->db->where('id_surat', $id_surat)
            ->get('data_lelang')->row()->file_surat;
    }
/*
    public function get_nama_file_surat_masuk($id_surat) {
        return $this->db->where('id_surat', $id_surat)
            ->get('surat_masuk')->row()->file_surat;
    }
*/
    public function get_jabatan() {
        return $this->db->get('jabatan')->result();
    }

    public function get_pegawai_by_jabatan($id_jabatan) {
        return $this->db->where('id_jabatan', $id_jabatan)
            ->get('pegawai')->result();
    }

    public function cek_status_surat_masuk($id_surat) {
        $query = $this->db->where('id_surat', $id_surat)
            ->get('surat_masuk')->row()->status;

        if ($query == 'proses') {
            return true;
        } else {
            return false;
        }
    }

    public function hapus_data_lelang($id_surat) {
        $this->db->where('id_surat', $id_surat)
            ->delete('data_lelang');

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function hapus_pegawai($id_pegawai) {
        $this->db->where('id_pegawai', $id_pegawai)
            ->delete('pegawai');

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function hapus_disposisi($id_disposisi) {
        $this->db->where('id_disposisi', $id_disposisi)
            ->delete('disposisi');

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function jumlah_data_baru(){
        $this->db->where('status','UR');
        $this->db->from('data_lelang');
        return $this->db->count_all_results();
    }

    public function get_data_belum_baca(){
        $this->db->select('*');
        $this->db->from('data_lelang');
        $this->db->where('status','UR');

        $query = $this->db->get();
        return $query->result();
    }

    public function update_data_lihat($where,$data,$table) {
        $this->db->where($where);
        $this->db->update($table,$data);
    }
}