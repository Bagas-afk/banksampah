<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelNasabah');
        $this->load->model('ModelSampah');
        $this->load->model('ModelSetor');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['title'] = 'Dashboard';
        $data['query'] = $this->ModelNasabah->countUser();
        $data['query1'] = $this->ModelSampah->countSampah();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }


    public function nasabah()
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();


        $data['title'] = 'Form Data Nasabah';
        $data['data_nasabah'] = $this->ModelNasabah->tampilNasabah()->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/nasabah', $data);
        $this->load->view('templates/footer');
    }

    public function tambahSetor()
    {
        $id_nasabah = $this->input->post('namanasabah');
        $id_sampah = $this->input->post('jenis_sampah');
        $data = [
            'id_setoran' => '',
            'tanggal' => $this->input->post('tanggal'),
            'id_nasabah' => $id_nasabah,
            'id_sampah' => $id_sampah,
            'jumlah' => $this->input->post('jumlah'),
            'sub_total' => $this->input->post('subtotal'),
        ];

        $this->ModelSetor->simpanSetor($data);
        redirect('user/setor');
    }

    public function setor()
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['nasabah'] = $this->ModelNasabah->tampilNasabah()->result();
        $data['sampah'] = $this->ModelSampah->tampilSampah()->result();
        $data['setor'] = $this->ModelSetor->tampilDataSetor()->result();
        // print_r($data['nasabah']);
        // die;
        $data['title'] = 'Form Tambah Setor Sampah';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/setor', $data);
        $this->load->view('templates/footer');
    }

    function tampilDataNasabah($id_nasabah)
    {
        $id_nasabah = $this->uri->segment(3);
        $data = $this->ModelNasabah->cari_data_nasabah($id_nasabah)->row();
        echo json_encode($data);
    }

    function tampilDataSampah($id_sampah)
    {
        $id_sampah = $this->uri->segment(3);
        $data = $this->ModelSampah->cari_data_sampah($id_sampah)->row();
        echo json_encode($data);
    }

    public function sampah()
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['title'] = 'Form Data Sampah';
        $data['data_sampah'] = $this->ModelSampah->tampilSampah()->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/sampah', $data);
        $this->load->view('templates/footer');
    }

    public function tambahnasabah()
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['title'] = 'Tambah Nasabah';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/tambahnasabah', $data);
        $this->load->view('templates/footer');
    }

    public function tambahSampah()
    {
        $jenis_sampah = $this->input->post('jenis_sampah');
        $kategori = $this->input->post('kategori');
        $harga = $this->input->post('harga');
        $satuan = $this->input->post('satuan');
        $data = [
            'jenis_sampah' => $jenis_sampah,
            'kategori' => $kategori,
            'harga' => $harga,
            'satuan' => $satuan
        ];
        if ($this->ModelSampah->tambahSampah($data)) {
            echo 'berhasil';
            redirect('user/sampah');
        } else {
            echo 'gagal';
        }
    }

    public function editSampah()
    {
        $id = decrypt_url($this->input->post('id_harga'));
        $jenis_sampah = $this->input->post('jenis_sampah');
        $harga = $this->input->post('harga');
        $satuan = $this->input->post('satuan');
        $data = [
            'jenis_sampah' => $jenis_sampah,
            'harga' => $harga,
            'satuan' => $satuan
        ];
        // print_r($data);
        // die;
        if ($this->ModelSampah->editSampah($data, $id)) {
            redirect('user/sampah');
        } else {
            echo "gagal";
        }
    }

    public function hapusSampah($id)
    {
        $id = $this->uri->segment(3);
        if ($this->ModelSampah->hapusSampah($id)) {
            echo 'berhasil';
            redirect('user/sampah');
        } else {
            echo 'gagal';
        }
    }



    public function tambahAksi()
    {
        $nik = $this->input->post('nik');
        $nama = $this->input->post('nama');
        $tanggal_lahir = $this->input->post('tanggal_lahir');
        $jenis_kelamin = $this->input->post('jenis_kelamin');
        $no_telpon = $this->input->post('no_telpon');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $agama = $this->input->post('agama');
        $alamat = $this->input->post('alamat');
        $kecamatan = $this->input->post('kecamatan');
        $kelurahan = $this->input->post('kelurahan');
        $status = $this->input->post('status');
        $pekerjaan = $this->input->post('pekerjaan');
        $bank = $this->input->post('bank');
        $no_rekening = $this->input->post('no_rekening');
        $data = [
            'id_user' => '',
            'nik' => $nik,
            'nama' => $nama,
            'tanggal_lahir' => $tanggal_lahir,
            'jenis_kelamin' => $jenis_kelamin,
            'no_telpon' => $no_telpon,
            'email' => $email,
            'password' => $password,
            'agama' => $agama,
            'alamat' => $alamat,
            'kecamatan' => $kecamatan,
            'kelurahan' => $kelurahan,
            'status' => $status,
            'pekerjaan' => $pekerjaan,
            'bank' => $bank,
            'no_rekening' => $no_rekening,
            'role_id' => '2',
        ];
        if ($this->ModelNasabah->tambahNasabah($data)) {
            echo 'berhasil';
            redirect('user/nasabah');
        } else {
            echo 'gagal';
        }
    }

    public function editNasabah()
    {
        $id = decrypt_url($this->input->post('id_user'));
        $nama = $this->input->post('nama');
        $no_telpon = $this->input->post('no_telpon');
        $status = $this->input->post('status');
        $kecamatan = $this->input->post('kecamatan');
        $kelurahan = $this->input->post('kelurahan');
        $alamat = $this->input->post('alamat');
        $bank = $this->input->post('bank');
        $no_rekening = $this->input->post('no_rekening');
        $data = [
            'id_user' => '',
            'nama' => $nama,
            'no_telpon' => $no_telpon,
            'status' => $status,
            'alamat' => $alamat,
            'kecamatan' => $kecamatan,
            'kelurahan' => $kelurahan,
            'bank' => $bank,
            'no_rekening' => $no_rekening,
        ];
        if ($this->ModelNasabah->editNasabah($data, $id)) {
            echo 'berhasil';
            redirect('user/nasabah');
        } else {
            echo 'gagal';
        }
    }

    public function hapusNasabah($id)
    {
        $id = $this->uri->segment(3);
        if ($this->ModelNasabah->hapusNasabah($id)) {
            echo 'berhasil';
            redirect('user/nasabah');
        } else {
            echo 'gagal';
        }
    }


    public function cek_saldo()
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['tb_setor'] = $this->db->get_where('tb_setor', ['sub_total' =>
        $this->session->userdata('sub_total')])->row_array();

        $data['title'] = 'Cek Saldo';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/cek_saldo', $data);
        $this->load->view('templates/footer');
    }

    public function index_nasabah()
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['title'] = 'My Profile';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index_nasabah', $data);
        $this->load->view('templates/footer');
    }
}
