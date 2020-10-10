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
        if ($this->session->userdata('role_id') != '1') {
            redirect('auth/cek_session');
        }
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
        $sub_total = $this->input->post('subtotal');
        $data = [
            'id_setoran' => '',
            'tanggal' => date('Y-m-d H:i:s'),
            'id_nasabah' => $id_nasabah,
            'id_sampah' => $id_sampah,
            'jumlah' => $this->input->post('jumlah'),
            'sub_total' => $sub_total,
        ];

        $transaksi = [
            'id_transaksi' => '',
            'id_user' => $id_nasabah,
            'jumlah' => $sub_total,
            'keterangan' => 'setoran',
            'tanggal' => date('Y-m-d H:i:s')

        ];
        $saldoNasabah = $this->ModelSetor->saldoNasabah($id_nasabah)->row();
        $last_balance = intval($saldoNasabah->saldo + $sub_total);
        // print_r($last_balance);
        // die;
        $this->ModelSetor->updateSaldo($last_balance, $id_nasabah);
        $this->ModelSetor->tambahTransaksi($transaksi);
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


    public function cek_saldo()
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->model('ModelSetor');
        // $data['subtotal'] = $this->ModelSetor->saldoNasabah($this->session->userdata('id_user'))->row();
        $data['saldo'] = $this->ModelSetor->saldoNasabah($this->session->userdata('id_user'))->row();
        // $data['saldo'] = array_sum($data['subtotal']->sub_total);
        // print_r($this->session->userdata('id_user'));
        // die;

        $data['setor'] = $this->ModelSetor->tampilSetoranNasabah($this->session->userdata('id_user'))->result();
        $data['title'] = 'Cek Saldo';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/cek_saldo', $data);
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

    public function verifikasi()
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['title'] = 'Verifikasi Penarikan';
        $data['data_sampah'] = $this->ModelSampah->tampilSampah()->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/verifikasi', $data);
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
        $id = $this->input->post('id_user');
        $nama = $this->input->post('nama');
        $no_telpon = $this->input->post('no_telpon');
        $status = $this->input->post('status');
        $kecamatan = $this->input->post('kecamatan');
        $kelurahan = $this->input->post('kelurahan');
        $alamat = $this->input->post('alamat');
        $data = [
            'nama' => $nama,
            'no_telpon' => $no_telpon,
            'status' => $status,
            'alamat' => $alamat,
            'kecamatan' => $kecamatan,
            'kelurahan' => $kelurahan,

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

    public function editProfile()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nama', 'nama', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/editProfile', $data);
            $this->load->view('templates/footer');
        } else {

            $nama = $this->input->post('nama');
            $email = $this->input->post('email');
            $this->db->set('nama', $nama);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger" role="alert"> Profile berhasil di update</div>'
            );
            redirect('user/index_nasabah');
        }
    }
}
